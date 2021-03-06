@extends('layouts.app')

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
                    <div>Request Of: {{$item->user_name}}</div>
                    <div>Aircraft : {{$item->aircraft_id}}</div>
                    <div>Order Time : {{Carbon\Carbon::parse($item->o_created_at)->format('d/m/Y')}}</div>
                    <div>Manhours : {{$item->manhours}}</div>
                        @if ($item->approval == 0)
                            <div> Approval : Not Approved</div>
                        @else
                            <div> Approval : Approved</div>
                        @endif
                    <div>
                        Status : {{$item->progress_id}}
                    </div>
                    <div class="container pb-cmnt-container" style="margin-top: 10px;">
                     <div class="row">
                        <div class="col-md-12 col-md-offset-3">
                            <div class="panel panel-info">
                                <!-- comment start-->
                                <form class="col-md-12">
                                <div class="container pb-cmnt-container" style="margin-top: 10px;">
                                    <div class="media-body" style="border:solid 2px lightgrey;padding: 20px;
                                    height: 130px;width: 100%;resize: none;">
                                        <p>{{$item->remark}}</p>
                                    <div class="comment-meta">
                                </div>

                                <button class="btn btn-primary pull-right" type="button">Edit</button>
                                </form>

                            </div>
                        </div>
                    </div>
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
