$(function() {
  $('#postTable').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true, 
    "autoWidth": false,
    "responsive": true,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#postTable_wrapper .col-md-6:eq(0)');

  $('#memberTable').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true, 
    "autoWidth": false,
    "responsive": true,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#memberTable_wrapper .col-md-6:eq(0)');

  $('#facultyTable').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true, 
    "autoWidth": false,
    "responsive": true,
    "buttons": ["copy", "csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#facultyTable_wrapper .col-md-6:eq(0)');
});