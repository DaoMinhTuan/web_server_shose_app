<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users); 
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
       $users = new User();
       $users->fill($request->all());
       $users->password = Hash::make($request->password);
       $users->save();

       return response()->json([
        'status' => '200',
        'message' => "creat user successfully"
       ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);

        if($users == null){
            return response()->json([
               'status' => '404',
               'message' => 'User not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $users
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);

        if($users == null){
            return response()->json([
              'status' => '404',
              'message' => 'User not found'
            ]);
        } 

        $users->fill($request->all());
        $users->Password = Hash::make($request->Password);
        $users->save();

        return response()->json([
          'status' => '200',
          'message' => "update user successfully",
          'data' => $users
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
        $users = User::find($id);

        if( $users == null ){
            return response()->json([
               'status' => '404',
               'message' => "user not found"
            ]);
        }else{
            $users->delete();
            return response()->json([
              'status' => '200',
              'message' => "user deleted successfully"
            ]);
        } 
    }
}