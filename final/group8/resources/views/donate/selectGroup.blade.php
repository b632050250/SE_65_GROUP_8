<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link href="{{asset('css/select.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <a>DogProject</a>
        <div class="boxname">
          <p>เลือกกลุ่ม</p>
        </div>
      </div>
      <div class="content">
        <div class="content-box">
            <a>เลือกกลุ่มสุนัข</a>
          <select name="groupofdog" id="groupofdog" class="text">
            @foreach($data as $row)
                <option value="{{$row->groupofdogID}}">{{$row->groupofdogName}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="actionbox1">
      <button class="go" onclick="myFunction()">เปิดบริจาค</button>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function myFunction() {
            var conceptName = $('#groupofdog').find(":selected").val();
            window.location.href = '{{url('/selectDonate/')}}'+'/'+conceptName;
        }
    </script>

  </body>
</html>
