@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Two-Factor Authentication</h2>

    @if (auth()->user()->two_factor_secret)
        <p><strong>2FA is enabled.</strong></p>
        <p>Scan the QR code below using Google Authenticator:</p>
        {!! auth()->user()->twoFactorQrCodeSvg() !!}

        <p><strong>Recovery Codes:</strong></p>
        <ul>
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                <li>{{ $code }}</li>
            @endforeach
        </ul>

        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Disable 2FA</button>
        </form>
    @else
        <p>2FA is currently <strong>disabled</strong>. Click below to enable it.</p>
        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
            @csrf
            <button class="btn btn-primary">Enable 2FA</button>
        </form>
    @endif
</div>
@endsection
