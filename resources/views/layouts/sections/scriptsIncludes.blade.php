<!-- laravel style -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="{{asset('assets/js/jquery.js')}}"></script>

<!-- Toaster Message JS -->
<script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>

<!-- SweetAlert Message JS -->
<script src="{{asset('assets/plugins/sweetalert2/js/sweetalert2.js')}}"></script>


<!-- DataTables Core JS -->
<script src="{{asset('assets/plugins/datatables/js/dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/dataTables.buttons.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/buttons.bootstrap5.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/buttons.colVis.min.js')}}"></script>

<script>
    var table;
    /* $(document).ready(function() {
        $.noConflict();
        table = $('#articleList').DataTable({
          paging: true, // Enable pagination
        info: true, // Enable information display
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']], // Set the length menu options
        "columnDefs": [
          { "orderable": false, "targets": [5] },//columns to be orderable
        ],
        dom:
            "<'row mb-3'<'col-md-6'Bl><'col-md-6'f>>" + // Length menu and column visibility in a row
            "<'row'<'col-sm-12'tr>>" + // Table rows
            "<'row mt-3'<'col-md-6'i><'col-md-6'p>>", // Info and pagination in a row
          buttons: [
            {
                extend: 'excel',
                className: 'btn btn-sm btn-primary ms-1' // Customize the column visibility button
            }
        ]
        }); */

  $(document).ready(function () {
    $.noConflict();
        table = $('#articleList').DataTable({
        responsive: true,
        pageLength: 10,
        paging: true, // Enable pagination
        info: true, // Enable information display
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']], // Set the length menu options
        "columnDefs": [
          { "orderable": false, "targets": [5] },//columns to be orderable
        ]
  });
});

$(document).ready(function () {
        $('.delete-btn').on('click', function () {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        });
    });
</script>
