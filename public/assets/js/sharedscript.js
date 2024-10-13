        $(document).ready(function() {


            







            //carts operation
            $(document).on('click', 'button.plus-quantity', function(e) {
                e.preventDefault();
                var url = $(this).data('route');
                $.ajax({
                    url: url,
                    method: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: translations.Success,
                            text: 'Item quantity increased',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        if (response['route'] == 'cartsidebar') {
                            $('#usercart').html(response['view']);
                            $('.opencartsidebar').trigger('click');
                        } else if (response['route'] == 'cartpagedetails') {
                            $('#cartcomponentsection').html(response['view']);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }

                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.error) {
                            Swal.fire({
                                title: translations.Error,
                                text: xhr.responseJSON.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }); // Display the error message
                        } else {
                            Swal.fire({
                                title: translations.Error,
                                text: 'An unexpected error occurred',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }); // Fallback error message using translation
                        }
                        Swal.fire({
                            title: translations.Error,
                            text: 'An unexpected error occurred',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $(document).on('click', 'button.minus-quantity', function(e) {
                e.preventDefault();
                var url = $(this).data('route');
                $.ajax({
                    url: url,
                    method: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: translations.Success,
                            text: 'Item quantity decreased',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        if (response['route'] == 'cartsidebar') {
                            $('#usercart').html(response['view']);
                            $('.opencartsidebar').trigger('click');
                        } else if (response['route'] == 'cartpagedetails') {
                            $('#cartcomponentsection').html(response['view']);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            title: translations.Error,
                            text: 'An unexpected error occurred',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $(document).on('click', 'button.delete-item', function(e) {
                e.preventDefault();
                var url = $(this).data('route');
                $.ajax({
                    url: url,
                    method: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response['route'] == 'cartsidebar') {
                            $('#usercart').html(response['view']);
                            $('.opencartsidebar').trigger('click');
                        } else if (response['route'] == 'cartpagedetails') {
                            $('#cartcomponentsection').html(response['view']);
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            title: translations.Error,
                            text: 'An unexpected error occurred',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $(document).on('click', 'button.additem', function(e) {
                e.preventDefault();
                let form = $(this).closest('form')[0]; // Find the closest form to the clicked button
                let data = new FormData(form);
                var url = $(this).data('route');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('.modal').modal('hide');
                        $('#usercart').html(response);
                        $('.opencartsidebar').trigger('click');
                        Swal.fire({
                            title: translations.Success,
                            text: 'Item added to cart uccessfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.error) {
                            Swal.fire({
                                title: translations.Error,
                                text: xhr.responseJSON.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }); // Display the error message
                        } else {
                            Swal.fire({
                                title: translations.Error,
                                text: 'An unexpected error occurred',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }); // Fallback error message
                        }
                    }
                });
            });

            //carts operation
        });




