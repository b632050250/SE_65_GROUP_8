<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styletong.css') }}">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>

</head>

<body>
    <title>POST</title>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <h1>Show Dog group information</h1>
                <p></p>
                <p></p>
                <p></p>
                <table class="table">
                    <thead></thead>
                    <tr>
                        <th scope="col">รูปกลุ่ม</th>
                        <th scope="col">ชื่อกลุ่ม</th>
                        <th scope="col">สถานที่</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td><img src="{{asset('images/dog/' . $namesgroups->groupofpostpicturePath) }}" width="200"
                                    height="150" alt="Dog Picture"></td>
                            <td>{{ $namesgroups->groupofdogName }}</td>
                            <td>{{ $namesgroups->placeName }}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- <p>{{$namesgroups->groupofdogID}}</p> --}}
                <div class="my-button1">
                    <a href="{{url('/editgroup/' . $namesgroups->groupofdogID)}}">แก้ไขข้อมูลกลุ่มสัตว์</a>
                </div>
                <p></p>
                <div class="my-button1">
                    <a href="{{url('/selectDonate/' . $namesgroups->groupofdogID)}}">เปิดรับบริจาค</a>
                </div>
                <p></p>
                <div class="my-button1">
                    <a href="{{url('/donate/index/' . $namesgroups->groupofdogID)}}">บริจาค</a>
                </div>
                <p></p>
                <div class="my-button1">
                    <a href="#">การบริจาคทั้งหมด</a>
                </div>
                <p></p>
                <div class="my-button1">
                    <a href="#" onclick="window.history.back()">Back</a>
                </div>
            </div>

        </div>
    </div>


</body>

</html>
