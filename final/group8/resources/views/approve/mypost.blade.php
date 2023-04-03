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

  </head>
<body style="background-color:powderblue;">
<div class="container">
<div class="bg-blue rounded text-center p-5 shadow-down"  >
    <div class="row" style="margin-top:20px;">
        <div class="col-12">
          <div class="bg-white rounded text p-2 " >
            <div class="d-flex align-items-center">
              <div class="col-2 align-self-center ">
                <label class="d-flex align-items-center "> วันที่ขออนุมัติ</label>
              </div>
              <div class="col-2">
                <label class="d-flex align-items-center "> เรื่อง</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> บริเวณ</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center ">จำนวน </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> สถานะ<label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> ...<label>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-- <div class="row d-flex justify-content-center">
  <div class="align-self-center"> -->
  @php($i=0)
  @foreach($myposts as $mypost)
  <div class="row" style="margin-top:20px;">
  <div class="col-12">
          <div class="bg-white rounded text p-4 " >
            <div class="d-flex align-items-center">
              <div class="col-2 align-self-center ">
                <label class="d-flex align-items-center "> {{$formattedDate[$i]}}</label>
              </div>
              <div class="col-2">
                <label class="d-flex align-items-center "> {{$mypost[0]->typetagName}}</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> {{$mypost[0]->subdistrictName}} {{$mypost[0]->placeName}}</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center ">{{$mypost[0]->postcostAmount}} บาท </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> 
          @if($mypost[1]==1)
            กำลังลังดำเนินการ
          @elseif($mypost[1]==2)
          <label style="color:green;"> อนุมัติสำเร็จ</label>
          @elseif($mypost[1]==3)
          <label style="color:red;"> ไม่อนุมัติ</label>
          @endif<label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> <form  method="get" action="{{ route('approve.mypostdetails') }}">
            <button  class="btn btn-secondary btn-xs" value="{{$mypost[0]-> postcostID}}" name="se">Details</button>
          </form><label>
              </div>
            </div>
          </div>
        </div>
        </div>
  
        @php($i++)
    @endforeach
    <a  class="btn btn-secondary btn-xs" href="{{route('profile.index')}}">Back</a>
</div>
</div>
</body>
</html>