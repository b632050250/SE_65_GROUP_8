@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Stley -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <!--script-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Group dog</title>
    <style>
body {
    justify-content: center;
    align-items: center;
    background:  #243763;

}
img{
    border-radius: 6px;
}
.container {

    width: 100%;
    border-radius: 5px;
    background: #fff;

    justify-content: center;
    align-items: center;
}
.container2 {
    max-width: auto;
    width: 90%;
    border-radius: 5px;
    background: #fff;
    padding: 20px 20px;
    margin: auto;
}
.button ,button {
    width: 30%;
    background-color: #ff6e31;
    color: black;
    padding: 14px 30px;
    margin: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: large;
}

.col {
  margin: 0 135px;
}

.dog-2   {
    margin:8px;
   padding: 20px;
    width: 200px;
    background: #96bb72;
    border-radius: 8px;

}
.dog-1 {
    font-size: large;
    margin:60px;
    width: 300px;

}
img{
    margin-top:8px
}
button:hover {
    background: #243763;
    color: white;
}
.nameDog {
    width: 50%;
    margin-top: 20px;
    margin-bottom: 10px;
    background: #ff6e31;
    border-radius: 4px;
    padding: 8px;
    align: center;
}
</style>
</head>
<body>

<?php   $i; $dog;
$x=1;?>



    @if(!$data->isEmpty())
     <div class= "container2" align=center>
        <div class="group"><h1>กลุ่มหมาทั้งหมด</h1>
        <div class="group"><h1>ตำบล {{$new}}</h1>
        <br/>
    </div>
<div align=left>
         @foreach($data as $row)
            @if($x==1)
            <?php  $dog=$row->groupofdogName;
            $i=$row->placeName;
            $x=0;?>
            <div class="nameDog"><h3>ชื่อกลุ่ม {{$dog}}</h3>สถานที่ {{$i}}</div>
            @endif
         @endforeach


         @foreach($data as $row)

         @if($dog!=$row->groupofdogName)
             <div class="nameDog"><h2>ชื่อกลุ่ม {{$row->groupofdogName}} </h2>สถานที่ {{$row->placeName}}</div>
            <?php  $dog=$row->groupofdogName;?>
         @endif
         <span class="dog">
       <span class="dog">{{$row->dogName}} </span>
        <span > <img src="images/dog/{{$row->dogpicturePath}}" width=200 height=150  alt="">

         </span> </span>

     @endforeach
   </div>

        <div class ="but" align = center>
        <a href="{{url('province')}}">
                    <button >กลับ</button>
                 </a>
                 <a href="{{url('Desktop31')}}">
                    <button >เพิ่มกลุ่มสุนัข</button>
                 </a>

        </div>

@endif

    @if($data->isEmpty())

            <div class= "container" align=center>
                <div><h1>ไม่มีข้อมูลหมา</h1></div>
                <a href="{{url('province')}}">
                    <button class="block">กลับ</button>
                 </a>
                 <a href="{{url('Desktop31')}}">
                    <button >เพิ่มหมา</button>
                 </a>

            </div>

        @endif



</div>
</body>
</html>
@endsection
