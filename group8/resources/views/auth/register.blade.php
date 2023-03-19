@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="name" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Phonenumber') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="name" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="provinceID" class="col-md-4 col-form-label text-md-end">{{ __('provinceID') }}</label>

                            <div class="col-md-6">
                                <select name="province" id="province">
                                <option value="">-- Select Province --</option>
                                    @foreach($province as $p)
                                    <option value="{{$p->provinceID}}">{{$p->provinceName}}</option>
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
                            <label for="districtID" class="col-md-4 col-form-label text-md-end">{{ __('districtID') }}</label>

                            <div class="col-md-6">
                                <select name="district" id="district"><option value="">-- Select District --</option></select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="subdistrictID" class="col-md-4 col-form-label text-md-end">{{ __('subdistrictID') }}</label>

                            <div class="col-md-6">
                                <select name="subdistrictID" id="subdistrict">
                                <option value="">-- Select Subdistrict --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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
                        $('#district').html('<option value="">-- Select District --</option>');
                        $.each(result.districts, function (key, value) {
                            $("#district").append('<option value="' + value
                                .districtID + '">' + value.districtName + '</option>');
                        });
                        $('#subdistrict').html('<option value="">-- Select Subdistrict --</option>');
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
                        $('#subdistrict').html('<option value="">-- Select Subdistrict --</option>');
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
