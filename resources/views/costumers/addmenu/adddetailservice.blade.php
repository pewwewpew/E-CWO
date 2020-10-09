@extends('layouts.adminapp')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Detail Service</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Detail Service Form</h1>
                    <br>
                    <form action="/add-data/detail-service" method="POST">
                        @csrf
                        <!--input new service-->
                        <label>Service Name</label>
                        <div>
                            <select class="form-control" id="category" name="service">
                                @forelse ($service as $item)
                            <option>{{$item->name}}</option>
                                @empty
                                <option>There is No service in database</option>
                                @endforelse
                            </select>
                        </div>
                        <label>Aircraft Type</label>
                        <div>
                            <select class="form-control" id="category" name="type">
                                @forelse ($airtype as $item)
                            <option>{{$item->id}}</option>
                                @empty
                                <option>There is No Aircraft Registration in database</option>
                                @endforelse
                            </select>
                        </div>

                        <label>Man Hours</label>
                        <div>

                            <input type="text" name="manhours" placeholder="man hours">
                        </div>
                        <!--add service input button-->
                        <br>
                        <button class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
