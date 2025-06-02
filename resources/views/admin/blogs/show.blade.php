@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>{{ $blog->title }}</h1>
    <p><strong>Author:</strong> {{ $blog->author }}</p>
    <p><strong>Published:</strong> {{ $blog->created_at->format('d M Y') }}</p>

    @if ($blog->image)
       <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded shadow-sm mb-3" style="max-width: 600px;">
    @endif

    <div>
        {!! nl2br(e($blog->content)) !!}
    </div>
</div>
@endsection
