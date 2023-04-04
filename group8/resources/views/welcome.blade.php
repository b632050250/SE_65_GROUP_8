@extends('layouts.app')
@section('content')
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
    <title>Home</title>
</head>

<body>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h1>Post</h1>
                <p>โพสทั้งหมด</p>


                <table class="table">
                    <thead></thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">วันที่</th>
                        <th scope="col">ข้อความ</th>
                        <th scope="col">รูป</th>

                    </tr>


                    <tbody>
                        @php($i = 1)
                        @foreach ($post as $name)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $name->name }}</td>
                                <td>{{ $name->postTime }}</td>
                                <td>{{ $name->postofgroupContent }}</td>

                                <td><img src="{{asset('images/dog/'.$name->dogpicturePath)}}" width="200"
                                        height="150" alt="Dog Picture"></td>

                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</body>
<script>
    function myFunction1(id) {
        var txt = document.getElementById("id" + id).value;
        // alert("Group of Dog ID: " + txt);
        window.location.href = '{{ url('/Group/') }}' + '/' + txt;
    }
</script>

</html>
@endsection
