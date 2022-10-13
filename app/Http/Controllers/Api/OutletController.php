<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\OutletResource;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $outlets = Outlet::where('user_id', Auth::user()->id)->get();
        return response()->json($outlets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);

        if($validator->fails()){
            return  new OutletResource($validator->errors());
        }

        $outlet = new Outlet();
        $outlet->user_id = Auth::user()->id;
        $outlet->name = $request->name;
        $outlet->phone = $request->phone;
        $outlet->latitude = $request->latitude;
        $outlet->longitude = $request->longitude;
        $outlet->image = $request->image;
        $outlet->save();
        return  new OutletResource($outlet);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
        $outlet = Outlet::where('id', $id)->first();
        return new OutletResource($outlet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);

        if($validator->fails()){
            return  new OutletResource($validator->errors());
        }

        $outlet = Outlet::where('id', $id)->first();
        $outlet->name = $request->name;
        $outlet->phone = $request->phone;
        $outlet->latitude = $request->latitude;
        $outlet->longitude = $request->longitude;
        $outlet->image = $request->image;
        $outlet->update();
        return  new OutletResource($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Outlet::find($id)->delete();
        return response(null, 204);
    }

    /**
     * validation check.
     *
     * @param  int  $id
     * @return
     */
    public function show_outlet_google_map()
    {
        $outlets = Outlet::where('user_id', Auth::user()->id)->select('name','latitude', 'longitude')->get();
        return response()->json($outlets);
    }

    public function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',
        ]);

        return $validator;
    }


}
