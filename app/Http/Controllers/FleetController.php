<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVehicles()
    {
        return Vehicle::orderBy('created_at', 'asc')->get();
    }
    public function getSingleVehicle($id)
    {
        return Vehicle::where('id', $id)->first();
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
       // dd($request->all());
        $this->validate($request, [
            'veh_reg_number' => 'required',
            'tonnage' => 'required',
             'veh_make' => 'required',
            'veh_model' => 'required',
        ]);

        return Vehicle::create([
           'veh_reg_number' => $request['veh_reg_number'],
           'tonnage' => $request['tonnage'],
           'veh_make' => $request['veh_make'],
           'veh_model' => $request['veh_model'],
           'status' => 'available',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'veh_reg_number' => 'required',
            'tonnage' => 'required',
             'veh_make' => 'required',
            'veh_model' => 'required',
        ]);

        $customer = Vehicle::findOrFail($id);

        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Vehicle::findOrFail($id);
        $user->delete();
        return response()->json([
         'message' => 'Vehicle deleted successfully'
        ]);
    }
}
