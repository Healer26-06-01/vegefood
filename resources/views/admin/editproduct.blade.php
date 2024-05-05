@extends('layouts.appadmin')
@section('title', 'Edit product')
@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit product</h4>

                    {!! Form::open([
                        'action' => 'ProductController@updateproduct',
                        'class' => 'cmxform',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{ Form::hidden('id', $product->id) }}
                        {{ Form::label('', 'Product name', ['for' => 'cname']) }}
                        {{ Form::text('product_name', $product->product_name, ['class' => 'form-control', 'minlength' => '2']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('', 'Product price', ['for' => 'cname']) }}
                        {{ Form::number('product_price', $product->product_price, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('', 'Product category') }}
                        {{ Form::select('product_category', $categories, null, ['placeholder' => 'Select category', 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('', 'Product image') }}
                        {{ Form::file('product_image', ['class' => 'form-control']) }}
                    </div>



                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    <script src="{{ asset('backend/js/bt-maxLength.js') }}"></script>
@endsection
