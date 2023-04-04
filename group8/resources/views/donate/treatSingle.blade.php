<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link href="{{asset('css/singleTreatDonation.css')}}" rel="stylesheet">
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
        <div class="boxname">
          <p>เฉพาะตัว</p>
        </div>
      </div>
            <div class="content">
              @foreach($name as $row)
              <div  id="dogselect" class="dog">
                  <input name="id2" class="text" type="hidden" value="{{$id}}" id="id2"></input>
                  <h2>{{$row->dogName}}</h2>
                  <img src="{{url('images/dog/'.$row->dogpicturePath)}}" class="pic"/><br>
                  <input name="id2" class="text" type="hidden" value="{{$row->dogID}}" id="id1"></input>
                  <?php
                  echo "<a href='".url('/selectDonate/forTreat/singleSelected/'.$id.'/'.$row->dogID)."'><button>บริจาค</button></a>";?>
                  </div>
              @endforeach
        </div>
      <div class="actionbox">
        <a href="{{url('/selectDonate/forTreat')}}" class="f"><button>กลับ</button></a>
      </div>
    </div>
    <script>
        function myFunction1() {
            var txt = document.getElementById("id1").value;
            var txt2 = document.getElementById("id2").value;
            window.location.href = '{{url('/selectDonate/forTreat/singleSelected')}}'+'/'+txt2+'/'+txt;
        }
    </script>
  </body>
</html>
