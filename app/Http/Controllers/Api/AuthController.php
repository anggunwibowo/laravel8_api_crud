<?php
namespace App\Http\Controllers\API;

use App\Models\User; 
//use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller 
{

  public function login(Request $request){ 

  //   $credentials = [
  //       'email' => $request->email, 
  //       'password' => $request->password
  //   ];

  //   if( auth()->attempt($credentials) ){ 
  //     $user = Auth::user(); 
	 //  $success['token'] =  $user->createToken('AppName')->accessToken; 
  //     return response()->json(['success' => $success], 200);
  //   } else { 
		// return response()->json(['error'=>'Unauthorised'], 401);
  //   } 

    $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

  }
    
  public function register(Request $request) 
  { 
 //    $validator = Validator::make($request->all(), [ 
 //      'name' => 'required', 
 //      'email' => 'required|email', 
 //      'password' => 'required', 
 //      'password_confirmation' => 'required|same:password', 
 //    ]);

 //    if ($validator->fails()) { 
 //      return response()->json([ 'error'=> $validator->errors() ]);
 //    }
	
	// $data = $request->all(); 
	
	// $data['password'] = Hash::make($data['password']);
	
	// $user = User::create($data); 
	// $success['token'] =  $user->createToken('AppName')->accessToken;
	
	// return response()->json(['success'=>$success], 200);

    $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken], 201);

  }
    
  public function user_detail() 
  { 
  	$user = Auth::user();
  	return response()->json(['success' => $user], 200); 
  } 

}
?>