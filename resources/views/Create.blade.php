@extends('layouts')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/create.css') }}">

<!-- Add Toastr script -->
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
    <form action="{{ route('store') }}" method="POST" id="signupForm" class="signup-form">
        @csrf
        <h4 class="registertitle">Register</h4>
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="input-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required>
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="input-group">
            <label for="course">Course</label>
            <input type="text" name="course" id="course" required>
        </div>
        <div class="input-group">
            <label for="year">Year</label>
            <input type="text" name="year" id="year" required">
        </div>
        <div class="input-group">
            <label for="continent">Continent</label>
            <input type="text" name="continent" id="continent" required">
        </div>
        <div class="input-group">
            <label for="country_name">Country Name</label>
            <input type="text" name="country_name" id="country_name" required">
        </div>
        <div class="input-group">
            <label for="capital">Capital</label>
            <input type="text" name="capital" id="capital" required">
        </div>
        <button type="submit">Create</button>
    </form>
</div>

@endsection

<style>
    .toastmessage {
        position: absolute;
        top: 85px;
        right: 0;
        z-index: 10001;
    }
</style>
