@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div><button class="btn btn-primary" > <a href="services/add/service" style="color:white">new</a> </button></div>
            <div class="card">

                <div class="card-header">GMF Services</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>GMF Service list</h1>
                    @forelse ($services as $item)
                    <form method="POST" action='services/add/service/{{$item->id}}'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div><a>{{++$x.'.'.$item->name}}</a> <button class="btn btn-danger" type="submit">Delete</button> </div>
                    </form>

                        @empty
                            <div>There is No Service on the database</div>
                        @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
