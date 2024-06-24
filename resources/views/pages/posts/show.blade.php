@extends('layouts.main')

@section('title', 'Show post')

@section('navigation_button')
    <a href="{{ url()->previous() }}" class="btn btn-sm text-nowrap">
        <i class="bi bi-arrow-left"></i> Back
    </a>
@endsection

@section('content')

    @include('components.post.show')

    <h3 class="mt-4 text-secondary">{{ $post->comments->Count() }} comments</h3>
    @foreach ($post->comments as $comment)
        <div class="row">
            <div class="col">
                @include('components.post.comment.show')
            </div>

            @auth
                <div class="col d-flex flex-row-reverse">
                    <form method="POST" action="{{ url('/comments/' . $comment->id) }}" id="form-remove">
                        @csrf
                        @method('DELETE')
                    </form>

                    <input type="submit" value="Remover" class="btn" form="form-remove">
                </div>
            @endauth
        </div>
    @endforeach

    @auth
        <form action="{{ url('/comments') }}" method="POST" id="form-comment">
            @csrf

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="content">New comment</label>
                        <textarea name="content" id="comment" rows="5" class="w-100"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" value="Send" class="btn btn-primary" form="form-comment">
                </div>
            </div>
        </form>
    @endauth

@endsection
