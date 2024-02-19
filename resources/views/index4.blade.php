<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Quét mã thanh toán</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Corben&family=Mulish&family=Outfit&family=Raleway:wght@300&display=swap");

    body {
      width: auto;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0px;
      background: #d3dfed;
    }

    #qrCodeBox {
      height: 550px;
      width: 355px;
      background: #fffffd;
      border-radius: 20px 20px 20px 20px;
    }

    #qrCodeSquareFrame {
      width: 320px;
      height: 320px;
      background: #2b7dfa;
      border-radius: 10px;
      margin: 17px;
      border: solid 1px #4677c6;
      position: relative;
    }

    .centered {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #qrcode {
      mix-blend-mode: screen;
    }

    #bubble_01 {
      width: 210px;
      height: 180px;
      background: #3685fe;
      position: absolute;
      border-radius: 15px 0 15rem 0;
    }

    #bubble_02 {
      width: 155px;
      height: 110px;
      background: #3685fe;
      position: absolute;
      top: 210px;
      left: 165px;
      border-radius: 100% 0 10px 0;
    }

    .text {
      width: 90%;
      flex-direction: column;
      text-align: center;
      font-family: Outfit;
      font-size: 18px;
      color: #75767a;
      margin: 10px;
    }

    #one {
      font-weight: 700;
      font-size: 25px;
      color: #101b39;
    }

    #two {
      margin-top: -7px;
    }

  </style>

</head>
<body>
<!-- partial:index.partial.html -->
<div id="qrCodeBox">
  <div id="qrCodeSquareFrame">
    <div id="bubble_01"></div>
    <div id="bubble_02"></div>
    <div class="centered">
      <div id="qrcode">
        <img style="width: 140px;" src="https://baohothuonghieu.com/wp-content/uploads/2021/10/1536893974-QR-CODE-LA-GI-sblaw.jpeg">
      </div>
    </div>
    <div class="text">
      <p id="one">
        Quét QR để thanh toán!
      </p>
      <p id="two">
        Sử dụng điện thoại, mở app ngân hàng để quét mã QR.
        <br>
      </p>
    </div>
  </div>
</div>
<!-- partial -->
<script src='//cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js'></script>
<script>

</script>

</body>
</html>
