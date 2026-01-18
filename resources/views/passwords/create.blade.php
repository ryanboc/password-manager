@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Password</h2>
    <form action="{{ route('passwords.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Site Name:</label>
            <input type="text" name="site_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" required>
                <button type="button" class="btn btn-secondary" onclick="togglePassword()">Show</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Password</button>
        <a href="{{ route('passwords.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<script>
    function togglePassword() {
        let passwordField = document.getElementById("password");
        let button = event.target;
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            button.innerText = "Hide";
        } else {
            passwordField.type = "password";
            button.innerText = "Show";
        }
    }
</script>
@endsection
