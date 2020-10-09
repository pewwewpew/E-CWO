@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$urlaircraft.' as '.$airtype}}</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h1>Order List</h1>
                    @forelse ($viewdata as $item)
                    <form action="/aircraft/{{$item->aircraft_id}}/orders" method="POST">
                        @csrf
                        @method("PUT")

                        <div>
                            {{++$x.'.'.$item->service_name.' , '.
                            Carbon\Carbon::parse($item->o_created_at)->format('d/m/Y')}}
                        </div>
                        <div>
                            {{' ordered by '.$item->user_name}}
                        </div>
                    <div>
                        <div>
                            {{$item->id}}
                        </div>
                        @if ($item->approval == 0)
                            <div>Status : Not Approved</div>
                        @else
                            <div>Status : Approved</div>
                        @endif
                        <input type="text" value="{{$item->id}}" name="id" hidden>
                        <button>Approve</button>
                    </form>

                        <form action="/aircraft/{{$item->aircraft_id}}/{{$item->service_name}}/detail" method="get">
                            <button name="id" value="{{$item->id}}">Detail</button>
                        </form>

                    @empty
                        <div>Order Not Found!</div>
                    @endforelse
                    <div style="color:red">
                        {{ $viewdata->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
