@extends('layouts.appadmin')
@section('title', 'Categoties')
@section('content')
    {{ Form::hidden('', $increment = 1) }}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Categoties</h4>

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
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>

                                            <a href="/editcategory/{{ $category->id }}"class="btn btn-primary">Edit</a>
                                            <a href="/deletecategory/{{ $category->id }}"class="btn btn-danger"
                                                id="delete">Delete</a>

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
