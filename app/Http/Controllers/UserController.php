<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyQuery;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Propel\Runtime\Propel;
use Weconstudio\DataTable\DataTable;
use Weconstudio\DataTable\DataTableConfiguration;
use Weconstudio\Log\Log;
use Weconstudio\Misc\U;

class UserController extends Controller
{
    use DataTable;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $configuration = new DataTableConfiguration();
        $configuration->model = User::class;
        $configuration->inlineButton = 'edit';

        $configuration->columns = [
            [
                'label' => U::T_("Name"),
                'field' => 'name',
                'sort' => true,
                'filter' => true
            ],
            [
                'label' => U::T_("Group"),
                'field' => 'user_group.label',
                'sort' => true,
                'filter' => true
            ],
            [
                'label' => U::T_("Email"),
                'field' => 'email',
                'sort' => true,
                'filter' => true
            ],
            [
                'label' => U::T_("Username"),
                'field' => 'username',
                'sort' => true,
                'filter' => false
            ],
            [
                'label' => U::T_("Email confirmed"),
                'field' => 'email_confirmed',
                'sort' => true,
                'filter' => true,
                'formatter' => 'bool',
                'align' => 'center'
            ],
            [
                'label' => U::T_("Enabled"),
                'field' => 'enabled',
                'sort' => true,
                'filter' => true,
                'formatter' => 'user_enabled',
                'align' => 'center'
            ]
        ];

        if ($request->input('dt', 0)) {
            return $this->crud($request, $configuration);
        }

        return view('user.index', [
            "configuration" => $configuration
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
    public function edit(User $user)
    {
		return view('user.edit', [
			'user' => $user
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, User $user)
    {
		$this->validate($request, [
			'email' => 'required|email|max:255',
			'password' => 'min:6|confirmed',
			'id_language' => 'required|exists:language,id',
			'id_currency' => 'required|exists:currency,id',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
		]);

		$con = Propel::getConnection();
		$con->beginTransaction();

		try {
			$subject = $user->getSubject();
			if(!$subject instanceof Subject) throw new \Exception(U::T_("Soggetto non valido!"));
			$subject->fromArray($request->all());
			$subject->save();

			$data = $request->all();
			$data['id_subject'] = $subject->getId();
			$data['name'] = $request->input('first_name', '') . " " . $request->input('last_name', '');
			unset($data['username']);
			unset($data['password']);
			unset($data['enabled']);
			unset($data['email_confirmed']);
			if($request->has('password')) $data['password'] = bcrypt($request->input('password'));
			$user->fromArray($data);
			$user->save();
			$con->commit();
			$response = true;
			$message = $user->getId();
		} catch(\Exception $e) {
			Log::e("$e");
			$message = $e->getMessage();
			$response = false;
			$con->rollBack();
		}

		return response()->json([
			'response' => $response,
			'message' => $message
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	/**
	 * Abilita/Disabilita manualmente un utente con email già confermata
	 *
	 * @param User $user
	 * @param int $enable
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function enable(User $user, $enable = 1) {
		try {
			$user->setEnabled($enable);
			$user->save();
			$response = true;
			$message = $user->getId();
		} catch(\Exception $e) {
			Log::e("$e");
			$response = false;
			$message = $e->getMessage();
		}

		return response()->json([
			'response' => $response,
			'message' => $message
		]);
	}
}
