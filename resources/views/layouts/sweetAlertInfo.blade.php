<script>

  @if(Session::has("success"))
  Swal.fire({
    icon: 'success',
    title: 'Thành công!',
    text: '{{Session::get("success")}}',
    customClass: {
      confirmButton: 'btn btn-warning'
    },
    buttonsStyling: false
  })
    @if(Session::has("redirectUrl"))
    .then(function() {
      window.open(decodeURIComponent('{{ rawurlencode(Session::get("redirectUrl")) }}'));

    })
    @endif
  @endif

  @if(Session::has("error"))
  Swal.fire({
    icon: 'error',
    title: 'Thất bại!',
    text: '{{Session::get("error")}}',
    customClass: {
      confirmButton: 'btn btn-warning'
    },
    buttonsStyling: false
  });
  @endif
  @if(Session::has("info"))
  Swal.fire({
    icon: 'info',
    title: 'Thông tin!',
    text: '{{Session::get("info")}}',
    customClass: {
      confirmButton: 'btn btn-warning'
    },
    buttonsStyling: false
  });
  @endif
</script>
