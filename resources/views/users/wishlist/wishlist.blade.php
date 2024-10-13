@extends('layout.UserMatser')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">


<h2 class="page-title d-none d-sm-block">{{__('translation.Wishlist')}}</h2>
<br>
<div class="row" id="myProducts">


    @include('users.wishlist.wishlist-items')


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $(document).on('click', 'button.additem', function(e) {
            e.preventDefault();

            let form = $('#additem')[0];
            let data = new FormData(form);
            let url = $(this).data('route');

            $.ajax({
                url: url
                , method: 'POST'
                , data: data
                , processData: false
                , contentType: false
                , success: function(response) {
                    $('.modal').modal('hide'); // Hide any modal if open
                    $('#usercart').html(response); // Update cart HTML
                    $('.opencartsidebar').trigger('click'); // Trigger click to open cart sidebar
                }
                , error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.error) {
                        alert(xhr.responseJSON.error); // Display the error message
                    } 
                }
            });
        });


         $(document).on('click', 'a.addwishlist', function(e) {
            e.preventDefault();
            var url = $(this).data('route');
            var element = $(this);
            $.ajax({
                url: url
                , method: 'GET'
                , processData: false
                , contentType: false
                , success: function(response) {
                    if (response.status === 1) {
                        element.addClass('text-danger');
                    } else {
                        element.removeClass('text-danger');
                    }

                    $('#myProducts').html(response.view);
                }
                , error: function() {
                    alert('An error occurred while processing your request.');
                }
            });
        });







});




</script>


@endsection
