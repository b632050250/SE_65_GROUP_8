@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Desktop31</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_N.css') }}">
<style>
.btn,button{
    width: 50%;
}
</style>
</head>
<body>
    <div class="main">

                <form action = "{{route('addplace')}}" method = "post">
                <div class="add">
                    <div class="head" align=center>
                        <h1>สร้างสัตว์กลุ่มใหม่ <br/>สถานที่พบ</h1>

                    </div >
                    @csrf
                    <div class = "formlo">
                        <br><label>ชื่อสถานที่</label>
                        <input type="text" class="Namelocation" name="placeName">
                        <label>บริเวณที่เจอ</label>
                        <input type="text" class="Area" name="region">
                        <label>โปรดเลือกจังหวัด</label>
                        <select name="province" id="province">
                            <option value="">เลือกจังหวัด</option>
                            @foreach($province as $p)
                            <option value="{{$p->provinceID}}">{{$p->provinceName}}</option>
                            @endforeach
                        </select>
                        @error('provinceID')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label >โปรดเลือกอำเภอ</label>
                        <select name="district" id="district">
                            <option value="">เลือกอำเภอ</option>
                        </select>
                        <label>โปรดเลือกตำบล</label>
                        <select name="subdistrictID" id="subdistrict">
                            <option value="">เลือกตำบล</option>
                        </select>

                        <label for ="Name">ชื่อกลุ่ม</label>
                        <input type="text" class="Name" name="Name"><br>
                        <label for ="details">รายละเอียด</label>
                        <input type="text" class="details" name="details">
                        <input type="submit" value = "เพิ่มสถานที่">
                      </div>
                    </form>
                    </div>
            <div align=center "><button   class="btn btn-primary btn-lg "style="margin-top:8px;"onclick="history.back()">กลับ</button></div>

    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#province').on('change', function () {
                var provinceID = this.value;
                $('#district').html('');
                //alert(provinceID);
                $.ajax({
                    url: "{{url('api/fetch-districts')}}",
                    type: "POST",
                    data: {
                        provinceID: provinceID,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#district').html('<option value="">เลือกอำเภอ</option>');
                        $.each(result.districts, function (key, value) {
                            $("#district").append('<option value="' + value
                                .districtID + '">' + value.districtName + '</option>');
                        });
                        $('#subdistrict').html('<option value="">เลือกตำบล</option>');
                    }
                });
            });
            $('#district').on('change', function () {
                var districtID = this.value;
                $('#subdistrict').html('');
                $.ajax({
                    url: "{{url('api/fetch-subdistricts')}}",
                    type: 'POST',
                    data: {
                        districtID: districtID,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#subdistrict').html('<option value="">เลือกตำบล</option>');
                        $.each(res.subdistricts, function (key, value) {
                            $("#subdistrict").append('<option value="' + value
                                .subdistrictID + '">' + value.subdistrictName + '</option>');
                        });
                    }
                });
            });
        });
</script>
@endsection
