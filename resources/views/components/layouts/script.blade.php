<!-- General JS Scripts -->
<script src="{{ asset('/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/modules/popper.js') }}"></script>
<script src="{{ asset('/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('/assets/js/stisla.js') }}"></script>
<script src="{{ asset('/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('/assets/js/scripts.js') }}"></script>
<script src="{{ asset('/assets/js/custom.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (isset($_SESSION['success']))
            swal({
                title: "Success",
                text: `<?php echo $_SESSION['success']; ?>`,
                icon: "success",
            });
        @endif

        @if (isset($_SESSION['error']))
            swal({
                title: "Error",
                text: `<?php echo $_SESSION['error']; ?>`,
                icon: "error",
            });
        @endif
    });
</script>
