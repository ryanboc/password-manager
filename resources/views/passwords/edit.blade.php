@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Password</h2>
    <form action="{{ route('passwords.update', $password->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Site Name:</label>
            <input type="text" name="site_name" class="form-control" value="{{ $password->site_name }}" required>
        </div>

        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" value="{{ $password->username }}" required>
        </div>

        <div class="form-group">
            <label>New Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Password</button>
        <a href="{{ route('passwords.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection