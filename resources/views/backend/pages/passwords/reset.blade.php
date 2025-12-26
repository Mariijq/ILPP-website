@extends('backend.layouts.layout')
@section('content')
<div class="card p-4">
    <h4>Reset Password</h4>
    <form method="POST" action="{{ route('backend.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
        </div>
        <div class="mb-3">
            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
</div>
@endsection
