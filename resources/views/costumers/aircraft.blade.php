@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$usercompany}} Aircraft Registration List</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Registration Number</h1>
                    @forelse ($paginatedviewdata as $item)
                      <div><a href="/aircraft/{{$item->id}}/orders">{{++$x.'.'.$item->id}}</a></div>
                    @empty
                        <div>There is No Aircraft Registration on this list</div>
                    @endforelse
                        {{$paginatedviewdata -> links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
