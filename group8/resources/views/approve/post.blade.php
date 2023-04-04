<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!--Stley -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <!--script-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="{{asset('plugins/slick/slick.css')}}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{asset('plugins/themify-icons/themify-icons.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  </head>
<body>
  <div class="container" style="margin-top:20px;">
    <div class="bg-gray rounded text p-5 shadow-down"  >
      <div class="row">
      <div class="col-10">
        </div>
        <div class="col">
          <a  class="btn btn-warning btn-xs pull-left" href="{{route('approve.posthistory')}}"> <i class="ti-book"></i> History</a>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="col-12">
          <div class="bg-white rounded text p-2 " >
            <div class="d-flex align-items-center">
              <div class="col-2 ">
                <label class="d-flex align-items-center "> วันที่ขออนุมัติ</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> เรื่อง</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> บริเวณ</label>
              </div>
              <div class="col-1 ">
                <label class="d-flex align-items-center "> ผู้ขอ</label>
              </div>
              <div class="col-1 ">
                <label class="d-flex align-items-center ">จำนวน </label>
              </div>
              <div class="col-4 ">
                <label class="d-flex align-items-center "> ...</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      @php($i=0)
    @foreach($approves as $approve)
        <div class="row" style="margin-top:20px;">
          <div class="col-12">
            <div class="bg-white rounded text p-4 " >
            <div class="row d-flex align-items-center">
              <div class="col-2">
                <label class="d-flex align-items-center "> {{$formattedDate[$i]}}</label>
            </div>
            <div class="col-2">
                <label class="d-flex align-items-center ">{{$approve->typetagName}} </label>
            </div>
            <div class="col-2">
                <label class="d-flex align-items-center ">{{$approve->subdistrictName}} {{$approve->placeName}}</label>
            </div>
            <div class="col-1 ">
                <label > {{$approve->name}}</label>
            </div>
            <div class="col-1 ">
                <label > {{$approve->postcostAmount}} </label>
            </div>
              <div class="col-4">
              <form action="{{route('approve.approve')}}" method="POST">
                @csrf
                  <input type ="hidden" name="id" value=" {{$approve->checkapproveID }}"/>
                  <button type="submit" name="action" value="yes" class="btn btn-success btn-xs">อนุมัติ</button>
                  <button type="submit" name="action" value="no" class="btn btn-danger btn-xs">ไม่อนุมัติ</button>
                  <button type="submit" name="action" value="detail" class="btn btn-info btn-xs">รายละเอียด</button>
              </form>
              </div>
              </div>
              </div>
          </div>
        </div>
        @php($i++)
    @endforeach  
    <div class="row d-flex justify-content-center" style="margin-top:20px;">
    <a  class="btn btn-secondary btn-xs" href="{{route('approve.index')}}">Back</a>
</div>
    </div>
</div>
</body>
</html> 