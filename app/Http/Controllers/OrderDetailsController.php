<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\TransactionDetails;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
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
        $userDtls = new User();
        $status = 0;
        $entireFormData = $request->all();
        $formData = json_decode($entireFormData['param1'], TRUE);
        $transactionData = ($entireFormData['param2']);
        $billAmount = ($entireFormData['param3']);
        $username = ($entireFormData['param4']);
        $loggedInUserId = $userDtls->getUserId($username);
        $orderId = 'Order-Id-' . date('Ymd') . '-' . rand(10, 99);
        foreach ($formData as $orderDtls) {
            $orderModule = new OrderDetails();
            $orderModule->order_id = $orderId;
            $orderModule->user_pk_id = $loggedInUserId;
            $orderModule->menu_pk_id = $orderDtls['pk_id'];
            $orderModule->quantity = 1;            
            $orderModule->order_date = date('Y-m-d');
            $orderModule->order_status = 'Confirmed';
            $orderModule->transaction_id = $transactionData['id'];
            if ($orderModule->save()) {
                $status = 1;
            } else {
                $status = 0;
            }
        }
        $transactionDtls = new TransactionDetails();
        $transactionDtls->order_id = $orderId;
        $transactionDtls->transaction_id = $transactionData['id'];
        $transactionDtls->transaction_date = date('Y-m-d');
        $transactionDtls->bill_amount = $billAmount;
        $transactionDtls->client_email = $transactionData['email'];
        $transactionDtls->client_ip = $transactionData['client_ip'];
        $transactionDtls->card_id = $transactionData['card']['id'];
        $transactionDtls->save();

        if ($status == 1) {
            return array("success" => "1", "message" => "Order Placed Successfully");
        } else {
            return array("success" => "0", "message" => "Error While Placing Order");
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
