@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Service</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Service Form</h1>
                    <br>
                    <form action="/add-data/service" method="POST">
                        @csrf
                        <!--input aircraft-->
                        <div>
                            <input type="text" name="service" placeholder="service name">
                        </div>
                        <br>
                        <!--order input button-->
                        <br>
                        <button class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
