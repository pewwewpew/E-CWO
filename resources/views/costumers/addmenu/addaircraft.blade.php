@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Aircraft Registration</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Aircraft Registration Form</h1>
                    <br>
                    <form action="/add-data/aircraft-registration" method="POST">
                        @csrf

                        <!--input aircraft-->
                        <div>
                            <input type="text" name="aircraft_number" placeholder="aircraft number">
                        </div>
                        <div>
                            Aircraft Owner
                        </div>
                        <div>
                            <select class="form-control" id="companies" name="company">
                                @forelse ($company as $item2)
                            <option>{{$item2->id}}</option>
                                @empty
                                <div>There is No Company</div>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            Aircraft Type
                        </div>
                        <div>
                            <select class="form-control" id="category" name="type">
                                @forelse ($airtype as $item1)
                            <option>{{$item1->id}}</option>
                                @empty
                                <div>There is No Aircraft Type</div>
                                @endforelse
                            </select>
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
