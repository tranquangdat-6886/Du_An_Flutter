<!-- jQuery -->
<script src="{{ URL::asset('public/backend/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('public/backend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('public/backend/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('public/backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('public/backend/dist/js/demo.js') }}"></script>

<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    var api_url = '{{ url('admin') }}';

    var toggleButton = document.querySelector('.toggle-password');
    var passwordField = document.getElementById('password');

    toggleButton.addEventListener('click', function() {
        toggleButton.classList.toggle('active');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    });
</script>
