<?php

namespace App\Http\Controllers\Auth;

use App\Models\Currency;
use App\Models\CurrencyQuery;
use App\Models\Subject;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupQuery;
use App\Models\UserQuery;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Propel\Runtime\Propel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Weconstudio\Log\Log;
use Weconstudio\Misc\U;

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
			'id_language' => 'required|exists:language,id',
			'currency' => 'required',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
            'username' => 'required|max:255|unique:user',
            'password' => 'required|min:6|confirmed',
			'country' => 'required',
			'address' => 'required',
			'city' => 'required',
			'province' => 'required',
			'zip' => 'required',
			'phone' => 'required',
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
		
		$con = Propel::getConnection();
		$con->beginTransaction();
		try {
			// creo il profilo da legare all'account
			$subject = new Subject();
			$data = $request->all();
			$data["full_name"] = $data["last_name"] . " " . $data["first_name"];
			$subject->fromArray($data);
			$subject->save();

			// creo l'utente
			$data['id_subject'] = $subject->getId();
			$data['name'] = $request->input('first_name', '') . " " . $request->input('last_name', '');
			// currency
			$currency = CurrencyQuery::create()->findOneByShortName($request->input('currency', 'EUR'));
			if(!$currency instanceof Currency) throw new \Exception('Currency ' . $request->input('currency', 'EUR') . ' not found!');
			$data['id_currency'] = $currency->getId();
			$user = $this->create($data);
			$con->commit();
		} catch(\Exception $e) {
			Log::e("\n$e");
			$con->rollBack();
			return redirect('/register/error')->withInput([
				'message' => U::T_("Creazione account fallita. Riprova più tardi!")
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
					'message' => U::T_("Account già confermato"),
					'status' => 'success'
				]);
				if(\Hash::check($user->getUsername() . $user->getPassword(), $request->input('token', ''))) {
					try {
						$user->setEmailConfirmed(1);
						$user->setEnabled(1);
						$user->save();
						$status = 'success';
						$message = U::T_("Email confermata. Effettua il login.");
					} catch(\Exception $e) {
						Log::e("$e");
						$status = 'danger';
						$message = U::T_("Errore durante la conferma dell'email.");
					}
					return redirect('/login')->withInput([
						'message' => $message,
						'status' => $status
					]);
				}
			}
		}
		
		return redirect('/register/error')->withInput([
			'message' => U::T_("Token o email non valida.")
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
