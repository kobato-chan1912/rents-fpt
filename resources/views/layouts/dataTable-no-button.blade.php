<script>
  $(document).ready(function () {
    let dtTable = $(".datatable").DataTable({
      {!! $customSetting ?? null !!}
      language: {
        info: "",
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search..'
      },

      responsive: false,
      ordering: false




    });
  });
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

</script>
