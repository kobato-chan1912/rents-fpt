<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  @if(Session::has("success"))
  Swal.fire({
    icon: 'success',
    title: 'Thành công!',
    text: '{{Session::get("success")}}',
  })
  @endif

  @if(Session::has("error"))
  Swal.fire({
    icon: 'error',
    title: 'Thất bại!',
    text: '{{Session::get("error")}}',
  })
  @endif

  // Start the countdown
  startCountdown();

  function startCountdown() {
    var countdownInterval = setInterval(function () {
      // Get the current values
      var days = parseInt($('#days h1').text());
      var hours = parseInt($('#hours h1').text());
      var minutes = parseInt($('#mins h1').text());
      var seconds = parseInt($('#seconds h1').text());

      // Update the countdown
      if (seconds > 0) {
        seconds--;
      } else {
        seconds = 59;
        if (minutes > 0) {
          minutes--;
        } else {
          minutes = 59;
          if (hours > 0) {
            hours--;
          } else {
            hours = 23;
            if (days > 0) {
              days--;
            } else {
              clearInterval(countdownInterval);
              // Countdown finished
              return;
            }
          }
        }
      }

      // Update the HTML elements
      $('#days h1').text(days);
      $('#hours h1').text(hours);
      $('#mins h1').text(minutes);
      $('#seconds h1').text(seconds);
    }, 1000);
  }



  $(function () {

    $("#rateYo").rateYo({
      fullStar: true,
      onChange: function (rating) {

        $("#star").val(rating);
      }
    });
  });
</script>
