<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

    protected $address;

    public function  __construct()
    {
        $this->address = new Address();
    }

    public function index()
    {
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
        /**
         * Retrieve the user with the given ID, or return a default value of 0 if not found.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \App\Models\User
         */
        $user = User::select([DB::raw('IFNULL(id, 0)')])->where('id',$request->user_id)->first();
        
        /**
         * Check if the user is null. If it is null, return a JSON response with a 401 status code and a message indicating
         *  that the user was not found. If the user is not null, set the data to the address.
         *
         * @param  mixed  $user
         * @return \Illuminate\Http\JsonResponse
         */
        if($user == null){
            $data = null;
            return response()->json([
                'status' => '401',
                'message' => 'user not found',
            ]);
        }else{
            $data = $this->address;
        }
       
        /**
         * creat the user's address with the given data from the request.
         *
         * @param  Request  $request
         * @param  UserAddress|null  $data
         * @return JsonResponse
         */
        if ($data != null) {
            $data->fill($request->all());
            $data->save();
            return response()->json([
                'status' => '202',
                'message' => 'user add address successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->address->select()->where('user_id',$id)->get();

        return response()->json([
            'status' => '202',
            'data' => $data,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $this->address->find($id);
        $data->desc = $request->desc;
        $data->save();
        return response()->json([
            'status' => '202',
            'message' => 'user update address successfully',
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
        $data = $this->address->find($id);
        $data->delete();
        return response()->json([
            'status' => '202',
            'message' => 'user delete address successfully',
        ]);
    }
}
