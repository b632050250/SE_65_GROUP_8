
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <style>
		            body {
			        height: 60vh; /* Set the height of the body to the viewport height */
			        display: flex;
			        flex-direction: column;
			        justify-content: flex-end; /* Align content to the bottom of the page */
			        align-items: center; /* Center content horizontally */
		            }
		            .container {
			        width: 100%; /* Set the width of the content container */
			        background-color: #ecd0d0; /* Add a background color to the content container */
			        padding: 20px; /* Add some padding to the content container */
			        text-align: center; /* Center the text inside the container */
		            }
                    .my-button1{
                    font-size: 15px;
                    background-color: #ffc2c2;
                    color: #000000;
                    font-weight: bold;
                    padding: 20px 50px;
                    border-radius: 20px;
                    width: 20px;
                    text-align: center;
                    border: none;
                    cursor: pointer;
                    display: inline-block;

                    }
                    .my-button1,
                    input[type="submit"] {
                    margin: 0 40px;
                    }
                    .my-button1:hover {
                    background-color: #ff6e31;
                    color: #FFFFFF;
                    }
                    .my-button2{
                    font-size: 15px;
                    background-color: #ffc2c2;
                    color: #000000;
                    font-weight: bold;
                    padding: 20px 50px;
                    border-radius: 20px;
                    width: 20px;
                    text-align: center;
                    border: none;
                    display: inline-block;
                    }
                    .my-button2,
                    input[type="submit"] {
                    margin: 0 40px;
                    }
                    .my-button2:hover {
                    background-color: #243763;
                    color: #FFFFFF;
                    }

	            </style>
                <h1>ร้องเรียนผู้ใช้ ชื่อ</h1>
                <a>{{$id}}</a>


                <table class="table">

                    <tr>
                        <th scope="col">วันที่อนุมัติ</th>
                        <th scope="col">เรื่อง</th>
                        <th scope="col">บริเวณ</th>
                        <th scope="col">ผู้บริจาค</th>
                        <th scope="col">จำนวน</th>

                    </tr>


                    <tbody>

                            <tr>
                                <th>{{$name->donationTime}}</th>
                                <td>{{$tagName->typetagName}}</td>
                                <td>{{$placeName->placeName}}</td>
                                <td>{{$userName->name}}</td>
                                <td>{{$name->donationAmount}}</td>
                            </tr>

                    </tbody>


                </table>
                <form method="POST" action="{{ url('sented') }}" enctype="multipart/form-data" class="f">
                    @csrf
                <h1>เรื่องที่ต้องการร้องเรียน</h1>
                    <input type="hidden" name="id" value="{{$id}}"></input>
                    <input type="text" name="content"></input>
                    <button type="submit" class="go">ร้องเรียน</button>
                    </form>
                    <button>กลับ</button>
                    </div>


            </div>

        </div>
    </div>
</body>
<script>
</script>

</html>
