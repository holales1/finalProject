@extends('app')
@section('content')
@if(isset(Auth::user()->email))

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
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
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Panel Heading</div>
                <div class="panel-body">Panel Content</div>
                <div class="panel-footer">Panel Footer</div>
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
        let name = $("input[name=url1]").val();
        let email = $("input[name=url2]").val();
        let mobile_number = jQuery('#url1').val();
        let message =jQuery('#url2').val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
          url: "/comparison",
          type:"POST",
          data:{
            url1:mobile_number,
            url2:message,
            _token: _token
          },
          success:function(response){
            $('#calculateBtn').attr("disabled", false);
            console.log(response);
            if(response) {
              $('.success').text(response.success);
              $("#ajaxform")[0].reset();
            }
          },
          });
    });
  </script>
@else
  <script>window.location = "/login";</script>
@endif
@endsection