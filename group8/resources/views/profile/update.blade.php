<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
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
  </head>
<body>
<div class="container" >
  <div class="card-body" style="background-color:powderblue;" >
  <div class="row"> 
    <div class="col">
       Profile<br>
      <form  method="POST" action="{{ route('profile.save') }}" enctype="multipart/form-data">
      <input type="file" name="file" id="image_input" class="custom-file" value="{{ asset('images/user/1.jpg') }}">
          <div id="displayimageprofile" class="d-flex justify-content-center">  
          
          </div>
    </div>
    <div class="col align-self-center">
          @csrf
          <label>ชื่อ </label>
          <input type="text" name="name" value="{{$user[0]->name}}" class="form-control" ><br>
          <label>นามสกุล </label>
          <input type="text" name="surname" value="{{$user[0]->surname}}" class="form-control"><br>
          <a  class="btn btn-secondary btn-xs" href="{{route('profile.index')}}">Back</a>
          <input type="submit" value="Edit"  class="btn btn-primary btn-xs">
</div>
      </form> 
    
</div>
</div>


</body>
<script>
  const image = document.querySelector("#image_input") ;
  var upload = "" ;
  image.addEventListener("change",function(){
    const reader = new FileReader();
    reader.addEventListener("load",()=>{
      upload = reader.result ;
      console.log(upload) ;
      document.querySelector("#displayimageprofile").style.backgroundImage=`url(${upload})`;
    }) ;
    reader.readAsDataURL(this.files[0]);
  })
</script>
</html>