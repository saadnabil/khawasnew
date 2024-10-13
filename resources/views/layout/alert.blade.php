{{ Session::get('success') }}
@if($message = Session::get('success'))
    <script>
        Swal.fire({
            text: "<?php echo $message ?>",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "<?php echo __('Ok') ?>",
            customClass: {
                confirmButton: "btn btn-success"
            }
        });
    </script>
@endif

@if($message = Session::get('error'))
    <script>
        Swal.fire({
            text: "<?php echo $message ?>",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "<?php echo __('Ok') ?>",
            customClass: {
                confirmButton: "btn btn-danger"
            }
        });
    </script>
@endif

<script>
    $('.confirm-delete').click(function(e){
        e.preventDefault();
        Swal.fire({
            html: `{{ __("Are you sure to delete this item ?") }}`,
            icon: "info",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "{{ __('Confirm') }}",
            cancelButtonText: "{{ __('Cancel') }}",
            customClass: {
                confirmButton: "btn btn-danger swalmargin m-1",
                cancelButton: 'btn btn-primary swalmargin m-1'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).next('form').submit();
            }
        });
        return false;
    });
</script>

<script>
    $('.confirm-cancel').click(function(e){
        e.preventDefault();
        Swal.fire({
            html: `{{ __("Are you sure to cancel this order ?") }}`,
            icon: "info",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "{{ __('Confirm') }}",
            cancelButtonText: "{{ __('Cancel') }}",
            customClass: {
                confirmButton: "btn btn-danger swalmargin m-1",
                cancelButton: 'btn btn-primary swalmargin m-1'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).next('form').submit();
            }
        });
        return false;
    });
</script>


