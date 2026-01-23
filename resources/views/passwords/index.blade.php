@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Your Saved Passwords</h2>
        <a href="{{ route('passwords.create') }}" class="btn btn-primary">Add New</a>
    </div>

    <table id="passwordTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Site Name</th>
                <th>Username</th>
                <th style="width: 200px;">Password</th> <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passwords as $password)
            <tr>
                <td>{{ $password->site_name }}</td>
                <td>{{ $password->username }}</td>
                <td>
                    <span class="password-mask fw-bold">••••••••</span>
                    
                    <button class="btn btn-outline-secondary btn-sm ms-2 reveal-btn" 
                            onclick="togglePassword(this, {{ $password->id }})">
                        Show
                    </button>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('passwords.edit', $password->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('passwords.destroy', $password->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. Initialize the DataTable
        $('#passwordTable').DataTable({
            "order": [[ 0, "asc" ]], // Default sort by Site Name (Column 0)
            "pageLength": 10,        // Show 10 rows per page
            "columnDefs": [
                // Disable Sorting and Searching on Password (col 2) and Actions (col 3)
                { "orderable": false, "targets": [2, 3] },
                { "searchable": false, "targets": [2, 3] }
            ],
            "language": {
                "search": "Filter Records:" // Custom label
            }
        });
    });

    // 2. The Password Reveal Function (AJAX)
    // This stays outside document.ready so the inline onclick="" can find it
    function togglePassword(btn, id) {
        let span = btn.previousElementSibling;
        
        // If currently showing text, switch back to mask
        if (btn.innerText === "Hide") {
            span.innerText = "••••••••";
            btn.innerText = "Show";
            btn.classList.remove('btn-secondary');
            btn.classList.add('btn-outline-secondary');
            return;
        }

        // Fetch Logic
        btn.innerText = "...";
        
        fetch(`/passwords/${id}/reveal`)
            .then(res => res.json())
            .then(data => {
                span.innerText = data.password;
                btn.innerText = "Hide";
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-secondary');
            })
            .catch(err => {
                console.error(err);
                btn.innerText = "Err";
            });
    }
</script>
@endsection