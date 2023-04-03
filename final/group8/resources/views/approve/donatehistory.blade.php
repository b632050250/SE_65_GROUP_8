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
<body style="background-color:powderblue;">
<div class="container">
<div class="bg-blue rounded text-center p-5 shadow-down"  >
<div class="row" style="margin-top:20px;">
        <div class="col-12">
          <div class="bg-white rounded text p-2 " >
            <div class="d-flex align-items-center">
              <div class="col-2 ">
                <label class="d-flex align-items-center "> วันที่อนุมัติ</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> เรื่อง</label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> บริเวณ</label>
              </div>
              <div class="col-1 ">
                <label class="d-flex align-items-center "> ผู้โอน </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center ">จำนวน </label>
              </div>
              <div class="col-3 ">
                <label class="d-flex align-items-center "> สถานะ </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      @php($i=0)
  @foreach($donatehistory as $history)
  <div class="row" style="margin-top:20px;">

  <div class="col-12">
          <div class="bg-white rounded text p-4 " >
            <div class="d-flex align-items-center">
              <div class="col-2 ">
                <label class="d-flex align-items-center "> {{$formattedDate[$i]}} </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> {{$history->typetagName}} </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> {{$history->subdistrictName}} {{$history->placeName}} </label>
              </div>
              <div class="col-1 ">
                <label class="d-flex align-items-center "> {{$history->name}} </label>
              </div>
              <div class="col-2 ">
                <label class="d-flex align-items-center "> {{$history->donationAmount}} บาท </label>
              </div>
              <div class="col-3 ">
                <label class="d-flex align-items-center ">
          @if($history->checkapprovestatusID==2)
            อนุมัติสำเร็จ
          @elseif($history->checkapprovestatusID==3)
            ไม่อนุมัติ
    @endif </label>
              </div>
            </div>
          </div>
        </div>
          
    

</div>
@php($i++)
   @endforeach   
   <a  class="btn btn-secondary btn-xs" href="{{route('approve.donate')}}">Back</a>
</div>
<!-- /footer -->

<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- filter -->
<script src="plugins/shuffle/shuffle.min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html> 