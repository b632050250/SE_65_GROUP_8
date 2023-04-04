
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
    <!-- slick slider -->
  <link rel="stylesheet" href="{{asset('plugins/slick/slick.css')}}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{asset('plugins/themify-icons/themify-icons.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <style>
* {
  box-sizing: border-box;
}

.image {
  float: left;
  width: 25%;
  padding: 5px;
}


</style>
</head>

<body>
@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row align-items-center"  style="margin-top:150px;">
    <div class="col justify-content-center">
      บริจาคค่า{{$postgroup[0]->typetagName}}ให้สุนัข {{$postgroup[0]->placeName}} >> รายละเอียด
      <div class="card shadow text-center">
        <div class="position-relative rounded-top progress-wrapper" data-color="#fdb157" style="background-color: rgb(253, 177, 87);" >
          <div class="wave" data-progress="{{$per}}%" style="bottom: {{$per}}%;" >
        
          </div>
        </div>
        <h3>{{$per}}%</h3> 
        <h4>{{$amount}} from {{$am}} </h4> 
        <label> <br>ยอดที่ต้องการ {{$am}} บาท ยอดบริจาคที่ได้รับการอนุมัติ  {{$amount}}บาท<br>รอการอนุมัติ  {{$allamount}} บาท </label>
      </div>
    </div>
        <div class ="col d-flex justify-content-center">
          <form  method="POST" action="{{ route('donate.cost') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$id}}">
          <input type="hidden" name="opendonateID" value="{{$postgroup[0]->opendonateID}}">
          <input type="file" name="file" id="image_input" class="custom-file">
          <div id="displayimage" class="d-flex justify-content-center">  
        </div>
          <input type="text" name="amount"  class="form-control" placeholder="ระบุจำนวนเงิน">
          <div class="row d-flex justify-content-center"  style="margin-top:20px;">
            <input type="submit" value="บริจาค" class="btn btn-success btn-xs">
          </div>
          </form>
        </div>
        <div class ="col ">
        <div class="row">
        <img src="{{asset('images/slip/'.$postgroup[0]->opendonateQRcode)}}"style="width:300px"  > 
        </div>
        <div class="row" style="margin-top:20px;">
        <img src="{{asset('images/dog/'.$postgroup[0]->groupofpostpicturePath)}}"style="width:300px"  > 
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="row"  style="margin-top:150px;">
    <div class="col">
      
    <div class="row align-items-center" style="margin-top:30px;"  >
      @foreach($postgroup as $donate)
      <div class="col-12 col-md-3 justify-content-center ">
      <img src="{{asset('images/' . $donate->dogimgPath) }}" style="width:100%" >
      </div>
      @endforeach
    </div>
  </div>
</div>
</div> -->
@endsection

</body>
<script>
  const image = document.querySelector("#image_input") ;
  var upload = "" ;
  image.addEventListener("change",function(){
    const reader = new FileReader();
    reader.addEventListener("load",()=>{
      upload = reader.result ;
      console.log(upload) ;
      document.querySelector("#displayimage").style.backgroundImage=`url(${upload})`;
    }) ;
    reader.readAsDataURL(this.files[0]);
  })
</script>
</html>