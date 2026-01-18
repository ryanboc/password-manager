@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Password Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Site Name:</strong> {{ $password->site_name }}</p>
            <p><strong>Username:</strong> {{ $password->username }}</p>
            <p><strong>Password:</strong> <span id="passwordText">{{ $password->password }}</span></p>
            <button class="btn btn-secondary" onclick="togglePassword()">Show/Hide</button>
        </div>
    </div>

    <a href="{{ route('passwords.index') }}" class="btn btn-primary mt-3">Back</a>
</div>

<script>
    function togglePassword() {
        var passwordField = document.getElementById("passwordText");
        if (passwordField.innerHTML === "••••••••") {
            passwordField.innerHTML = "{{ $password->password }}";
        } else {
            passwordField.innerHTML = "••••••••";
        }
    }
</script>
@endsection
