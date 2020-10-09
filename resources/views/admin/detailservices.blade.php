@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div><button class="btn btn-primary" > <a href="/add-data/detail-service" style="color:white">new</a> </button></div>
            <div class="card">

                <div class="card-header">GMF Detail Services</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>GMF Service list</h1>
                    <select class="form-control input-lg dynamic" id="airtype" name="airtype"   data-dependent="manhour">
                        <option value="default">Select Aircraft Type</option>

                            @forelse ($airtypeid as $item)
                                @if($item == 1)
                                <option value="{{$item}}" selected>{{$item}}</option>
                                @else
                                <option value="{{$item}}">{{$item}}</option>
                                @endif

                            @empty
                            <div>There is No Company</div>
                            @endforelse
                        </select>
                        <br>
                        <br>
                    <div class="detail-services">
                        @include('dynamicview.detailservice')
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    //set selected detail service
    function showaircraft(airtype)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        $.ajax({

            url: "/detail-services?",
            type: 'GET',
            data:{
                'airtype':airtype,
            },
            dataType:"html",
            success:function(response){
               $('.detail-services').empty();
               $('.detail-services').html(response);

            }//end of ajax success
        });//end of ajax
    }//end of  selected detail service


    //check condition from company dropdown
    function condition(airtype){

        if(airtype != "default")
        {
            showaircraft(airtype);
        }
        else if(airtype == "default")
        {
            //console.log('company null');
        }
        else
        {
            //console.log('both null');
        }
    }

    function getairtype(){
        console.log('selected');
        var airtype = $("#airtype").val();
        condition(airtype);
    }


    //start script
    $(document).ready(function(){

    $("#airtype").change(getairtype,);//select from company dropdown

    });
</script>
@endsection
