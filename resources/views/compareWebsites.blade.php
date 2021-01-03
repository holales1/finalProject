@extends('app')

@section('content')

@if(isset(Auth::user()->email))

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
  <div class="container">
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-1">
                <form id="ajaxform">
                    <div class="p-6">
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                <input type="text" class="form-control" id="url1" aria-describedby="emailHelp" placeholder="First Url">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                        </div>
                        <div class="ml-12">
                            <input class="form-control" type="text" placeholder="Second Url" id="url2">
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="calculateBtn" class="btn btn-success save-data">Calculate</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-12 md:grid-cols-12">
                <div class="flex items-center">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Url 1</th>
                            <th scope="col">Url 2</th>
                            <th scope="col">Score</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    </div>
  </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

    $("#calculateBtn").click(function(event){
        event.preventDefault();
        $("#calculateBtn").attr("disabled", true);
        let url1 = jQuery('#url1').val();
        let url2 =jQuery('#url2').val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/comparison",
          type:"POST",
          data:{
            url1:url1,
            url2:url2,
            _token: _token
          },
            success:function(response){
              $('#calculateBtn').attr("disabled", false);
              $("#ajaxform")[0].reset();
              console.log(response);
              if(response === 'Error'){
                console.log("fdsfs");
                alert("There is an error with any of the url");
              }else{
                $.ajax({
                    type: "get",
                    url: "data.json",
                    success: function (data) {
                      console.log(data.data);
                      console.log(data.data.length);
                      $("#tbody").empty();
                      for(var i=0;i<data.data.length;i++)
                      {
                        var Html="<tr> <td></td>  <td>"+data.data[i].sentence1+"</td> <td>"+data.data[i].sentence2+"</td> <td>"+data.data[i].score+"</td>  </tr>";
                        $('#tbody').append(Html);
                      }
                    }
                });
              }
              /*if(response) {
                console.log("gasdgasd");
                $('.success').text(response.success);
                
              }*/
            },
          });
    });
  </script>
@else
  <script>window.location = "/login";</script>
@endif
@endsection
