<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserTest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Validator;
use App\Models\User; 

class UserTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = UserTest::all();
        $users  = User::select('name','email','status','position')
                  ->leftJoin("user_test", 'user_test.user_id', '=', "users.id")->get();

        return response()->json(['users' => $users, 'message' => 'Retrieved successfully'], 200); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'status' => 'required',
            'position' => 'required',
        ]);       

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'Validation Error'], 200); 
        }       

        if(!User::find($request->user_id)){
            return response()->json(['error' => $data, 'message' => 'user_id not exist in master users'], 200); 
        }

        $users = UserTest::create($data);        
        return response()->json(['users' => $users, 'message' => 'Created successfully'], 201); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserTest $userTest)
    {
        $users = UserTest::where('user_id',$request->user)->get();
        return response()->json(['users' => $users, 'message' => 'Retrieved successfully'], 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        UserTest::where('user_id',$id)->update([
            'status' => $request->status,
            'position' => $request->position ]);
        $users = UserTest::where('user_id',$id)->get();
        return response()->json(['users' =>  $users, 'message' => 'Update successfully'], 200); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        UserTest::where('user_id',$request->user)->delete();
        return response()->json(['message' => 'Deleted'], 200); 
    }
}
