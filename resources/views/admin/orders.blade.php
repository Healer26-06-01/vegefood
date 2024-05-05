@extends('layouts.appadmin')
@section('title', 'Orders')
@section('content')
    {{ Form::hidden('', $increment = 1) }}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Orders</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Client name</th>
                                    <th>Address</th>
                                    <th>Cart</th>
                                    <th>Payment id</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>
                                            @foreach ($order->cart->items as $item)
                                                {{ $item['product_name'] . ',' }}
                                            @endforeach
                                        </td>
                                        <td>{{ $order->payment_id }}</td>

                                        <a href="/view_pdf/{{ $order->id }}"class="btn btn-outline-warning">Unactive</a>

                                    </tr>
                                    {{ Form::hidden('', $increment = $increment + 1) }}
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/data-table.js') }}"></script>
@endsection
