<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link href="{{asset('css/foodDonation.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <a>DogProject</a>
        <div class="boxname">
          <p>เปิดรับบริจาค</p>
        </div>
        <div class="boxname">
          <p>ค่าอาหาร</p>
        </div>
      </div>
     
        <div class="content">
        <form method="POST" action="{{ url('createFood') }}" enctype="multipart/form-data" class="f">
        @csrf
            <input name="groupId" type="hidden" value="{{$id}}" id="id1"></input>
            <div class="content-box">
                <a class="text1">ประเภทอาหาร</a>
                <input name="content" class="text"></input>
            </div>
            <div class="content-box">
                <a class="text1">จำนวน (บาท)</a>
                <input class="text" name="amount" class="text"></input>
            </div>
            <div class="content-box">
                <a class="text1">ใบเสร็จ</a>
                <input type="file" name="reciept" class="text"></input>
            </div>
            <div class="content-box">
                <a class="text1">QrCode</a>
                <input type="file" name="qrcode" class="text"></input>
            </div>
            <div class="content-box">
                <a class="text1">รูปสุนัข</a>
                <input type="file" name="dogImg" class="text"></input>
            </div>
        </div>
        <div class="actionbox">
            <button type="submit" class="go">ส่งคำขอเปิดบริจาค</button>
          </form>
          <button onClick="myFunction1()" class="back">กลับ</button>
        </div>
    </div>
    <script>
        function myFunction1() {
            var txt = document.getElementById("id1").value;
            alert(txt);
            window.location.href = '{{url('/selectDonate/')}}'+'/'+txt;
        }
    </script>
  </body>
</html>
