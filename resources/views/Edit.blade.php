@extends('layouts')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/create.css')}}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="toastmessage">
    @if($errors->any())
        <div class="col-8">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
    @if(session()->has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if(session()->has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>    
    @endif
</div>

<div class="container">
    <form action="/students/{{$student->id}}" method="POST" id="signupForm" class="signup-form">
    @method('PUT')
    @csrf
        <h4 class="registertitle">Edit</h4>
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$student->name}}" id="name" required>
        </div>
        <div class="input-group">
            <label for="age">Age</label>
            <input type="number" name="age" value="{{$student->age}}" id="age" required>
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address" value="{{$student->address}}" id="address" required>
        </div>
        <div class="input-group">
            <label for="course">Course</label>
            <input type="text" name="course" value="{{ optional($student->academic)->course }}" id="course" required>
        </div>
        <div class="input-group">
            <label for="year">Year</label>
            <input type="text" name="year" value="{{ optional($student->academic)->year }}" id="year" required">
        </div>
        <div class="input-group">
            <label for="continent">Continent</label>
            <input type="text" name="continent" value="{{ optional($student->country)->continent }}" id="continent" required">
        </div>
        <div class="input-group">
            <label for="country_name">Country Name</label>
            <input type="text" name="country_name" value="{{ optional($student->country)->country_name }}" id="country_name" required">
        </div>
        <div class="input-group">
            <label for="capital">Capital</label>
            <input type="text" name="capital" value="{{ optional($student->country)->capital }}" id="capital" required">
        </div>
        <button type="submit">Update</button>
    </form>
  </div>


@endsection()

<style>
    .toastmessage {
        position: absolute;
        top: 85px;
        right: 0;
        z-index: 10001;
    }
</style>