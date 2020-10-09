@extends('layouts.testapp')

@section('content')
<body>

    <div class="container pb-cmnt-container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <textarea placeholder="Write your comment here!" class="pb-cmnt-textarea" style="resize: none;padding: 20px;height: 130px;width: 100%;border: 1px solid white" readonly></textarea>
                        <form class="form-inline">
                            <div class="btn-group" style="border: 1px solid red">

                            </div>

                            <!-- start edit button-->
                            <div class="btn-grp">
                                <div class="selectedbtn">
                                    <button class="editbtn btn btn-primary pull-left" type="button" style="border: 1px solid black">Edit</button>
                                </div>
                                <div class="selectedbtn2">
                                    <button class="editbtn2 btn btn-primary pull-left" id="cancel" type="button" style="border: 1px solid black">Cancel</button>
                                    <button class="editbtn2 btn btn-primary pull-left" id="save" type="button" style="border: 1px solid black">Save</button>
                                </div>
                                <div class="selectedbtn3">

                                </div>
                            </div>
                            <!-- end edit button-->

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- start ajax dropdown search -->
            <div class="container">
                <h2>Pencarian Autocomplete di Laravel Menggunakan Ajax</h2>
                <br/>
                <select class="cari form-control" style="width:500px;" name="cari"></select>
                <input type="text" class="form-control" style="width:500px;" name="cari" placeholder="customer....">
            </div>

        <!-- autocomplete bootstrap -->
        <select class="js-example-basic cari form-control" name="cari" multiple="multiple"></select>



</body>
@endsection


@section('script')
<script>

    function editcomment()
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/test/get-dinamic",
            type: 'GET',
            dataType:"html",

        });//end of ajax
    }//end of aircraft show

    function editcomment2()
    {
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });//end of ajax setup

        return $.ajax({

            url: "/test/get-dinamic2",
            type: 'GET',
            dataType:"html",

        });//end of ajax
    }//end of aircraft show


    $('.cari').select2({
        placeholder: 'Cari...',
        ajax: {
          url: '/cari',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                return {
                  text: item.email,
                  id: item.id
                }
              })
            };
          },
          cache: true
        }//end ajax
    });


    function test()
    {
        var ajaxshowmanhours = editcomment();
        var ajaxshowmanhours2 = editcomment2();

        ajaxshowmanhours.done(function(response){
            ajaxshowmanhours2.done(function(response){
                console.log("test selesai");
                 $('.selectedbtn2').html(response);
                });//end of ajax success)

            console.log("test selesai");
            $('.selectedbtn').html(response);

            });//end of ajax success)

    }

//start script


$(document).ready(function(){
    $(".editbtn2").hide();
    $(".editbtn3").hide();
    //select from aircraft dropdown
    $(".editbtn").on("click",function(){
        $(".editbtn").hide();
        $(".editbtn2").show();
        $(".editbtn3").show();
    });
    $("#cancel").on("click",function(){
        $(".editbtn").show();
        $(".editbtn2").hide();
        $(".editbtn3").hide();
    });
    $("#save").on("click",function(){
        $(".editbtn").show();
        $(".editbtn2").hide();
        $(".editbtn3").hide();
    });

});//end script
</script>
@endsection
