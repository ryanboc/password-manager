@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Saved Passwords</h2>
    <a href="{{ route('passwords.create') }}" class="btn btn-primary">Add New</a>
    
    <table class="table mt-3">
        <tr><th>Site Name</th><th>Username</th><th>Password</th><th>Actions</th></tr>
        @foreach($passwords as $password)
        <tr>
            <td>{{ $password->site_name }}</td>
            <td>{{ $password->username }}</td>
            <td>
                <span class="password-hidden">••••••••</span>
                <button class="btn btn-secondary btn-sm" onclick="togglePassword(this, '{{ $password->password }}')">Show</button>
            </td>
            <td>
                <a href="{{ route('passwords.show', $password->id) }}" class="btn btn-success btn-sm">View</a>
                <a href="{{ route('passwords.edit', $password->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('passwords.destroy', $password->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script>
    function togglePassword(button, password) {
        let span = button.previousElementSibling;
        if (span.innerText === "••••••••") {
            span.innerText = password;
            button.innerText = "Hide";
        } else {
            span.innerText = "••••••••";
            button.innerText = "Show";
        }
    }
</script>
@endsection
