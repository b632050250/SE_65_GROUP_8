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
      </div>
      <div class="content">
        <button value="{{$id}}" id="id1" onclick="myFunction1()" >ค่ารักษาพยาบาล</button>
        <button value="{{$id}}" id="id2" onclick="myFunction2()" >ค่าอาหาร</button>
      </div>
      <div class="actionbox">
        <a href="{{url('/Group/'.$id)}}" class="f"><button>กลับ</button></a>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function myFunction1() {
            var txt = document.getElementById("id1").value;
            window.location.href = '{{url('/selectDonate/forTreat')}}'+'/'+txt;
        }
        function myFunction2() {
            var txt = document.getElementById("id2").value;
            window.location.href = '{{url('/selectDonate/forFood')}}'+'/'+txt;
        }
    </script>
  </body>
</html>
