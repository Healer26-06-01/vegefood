<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Session;

class PdfController extends Controller
{
    public function view_pdf($id)
    {

        Session::put('id', $id);
        try {
            $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_commandes_data_to_html());

            return $pdf->stream();
        } catch (\Exception $e) {
            return redirect::to('/commandes')->with('error', $e->getMessage());
        }
    }

    public function vonvert_orders_data_to_html()
    {
        $orders = Order::find(Session::get('id'));

        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
    }
}
