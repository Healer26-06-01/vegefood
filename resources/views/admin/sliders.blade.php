@extends('layouts.appadmin')
@section('title', 'Sliders')
@section('content')
    {{ Form::hidden('', $increment = 1) }}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sliders</h4>

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
                                    <th>Description One</th>
                                    <th>Description Two</th>
                                    <th>Product image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td>{{ $slider->description1 }}</td>
                                        <td>{{ $slider->description2 }}</td>
                                        <td><img src="/storage/slider_images/{{ $slider->slider_image }}" alt="">
                                        </td>


                                        @if ($slider->slider_status == 1)
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
                                                href="/editslider/{{ $slider->id }}"class="btn btn-outline-primary">Edit</a>
                                            <a href="/deleteslider/{{ $slider->id }}"class="btn btn-outline-danger"
                                                id="delete">Delete</a>
                                            @if ($slider->slider_status == 1)
                                                <a
                                                    href="/unactiveslider/{{ $slider->id }}"class="btn btn-outline-warning">Unactive</a>
                                            @endif

                                            @if ($slider->slider_status == 0)
                                                <a
                                                    href="/activeslider/{{ $slider->id }}"class="btn btn-outline-success">Active</a>
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
