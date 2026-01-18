@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Two-Factor Authentication Required</h2>
    <p>Enter the authentication code from your Google Authenticator app.</p>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first('code') }}</div>
    @endif

    <form method="POST" action="{{ url('/two-factor-challenge') }}">
        @csrf
        <div class="form-group">
            <label for="code">Authentication Code:</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Verify</button>
    </form>
</div>
@endsection
