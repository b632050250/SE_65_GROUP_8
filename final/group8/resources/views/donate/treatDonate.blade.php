<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link href="{{asset('css/openForDonation.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <a>DogProject</a>
        <div class="boxname">
          <p>เปิดรับบริจาค</p>
        </div>
        <div class="boxname">
          <p>ค่ารักษาพยาบาล</p>
        </div>
      </div>
      <div class="content">
        <button value="{{$id}}" id="id3" onclick="myFunction1()">กลุ่ม</button>
        <button value="{{$id}}" id="id4" onclick="myFunction2()">เฉพาะตัว</button>
      </div>
      <div class="actionbox">
        <button value="{{$id}}" id="id2" onclick="myFunction()">กลับ</button>
      </div>
    </div>
    <script>
        function myFunction() {
            var txt = document.getElementById("id2").value;
            window.location.href = '{{url('/selectDonate')}}'+'/'+txt;
        }
        function myFunction1() {
            var txt = document.getElementById("id3").value;
            window.location.href = '{{url('/forTreatgroup')}}'+'/'+txt;
        }
        function myFunction2() {
            var txt = document.getElementById("id4").value;
            window.location.href = '{{url('/forTreatsingle')}}'+'/'+txt;
        }
    </script>
  </body>
</html>
