<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link href="{{asset('css/openForDonation.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <a>DogProject</a>
        <div class="boxname">
          <p>ส่งคำขอการเปิดรับบริจาค</p>
        </div>
      </div>
      <div class="content">
      <?php 
          echo "<a href='".url('/requestDonate/select/'.$postcostID)."'><button>เลือกผู้อนุมัติเอง</button></a>";?>
        <?php 
          echo "<a href='".url('/random/'.$postcostID)."'><button>ระบบสุ่มให้</button></a>";?>
      </div>
      <div class="actionbox">
        <a href="{{url('/selectGroup')}}"><button>ยกเลิก</button></a>
      </div>
    </div>
  </body>
</html>
