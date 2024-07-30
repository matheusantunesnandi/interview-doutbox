@extends('layouts.main')

@section('title', 'Feed')

@section('navbar_post_active', 'active')

@section('content')

    @foreach ($posts as $k => $post)
        <div class="row mb-4">
            <div class="col">

                @include('components.post.show', ['post', $post])

                @if ($post->comments->isNotEmpty())
                    <a href="{{ url('/posts/' . $post->id) }}" class="text-decoration-none text-info">
                        {{ $post->comments->count() }} comments
                    </a>
                @else
                    0 comments
                @endif

            </div>
        </div>

        @if (!$loop->last)
            <div class="d-flex justify-content-center">
                <hr class="opacity-25 w-25 ">
            </div>
        @endif
    @endforeach

@endsection
