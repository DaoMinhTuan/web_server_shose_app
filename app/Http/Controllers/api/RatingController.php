<?php

namespace App\Http\Controllers\api;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $ratings = new Rating();

        $url = asset('uploads');
        $name = $url . "/" . time() . rand(1, 100) . '.' . $request->image->extension();
        $request->image->move(public_path('/uploads'), $name);
        $ratings->fill($request->all());
        $ratings->image = $name;
        $ratings->save();
        
        return response()->json([
            'status' =>'202',
            'message' => 'rating successfully'
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
        $ratings = new Rating();
        $data = $ratings
        ->join('users', 'users.id', '=', 'ratings.user_id')
        ->select('users.name as username','users.avatar','ratings.*',)
        ->where([['ratings.product_id', '=', $id]])
        ->get();

        return response()->json([
            'data' => $data
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
        //
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
}
