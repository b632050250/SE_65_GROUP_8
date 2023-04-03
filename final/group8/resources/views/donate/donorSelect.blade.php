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
          <p>เปิดรับบริจาค</p>
        </div>
        <div class="boxname">
          <p>ค่าอาหาร</p>
        </div>
      </div>
      <div class="content">
        <div class="content-box">
        <form method="POST" action="{{ url('requestDonate/save') }}" enctype="multipart/form-data" class="f">

        @csrf
        <input type="hidden" name="id" value="{{$postcostID}}"/>
          <a>เลือกผู้อนุมัติ คนที่1</a>
          <select name="user1" id="user1" onchange="getSelectValue()" class="text"><option value=""></option>
            @foreach($data as $row)

                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="content-box">
          <a>เลือกผู้อนุมัติ คนที่2</a>
          <select name="user2" id="user2" onchange="getSelectValue()" class="text"><option value=""></option>
            @foreach($data as $row)

                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="content-box">
          <a>เลือกผู้อนุมัติ คนที่3</a>
          <select name="user3" id="user3" onchange="getSelectValue()" class="text"> <option value=""></option>
            @foreach($data as $row)

                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="content-box">
          <a>เลือกผู้อนุมัติ คนที่4</a>
          <select name="user4" id="user4" onchange="getSelectValue()" class="text"><option value=""></option>
            @foreach($data as $row)

                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="content-box">
          <a>เลือกผู้อนุมัติ คนที่5</a>
          <select name="user5" id="user5" onchange="getSelectValue()" class="text"><option value=""></option>
            @foreach($data as $row)

                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
          </select>
        </div>

      </div>
      <div class="actionbox">
        <button type="submit" class="go">ส่งคำขอเปิดบริจาค</button>
      </div>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      $('select').on('change', function(event ) {
        var prevValue = $(this).data('previous');
      $('select').not(this).find('option[value="'+prevValue+'"]').show();
        var value = $(this).val();
        $(this).data('previous',value); $('select').not(this).find('option[value="'+value+'"]').hide();
      });
      });
    </script>
  </body>
</html>
