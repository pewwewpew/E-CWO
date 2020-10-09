@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">GMF Costumer Companies</div>

                <div class="card-body" style="text-align:center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>GMF companies costumer list</h1>
                     <!-- company dropdown -->
                    <div>
                        <select class="form-control input-lg dynamic" id="company" name="company"   data-dependent="manhour">
                        <option value="default">Select Company</option>

                            @forelse ($companies as $item)
                                @if($item == $companyid)
                                <option value="{{$item}}" selected>{{$item}}</option>
                                @else
                                <option value="{{$item}}">{{$item}}</option>
                                @endif

                            @empty
                            <div>There is No Company</div>
                            @endforelse
                        </select>
                    </div>
                    <!-- company dropdown end -->

                    <!-- aircraft dropdown start -->
                    <br><br>
                    <h3>GMF Aircraft list</h3>


                </div>
                <!-- aircraft dropdown start -->
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>

    //set aircraft show
    function showaircraft(company_id,page)
    {
        console.log(company_id);
        console.log(page);
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        $.ajax({

            url: "/admin/aircraft?page="+page,
            type: 'GET',
            data:{
                'companyid':company_id,
            },
            dataType:"html",
            success:function(response){
               $('.aircraft-list').empty();
               $('.aircraft-list').html(response);

            }//end of ajax success
        });//end of ajax
    }//end of aircraft show

    //change page
    function change(company_id)
    {
        console.log(company_id)
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        $.ajax({

            url: "/admin/aircraft",
            type: 'GET',
            data:{
                'companyid':company_id,
            },
            dataType:"html",
            success:function(response){
               $('.aircraft-list').empty();
               $('.aircraft-list').html(response);

            }//end of ajax success
        });//end of ajax
    }//end of change page

    //check condition from company dropdown
    function condition(company_id,page){

        if(company_id != "default")
        {
            showaircraft(company_id,page);
        }
        else if(company_id == "default")
        {
            //console.log('company null');
        }
        else
        {
            //console.log('both null');
        }
    }

    function getcompany(){
        console.log('selected');
        var company_id = $("#company").val();
        var page = $(".aircraft-list").attr("value");
        console.log('change');
        console.log('page');
        condition(company_id,page);
    }


    //start script
    $(document).ready(function(){

    $("#company").change(getcompany,);//select from company dropdown
    $(document).on('click','.pagination a',function (event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var company_id = $("#company").val();
        var page = $(this).attr('href').split('page=')[1];;
        console.log('company_id');
        console.log('page');
        showaircraft(company_id,page)
    });//click page number dropdown

    });
</script>


@endsection
