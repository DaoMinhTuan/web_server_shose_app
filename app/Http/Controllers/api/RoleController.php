<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles); 
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
        $roles = new Role();
        $roles->fill($request->all());
        $roles->save();
 
        return response()->json([
         'status' => '200',
         'message' => "creat role successfully"
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
        $roles = Role::find($id);

        if($roles == null){
            return response()->json([
               'status' => '404',
               'message' => 'Role not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $roles
            
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
        $roles = Role::find($id);

        if($roles == null){
            return response()->json([
              'status' => '404',
              'message' => 'Role not found'
            ]);
        } 
        $roles->fill($request->all());
        $roles->save();

        return response()->json([
          'status' => '200',
          'message' => "update role successfully",
          'data' => $roles
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
        $roles = Role::find($id);

        if( $roles == null ){
            return response()->json([
               'status' => '404',
               'message' => "Role not found"
            ]);
        }else{
            $roles->delete();
            return response()->json([
              'status' => '200',
              'message' => "Role deleted successfully"
            ]);
        } 
    }
}
