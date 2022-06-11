<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')
        ->with('count_loading_vehicles', Vehicle::where('status', 'loading')->count())
        ->with('count_available_vehicles', Vehicle::where('status', 'available')->count())
        ->with('count_on_transit_vehicles',Vehicle::where('status', 'dispatched')->count())
        ->with('count_pending_orders', Order::where('status', 'pending')->count())
        ->with('count_dispatched_orders', Order::where('status', 'dispatched')->count())
        ->with('count_delivered_orders', Order::where('status', 'delivered')->count())
        ->with('count_loading_orders', Order::where('status', 'loading')->count());
    }
    public function customers()
    {
        return view('customers');
    }
    public function fleet()
    {
        return view('fleet');
    }
}
