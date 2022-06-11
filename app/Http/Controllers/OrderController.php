<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\InfobipEmailHelper;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOrders()
    {
        
        return Order::with('vehicle', 'customer')->orderBy('created_at', 'asc')->get();
    }

    public function actionOrder(Request $request, $id)
    {
       
        try {
            $order = Order::findOrFail($id);
            $order->status = $request->status;

            if ($order->save()) {

                if ( $request->status == 'dispatched') {
                    $view_path = 'emails.notify';
                    $subject = 'Your order number ' . $order['order_number'].  ' has been Dispatched';
                    $email = Customer::where('id', Order::where('id', $id)->first()['customer_id'])->first()['email'];

                    $data = [
                        'order_number' =>  $order['order_number'],
                        'name' => Customer::where('id', Order::where('id', $id)->first()['customer_id'])->first()['name']
                    ];

                    $emailResp = InfobipEmailHelper::NotifyEvent($subject, $view_path, $email, $data);
                }
                
                return response()->json([
                    'message' => 'Status Successfully Updated',
                    'status' => 200,
                ]);
            }
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->json([
                    'errors' => 404,
                ]);
            }
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
