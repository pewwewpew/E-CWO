@extends('layouts.'.$role.'app')

@if ($role == 'Admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Order</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Order Form</h1>
                    <br>
                    <form action="/add-data/order" method="POST">
                        @csrf
                        <!--input new order-->
                        <!-- service list-->
                        <div>
                            Service
                        </div>
                        <div class="decide-manhours">
                            <select class="form-control service" id="service" name="service">
                                <option>Select Service</option>
                                @forelse ($service as $item)
                                <option>{{$item->name}}</option>
                                    @empty
                                    <option>There is No service in database</option>
                                    @endforelse
                            </select>
                        </div>
                        <br>
                        <!-- company list-->
                        <div>Company</div>
                        <div>
                            <select class="form-control" id="company" name="company">
                                <option>Select Company</option>
                                @forelse ($company as $item)
                                        <option>{{$item->id}}</option>
                                @empty
                                    <option>There is No Company data to show in the list</option>
                                @endforelse
                            </select>
                        </div>
                        <br>
                        <!-- start aircraft-dropdown -->
                        <div class="aircraft-dropdown">
                            <div>
                                Aircraft Registration
                            </div>
                            <div class="aircraft-list decide-manhours">
                                @include('dynamicview.aircraftdropdown')
                            </div>
                        </div><!-- end aircraft-dropdown -->
                        <br>
                        <div class="manhours-view">
                            @include('dynamicview.manhours')
                        </div>
                        <!--start user-dropdown-->
                        <br>
                        <div>Requested User</div>
                        <div class="user-view">
                            @include('dynamicview.userdropdown')
                        </div>
                        <!--end user-dropdown-->

                        <!--start comment-->
                        <br>
                        <div>Remark</div>
                        <div class="container pb-cmnt-container" style="margin-top: 10px;">
                            <div class="row">
                               <div class="col-md-12 col-md-offset-3">
                                   <div class="panel panel-info">
                                       <div class="panel-body">
                                           <textarea placeholder="Write your comment here!" name="remark" class="pb-cmnt-textarea" style="resize: none;
                                           padding: 20px;
                                           height: 130px;
                                           width: 100%;
                                           border: 2px solid #black;"></textarea>

                                       </div>
                                   </div>
                               </div>
                           </div>
                        <!--end comment-->
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

<!--script here-->
@section('script')
<script>

    function showaircraft(company_id)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/add-data/order/get-aircraft",
            type: 'GET',
            data:{
                'companyid':company_id,
            },
            dataType:"html",

        });//end of ajax
    }//end of aircraft show

    function showuser(company_id)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/add-data/order/get-users",
            type: 'GET',
            data:{
                'companyid':company_id,
            },
            dataType:"html",

        });//end of ajax
    }//end of aircraft show


    function showmanhours(aircraft,service)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/add-data/order/get-manhours",
            type: 'GET',
            data:{
                'aircraft':aircraft,
                'service':service,
            },
            dataType:"html",

        });//end of ajax
    }//end of manhours show

    function selectcompany()
    {
        var company = $("#company").val();
        console.log(company);
        var ajaxshowaircraft = showaircraft(company);
        var ajaxshowuser = showuser(company);

        ajaxshowaircraft.done(function(response){
                   console.log("success");
                   $('.aircraft-list').html(response);
                //end of ajax success
            })
        ajaxshowuser.done(function(response){
               console.log("ajax user success");
               $('.user-view').html(response);
            //end of ajax success
        })
    }

    function selectservice()
    {
        var service = $("#service").val();
        console.log(service);
    }

    function selectaircraftorservice()
    {
        var aircraft = $(".aircraft").val();
        var service = $(".service").val();
        var ajaxshowmanhours = showmanhours(aircraft,service);

        ajaxshowmanhours.done(function(response){
            console.log("showmanhours ajax success");
            $('.manhours-view').html(response);
            });//end of ajax success)

    }

//start script




$(document).ready(function(){

$("#company").change(selectcompany);//select from company dropdown
$("#service").change(selectservice);//select from service dropdown
//select from aircraft dropdown
$(".decide-manhours").on("change",'select',function(){
    selectaircraftorservice()
});

});//end script

</script>
@endsection

@else
<!-- start add-data/order for costumer -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Order</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>New Order Form</h1>
                    <br>
                    <form action="/add-data/order" method="POST">
                        @csrf
                        <!--input new order-->
                        <!-- service list-->
                        <div>
                            Service
                        </div>
                        <div class="decide-manhours">
                            <select class="form-control service" id="service" name="service">
                                <option>Select Service</option>
                                @forelse ($service as $item)
                                <option>{{$item->name}}</option>
                                    @empty
                                    <option>There is No service in database</option>
                                    @endforelse
                            </select>
                        </div>
                        <br>

                        <!-- start aircraft-dropdown -->
                        <div class="aircraft-dropdown">
                            <div>
                                Aircraft Registration
                            </div>
                            <div class="aircraft-list decide-manhours">
                                @include('dynamicview.aircraftdropdown')
                            </div>
                        </div><!-- end aircraft-dropdown -->
                        <div class="manhours-view">
                            @include('dynamicview.manhours')
                        </div>
                        <!--start comment-->
                        <br>
                        <div>Remark</div>
                        <div class="container pb-cmnt-container" style="margin-top: 10px;">
                            <div class="row">
                               <div class="col-md-12 col-md-offset-3">
                                   <div class="panel panel-info">
                                       <div class="panel-body">
                                           <textarea placeholder="Write your comment here!" name="remark" class="pb-cmnt-textarea" style="resize: none;
                                           padding: 20px;
                                           height: 130px;
                                           width: 100%;
                                           border: 2px solid #black;"></textarea>

                                       </div>
                                   </div>
                               </div>
                           </div>
                        <!--end comment-->
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

@section('script')
<script>

    function showaircraft(company_id)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/add-data/order/get-aircraft",
            type: 'GET',
            data:{
                'companyid':company_id,
            },
            dataType:"html",

        });//end of ajax
    }//end of aircraft show


    function showmanhours(aircraft,service)
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/add-data/order/get-manhours",
            type: 'GET',
            data:{
                'aircraft':aircraft,
                'service':service,
            },
            dataType:"html",

        });//end of ajax
    }//end of manhours show


    function selectservice()
    {
        var service = $("#service").val();
        console.log(service);
    }

    function selectaircraftorservice()
    {
        var aircraft = $(".aircraft").val();
        var service = $(".service").val();
        var ajaxshowmanhours = showmanhours(aircraft,service);

        ajaxshowmanhours.done(function(response){
            console.log("showmanhours ajax success");
            $('.manhours-view').html(response);
            });//end of ajax success)

    }

//start script


$(document).ready(function(){

$("#service").change(selectservice);//select from service dropdown
//select from aircraft dropdown
$(".decide-manhours").on("change",'select',function(){
    selectaircraftorservice()
});

});//end script
</script>
@endsection

@endif
<!-- end add-data/order for costumer -->
