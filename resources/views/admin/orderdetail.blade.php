@extends('layouts.adminapp')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
            <div class="card-header form-inline">
                <div class="col-md-11 text">Order Detail</div>
                <form action="{{$url}}" method="get">
                    <button class="btn btn-primary pull-right">Back</button>
                </form>

            </div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($viewdata as $item)
                    <h1>{{$item->service_name}}</h1>
                    <div>Requested By: {{$item->user_name}}</div>
                    <div>Request Target: {{$item->target_name}}</div>
                    <div>Aircraft : {{$item->aircraft_id}}</div>
                    <div>Order Time : {{Carbon\Carbon::parse($item->o_created_at)->format('d/m/Y')}}</div>
                    <div>Manhours : {{$item->manhours}}</div>
                        @if ($item->approval == 0)
                            <div> Status : Not Approved</div>
                        @else
                            <div> Status : Approved</div>
                        @endif
                    <div>
                        Status : {{$item->progress_id}}
                    </div>
                    <!-- comment start-->
                    <div class="container pb-cmnt-container" style="margin-top: 10px;">
                        <div class="media-body" style="border:solid 2px lightgrey;padding: 20px;
                        height: 130px;width: 100%;resize: none;">
                            <p>{{$item->remark}}</p>
                            <div class="comment-meta">

                    </div>
                    @empty
                        Detail is not found!
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
