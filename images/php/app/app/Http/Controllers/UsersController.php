<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function authenticate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|max:50',
            'password' => 'required|max:255'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $validate->errors()->first()
                ]
            ]);
        }

        $user = Users::where('email', $request->input('email'))->first();

        if ((new BcryptHasher())->check($request->input('password'), $user->password)) {
            $apiKey = base64_encode(Str::random(40));
            Users::where('email', $request->input('email'))->update(['api_token' => $apiKey]);

            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    'api_token' => $apiKey,
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'incorrect username or password',
                ]
            ], 401);
        }
    }

    /**
     * User add method
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30',
            'email' => 'required|unique:users|max:40',
            'password' => 'required|max:50',
            'mobile' => 'required|max:10',
            'gender' => 'required|max:10',
            'dateOfBirth' => 'required|max:10',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $validate->errors()->first()
                ]
            ]);
        }

        $user = new Users();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = (new BcryptHasher())->make($request->input('password'));
        $user->mobile = $request->input('mobile');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dateOfBirth');

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'New user has been successfully saved'
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Unable to save new user, please try again'
                ]
            ]);
        }
    }
}
