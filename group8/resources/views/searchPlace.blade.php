@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dynamic Dependent Dropdown</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <meta name="_token" content="{{ csrf_token() }}">
<style>
    body {
        background: #243763;
}
.card{

    border: 10px ;
}
.form-control-lg{
    width: 100%;
    padding: 15px 20px;
    margin: 6px 0px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: medium;
}
.btn{
    width: 100%;
    background-color: #ff6e31;
    color: black;
    padding: 14px 30px;
    margin: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    align:center;
    appearance: auto;
}
.btn:hover {
    background:#243763;
    color: white;
}
</style>

</head>
<body>
   <br/>
    <div class="container mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">

                <div class="card card-primary p-4 border-0 shadow-lg">
                <form action="/search" id="frm" name="frm" method="post" align="center">
                    @csrf
                    <div class="card-body">

                        <h2 style="margin-bottom:20px;">ค้นหาสถานที่</h2>

                        <div class="mb-3" >
                            <select name="province" id="province"
                            class="form-control-lg form-control ">

                                <option value="">เลือกจังหวัด</option>
                                @if (!empty($province))
                                    @foreach ($province as $row)
                                        <option value="{{ $row->provinceID }}">{{ $row->provinceName }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="district" id="district" class="form-control-lg form-control">
                                <option value="">เลือกอำเภอ</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="subdistrict" id="subdistrict" class="form-control-lg form-control">
                                <option value="">เลือกตำบล</option>
                            </select>
                        </div>

                        <div class="d-grid" >
                            <button type ="submit" class="btn btn-primary btn-lg">ค้นหา</button>
                            <button   class="btn btn-primary btn-lg "style="margin-top:8px;"onclick="history.back()">กลับ</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
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
