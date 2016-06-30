<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupQuery;
use App\Models\UserQuery;
use Illuminate\Mail\Message;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Weconstudio\Log\Log;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
            'username' => 'required|max:255|unique:user',
            'password' => 'required|min:6|confirmed',
			'agree' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$user = new User();
		$user->fromArray($data);
		$userGroup = UserGroupQuery::create()->findOneByLevel(UserGroup::LEVEL_USER);
		if(!$userGroup instanceof UserGroup) {
			$userGroup = UserGroupQuery::create()->findOne();
		}
		$user->setPassword(bcrypt($data['password']));
		$user->setIdUserGroup($userGroup->getId());
		$user->save();

		return $user;
    }
	
	/**
	 * Processo di registrazione
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function register(Request $request) {
		$validator = $this->validator($request->all());
		
		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}
		
		try {
			$user = $this->create($request->all());
		} catch(\Exception $e) {
			Log::e($e->getMessage() . "\n$e");
			return redirect('/register/error')->withInput([
				'message' => 'Failed create account. Retry later!'
			]);
		}
		
		// Send email to confirm account
		$token = bcrypt($user->getUsername() . $user->getPassword());
		$link = url('/confirm').'?token=' . $token . '&username='.urlencode($user->getUsername());
		\Mail::queue('auth.emails.confirm', ['link' => $link], function (Message $m) use ($user) {
			$m->to($user->getEmail())->subject('Confirm your account');
		});
		
		return redirect('/register/success');
	}
	
	/**
	 * Conferma un account dopo la registrazione e dopo il link dalla email
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function confirm(Request $request) {
		if($request->has('username') and $request->has('token')) {
			$user = UserQuery::create()->findOneByUsername($request->input('username', ''));
			if($user instanceof User) {
				if($user->getEnabled()) return redirect('/login')->withInput([
					'message' => 'Account already confirmed!',
					'status' => 'success'
				]);
				if(\Hash::check($user->getUsername() . $user->getPassword(), $request->input('token', ''))) {
					try {
						$user->setEnabled(1);
						$user->save();
						$status = 'success';
						$message = 'Email confirmed! You can login!';
					} catch(\Exception $e) {
						Log::e("$e");
						$status = 'danger';
						$message = 'Error during email confirmation!';
					}
					return redirect('/login')->withInput([
						'message' => $message,
						'status' => $status
					]);
				}
			}
		}
		
		return redirect('/register/error')->withInput([
			'message' => 'Bad token or email not found!'
		]);
	}

	/**
	 * Pagina di successo registrazione generica
	 *
	 * @return mixed
	 */
	public function success() {
		return view('auth.success');
	}

	/**
	 * Pagina di errore registrazione generica
	 *
	 * @return mixed
	 */
	public function error() {
		return view('auth.error');
	}
}
