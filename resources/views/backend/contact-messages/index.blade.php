@extends('backend.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="backend-header">
</div>

<div class="backend-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="messages-grid">
        @forelse($messages as $message)
        <div class="message-card">
            <div class="message-header">
                <h3>{{ $message->name }}</h3>
                <span class="message-date">{{ $message->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="message-body">
                <p><strong>Email:</strong> {{ $message->email }}</p>
                <p><strong>Phone:</strong> {{ $message->phone ?? '-' }}</p>
                <p>{{ $message->message }}</p>
            </div>
            <div class="message-footer">
                <form action="{{ route('contact-messages.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center">No messages found.</p>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $messages->links() }}
    </div>
</div>
@endsection
