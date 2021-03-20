<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderShipmentController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        Mail::to($request->user())
            ->cc($moreUsers)
            ->bcc($evenMoreUsers)
            ->queue(new OrderShipped($order));
    }
}
