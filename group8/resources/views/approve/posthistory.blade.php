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
    <h4> ประวัติการอนุมัติ</h4>
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
              <div class="col-2 ">
                <label class="d-flex align-items-center "> ผู้ขอ</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center ">จำนวน </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> การอนุมัติ</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      @php($i=0)
  @foreach($posthistory as $approve)
  <div class="row" style="margin-top:20px;">
          <div class="col-12">
            <div class="bg-white rounded text p-4 " >
            <div class="row d-flex align-items-center">
              <div class="col-2">
                <label class="d-flex align-items-center ">{{$formattedDate[$i]}}</label>
            </div>
            <div class="col-2">
                <label class="d-flex align-items-center ">{{$approve->typetagName}} </label>
            </div>
            <div class="col-2">
                <label class="d-flex align-items-center ">{{$approve->subdistrictName}} {{$approve->placeName}}</label>
            </div>
            <div class="col-2 ">
                <label > {{$approve->name}}</label>
            </div>
            <div class="col-2 ">
                <label >{{$approve->postcostAmount}} บาท</label>
            </div>
              <div class="col-2">
          @if($approve->checkapproveStatusID==2)
          <label style="color:green;"><i class="ti-check"></i> อนุมัติสำเร็จ</label>
          @elseif($approve->checkapproveStatusID==3)
          <label style="color:red;"><i class="ti-na"></i> ไม่อนุมัติ</label>
    @endif
    </div>
</div>
</div>
</div>
</div>
@php($i++)
   @endforeach   
   <div class=" row d-flex justify-content-center" style="margin-top:20px;">
   <a  class="btn btn-secondary btn-xs" href="{{route('approve.post')}}">Back</a>
</div>
</div>


</body>
</html> 