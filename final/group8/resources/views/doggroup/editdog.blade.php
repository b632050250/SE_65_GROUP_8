@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #000CFF;
            /* Set the background color to light gray */
        }

        .button-group {
            display: inline-block;
        }

        .my-block {
            background-color: #eee;
            border: 1px solid #ccc;
            width: 1200px;
            height: 950px;
            padding: 10px;
            margin: auto;
            /* Centers the block horizontally */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Centers the content vertically */
            align-items: center;
            /* Centers the content horizontally */
        }

        .dog {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 10px;
            text-align: center;
        }

        .dog label {
            display: inline-block;
            margin-right: 250px;
        }

        .dog input {
            display: inline-block;
            padding: 5px;
        }

        .dog button,
        .dog a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
        }

        .dog button {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .dog a {
            background-color: #ccc;
            color: black;
            border: none;
        }

        .dog button:hover {
            background-color: #45a049;
        }

        .dog label[for="districtID"] {
            margin-right: 50px;
        }

        .dog label[for="subdistrictID"] {
            margin-right: 50px;
        }

        .dog label[for="provinceID"] {
            margin-right: 50px;
        }

        .dog a:hover {
            background-color: #aaa;
        }

        .dog button:focus,
        .dog a:focus {
            outline: none;
        }

        .dog img {
            width: 200px;
            height: 200px;
        }
    </style>

    <div class="my-block">
        <p></p>
        <h1>Edit dog Information</h1>
        <form method="POST" action="{{ route('edit-dog.update', ['dogID' => $dog->dogID]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="dog">

                {{-- @method('PUT') --}}
                <img src="{{ asset('images/dog/'.$dog->dogpicture->dogpicturePath) }}" alt="Dog Picture"
                    style="border: 5px solid #ff6e31;">

                <p></p>
                <label for="dogPicture">Dog Picture:</label>
                <input type="file" id="dogPicture" name="dogPicture">

                <input type="hidden" name="dogID" value="{{ $dog->dogID }}">

                <div class="row mb-3">
                    <div class="col-md-4 d-flex ">
                        <label for="provinceID">{{ __('จังหวัด:') }}</label>
                    </div>
                    {{-- <label for="provinceID" class="col-md-4 col-form-label text-md-end">{{ __('จังหวัด: ') }}</label> --}}

                    <div class="col-md-6">
                        <select name="provinceID" id="province">
                            <option value="">{{ $provinceName }}</option>
                            @foreach ($province as $p)
                                <option value="{{ $p->provinceID }}">{{ $p->provinceName }}</option>
                            @endforeach
                        </select>

                        @error('provinceID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 d-flex ">
                        <label for="districtID">{{ __('อำเภอ:') }}</label>
                    </div>

                    <div class="col-md-6">
                        <select name="districtID" id="district">
                            <option value="">{{ $districtName }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 d-flex ">
                        <label for="subdistrictID">{{ __('ตำบล:') }}</label>
                    </div>
                    <div class="col-md-6">
                        <select name="subdistrictID" id="subdistrict">
                            <option value="">{{ $subdistrictName }}</option>
                        </select>
                    </div>
                </div>


                <label for="dogName">Dog Name:</label>
                <input type="text" id="dogName" name="dogName" value="{{ $dog->dogName }}">


                <label for="description">ลักษณะเด่น:</label>
                <input type="text" id="description" name="description" value="{{ $dog->description }}">

                <label for="groupOfDog-label">ชื่อกลุ่ม:</label>
                <select name="groupOfDog" id="groupOfDog-label" class="form-control">
                    @foreach ($groupOfDogs as $groupOfDog)
                        <option value="{{ $groupOfDog->groupofdogID }}">
                            {{ $groupOfDog->groupofdogName }}

                        </option>
                    @endforeach
                </select>


                <p></p>
                <input name="groupId" class="text" type="hidden" value="{{ $GroupID }}" id="id1"></input>
                <div class="d-inline-block">
                    <button type="submit">Save</button>
                    <button type="button" onclick="window.location.href='{{ url()->previous() }}'" style="background-color: red; color: white;">Cancel</button>

                    {{-- <a href="{{ url()->previous() }}" >Cancel</a> --}}
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#province').on('change', function() {
                var provinceID = this.value;
                $('#district').html('');
                //alert(provinceID);
                $.ajax({
                    url: "{{ url('api/fetch-districts') }}",
                    type: "POST",
                    data: {
                        provinceID: provinceID,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#district').html('<option value="">-- Select District --</option>');
                        $.each(result.districts, function(key, value) {
                            $("#district").append('<option value="' + value
                                .districtID + '">' + value.districtName +
                                '</option>');
                        });
                        $('#subdistrict').html(
                            '<option value="">-- Select Subdistrict --</option>');
                    }
                });
            });
            $('#district').on('change', function() {
                var districtID = this.value;
                $('#subdistrict').html('');
                $.ajax({
                    url: "{{ url('api/fetch-subdistricts') }}",
                    type: 'POST',
                    data: {
                        districtID: districtID,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#subdistrict').html(
                            '<option value="">-- Select Subdistrict --</option>');
                        $.each(res.subdistricts, function(key, value) {
                            $("#subdistrict").append('<option value="' + value
                                .subdistrictID + '">' + value.subdistrictName +
                                '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function myFunction1() {
            var txt = document.getElementById("id1").value;
            alert(txt);
            window.location.href = '{{ url('/editgroup/') }}' + '/' + txt;
            // '{{ url('/group') }}'+'/'+txt;
        }
    </script>
@endsection
