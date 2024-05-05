@extends('layouts.appadmin')
@section('title', 'Products')
@section('content')
    {{ Form::hidden('', $increment = 1) }}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Products</h4>

            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Product name</th>
                                    <th>Product price</th>
                                    <th>Product category</th>
                                    <th>Product image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price }}$</td>
                                        <td>{{ $product->product_category }}</td>
                                        <td><img src="/storage/product_images/{{ $product->product_image }}" alt="">
                                        </td>


                                        @if ($product->product_status == 1)
                                            <td>
                                                <label class="badge badge-success">Actived</label>
                                            </td>
                                        @else
                                            <td>
                                                <label class="badge badge-danger">Unactive</label>
                                            </td>
                                        @endif


                                        <td>
                                            <a
                                                href="/editproduct/{{ $product->id }}"class="btn btn-outline-primary">Edit</a>
                                            <a href="/deleteproduct/{{ $product->id }}"class="btn btn-outline-danger"
                                                id="delete">Delete</a>
                                            @if ($product->product_status == 1)
                                                <a
                                                    href="/unactiveproduct/{{ $product->id }}"class="btn btn-outline-warning">Unactive</a>
                                            @endif

                                            @if ($product->product_status == 0)
                                                <a
                                                    href="/activeproduct/{{ $product->id }}"class="btn btn-outline-success">Active</a>
                                            @endif
                                        </td>
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
