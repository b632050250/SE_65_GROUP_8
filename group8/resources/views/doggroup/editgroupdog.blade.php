@extends('layouts.app')

@section('content')
    <style>
        /* Apply styles to the div block */
        body {
            background-color: #000CFF;
            /* Set the background color to light gray */
        }

        .my-block {
            background-color: #eeeeee;
            border: 1px solid #cccccc;
            width: 1500px;
            height: 800px;
            padding: 10px;
            margin: 0 auto;

            /* Center the block's content */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .dog {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        .dog img {
            width: 200px;
            height: 200px;
        }

        .dog button {
            margin-top: 10px;
        }

        .edit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #cccccc;
            margin: 10px;
            padding: 10px;
            width: 500px;
        }

        p {
            font-size: 20px;
        }
    </style>

    <div class="my-block">
        <p></p>
        <h1>Dog group </h1>
        <div>
            @foreach ($dogGroup as $group)
                {{-- <div class="card"> --}}
                    <div class="dog">

                        <h2>{{ $group->groupOfDog->groupOfDogName }}</h2>
                        @if ($group->dog)
                            <img src="{{asset('images/dog/'.$group->dogpicture->dogpicturePath)}}" alt="Dog Picture"
                                style="border: 5px solid #2712BB;">
                                {{-- <p>images/dog/{{$group->dogpicture->dogpicturePath}}</p> --}}
                            {{-- <p>{{$group->dog->dogpicture->dogpicturePath}}</p> --}}
                        @else
                            <p>No picture available</p>
                        @endif
                        <p></p>
                        <p>ชื่อสุนัข: <b>{{ $group->dog->dogName }}</b></p>
                        <p>จังหวัด: <b>{{ $group->provinceName }}</b></p>
                        <p>อำเภอ: <b>{{ $group->districtName }} </b></p>
                        <p>ตำบล: <b>{{ $groupnh  ->subdistrictName }}</b></p>


                        <p>รายละเอียด: <b>{{ $group->dog->description }}</b></p>
                        <p>สี: <b>{{ $group->dog->dogcolor }}</b></p>
                        @foreach ($groups as $g)
                            @if ($g->groupID == $group->groupID)
                                <p>กลุ่ม:<b>{{ $g->groupofdogName }} </b></p>
                            @endif
                        @endforeach
                        <form
                            action="{{ route('edit-dog.update', ['dogID' => $group->dog->dogID], ['groupID' => $group->groupID]) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="groupID" value="{{ $group->groupID }}">
                            <button type="submit" class="edit-button"><a
                                    href="{{ route('edit-dog', ['dogID' => $group->dog->dogID], ['groupID' => $group->groupID]) }}">แก้ไขข้อมูลหมา</a></button>
                                    <div class="my-button" align=center><a href="/Group/{{$group->groupID}}" ><h3>กลับ</h3></a></div>
                            {{-- <a href="{{ route('edit-dog', ['dogID' => $group->dog->dogID], ['groupID' => $group->groupID]) }}">Edit
                            dog information</a> --}}
                        </form>
                    </div>
                {{-- </div> --}}
            @endforeach

        </div>
    </div>
@endsection
<script>
    function editDog(dogID, groupID) {
        // Redirect the user to the edit dog page, passing the groupID as a parameter
        window.location.href = "/edit-dog?dogID=" + dogID + "&
