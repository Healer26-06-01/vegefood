@extends('layouts.appadmin')
@section('title', 'Edit category')
@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit category</h4>


                    {!! Form::open([
                        'action' => ['CategoryController@updatecategory', $category->id],
                        'class' => 'cmxform',
                        'method' => 'POST',
                    ]) !!}

                    {{ csrf_field() }}

                    <div class="form-group">
                        {{ Form::hidden('id', $category->id) }}
                        {{ Form::label('', 'Product category', ['for' => 'cname']) }}
                        {{ Form::text('category_name', $category->category_name, ['class' => 'form-control', 'minlength' => '2']) }}
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
