@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome to your Password Manager!</p>
    <a href="{{ route('passwords.index') }}" class="btn btn-primary">Go to Password Manager</a>
</div>
@endsection
