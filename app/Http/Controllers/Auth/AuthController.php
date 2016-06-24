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
		try {
            $user = new User();
            $user->fromArray($data);
            $userGroup = UserGroupQuery::create()->findOneByLabel('User');
			if(!$userGroup instanceof UserGroup) {
				$userGroup = UserGroupQuery::create()->findOne();
			}
			$user->setPassword(bcrypt($data['password']));
			$user->setIdUserGroup($userGroup->getId());
            $user->save();
            return $user;
        } catch(\Exception $e) {
            Log::e("$e");
        }

        return null;
    }
	
	public function register(Request $request) {
		$validator = $this->validator($request->all());
		
		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}
		
		$user = $this->create($request->all());
		if(is_null($user)) return redirect('/register/error')->withInput([
			'message' => 'Retry later!'
		]);
		
		// Send email to confirm account
		$token = bcrypt($user->getUsername() . $user->getPassword());
		$link = url('/confirm').'?token=' . $token . '&username='.urlencode($user->getUsername());
		\Mail::queue('auth.emails.confirm', ['link' => $link], function (Message $m) use ($user) {
			$m->to($user->getEmail())->subject('Confirm your account');
		});
		
		return redirect('/register/success');
	}
	
	public function confirm(Request $request) {
		if($request->has('username') and $request->has('token')) {
			$user = UserQuery::create()->findOneByUsername($request->input('username', ''));
			if($user instanceof User) {
				if($user->getEnabled()) return redirect('/dashboard');
				if(\Hash::check($user->getUsername() . $user->getPassword(), $request->input('token', ''))) {
					\Auth::login($user);
					if(\Auth::check()) {
						try {
							$user->setEnabled(1);
							$user->save();
						} catch(\Exception $e) {
							Log::e("$e");
						}
						return redirect('/dashboard');
					}
				}
			}
		}
		
		return redirect('/register/error')->withInput([
			'message' => 'Bad token or email not found!'
		]);
	}

	public function success() {
		return view('auth.success');
	}

	public function error() {
		return view('auth.error');
	}
}
