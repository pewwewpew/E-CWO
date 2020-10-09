@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Company</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Company Form</h1>
                    <br>
                    <form action="/add-data/company" method="POST">
                        @csrf
                        <!--input aircraft-->
                        <div>
                            <input type="text" name="company" placeholder="company name">
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
