@extends('backend.layouts.layout')
@section('content')
<div class="card p-4">
    <h4>Forgot Password</h4>
    <form method="POST" action="{{ route('backend.password.email') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Your admin email" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
</div>
@endsection
