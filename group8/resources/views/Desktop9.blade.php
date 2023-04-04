@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Desktop9</title>
    <link rel="stylesheet" href="{{ asset('css/style_N1.css') }}">
</head>
<body>
    <div class="main">
        <div class="center">
            <form action="{{route('adddog')}}" method="post" enctype="multipart/form-data">

                <div class ="head" align=center>
                    <h1>สร้างสัตว์กลุ่มใหม่
                   <br/>เพิ่มสัตว์</h1>
                </div>
                 <p>*กรุณากรอกให้ครบตามจำนวนของสุนัขจากนั้นจึงค่อยคลิกปุ่มเรียบร้อย*</p>
                    @csrf
                    <div class = "fromgroup">
                        <input type="hidden" name = "ID" value = "{{$subID}}">
                        <input type="hidden" name = "groupID" value = "{{$DID}}">
                        <label for="fileInput">โปรดเลือกรูปภาพ</label>
                        <input type="file" id="fileInput" name="pic" accept="image/*" onchange="displayImage(this)">
                        <img id="preview" alt="">
                        <script>
                            const fileInput = document.getElementById('fileInput');
                            const preview = document.getElementById('preview');

                            fileInput.addEventListener('change', function() {
                            const file = this.files[0];

                            if (file) {
                                const reader = new FileReader();

                                reader.addEventListener('load', function() {
                                preview.setAttribute('src', this.result);
                                });

                                reader.readAsDataURL(file);
                            } else {
                                preview.setAttribute('src', '');
                            }
                            });
                        </script>
                        <br><label>ชื่อ</label>
                        <input type="text" id="name" name="name"><br><br>
                        <label>ลักษณะเด่น</label>
                        <input type="text" id="nature" name="nature"><br><br>
                        <label>สี</label>
                        <input type="text" id="color" name="color">

                        <br><br>
                        <div align=center><input type="submit" value = "เพิ่มสัตว์">
                        <div class="my-button" align=center><a href="/about" ><h3>เรียบร้อย</h3></a></div></div>

                    </div>
                </form>
    </div>

</body>
</html>
@endsection
