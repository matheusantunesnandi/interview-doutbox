@extends('layouts.main')

@section('title', 'Edit post')

@section('content')

    <h1>Edit post</h1>

    <form method="POST" action="{{ url('/posts/' . $post->id) }}" id="form-main">
        @csrf
        @method('PUT')
        
        <div class="form-group mt-2">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ $post->title }}" required>

            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group mt-2">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="3" required>{{ $post->content }}</textarea>

            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <div class="mt-2">
            <div class="form-group">
                <label for="published">Published</label>
                <div class="form-control" id="published">
                    <input type="radio" name="published" id="publishedTrue" value="1"
                        {{ $post->published ? 'checked="checked"' : '' }}>
                    <label for="publishedTrue">YES</label>

                    <input type="radio" name="published" id="publishedFalse" value="0"
                        {{ !$post->published ? 'checked="checked"' : '' }}>
                    <label for="publishedFalse">NO</label>
                </div>
            </div>

            @if ($errors->has('published'))
                <span class="text-danger">{{ $errors->first('published') }}</span>
            @endif
        </div>

    </form>

    <div class="row mt-2">
        <div class="col">
            <input type="submit" value="Save" class="btn btn-primary" form="form-main">
            <a href="{{ url('/posts?my_posts') }}" class="btn btn-secondary">Cancel</a>
        </div>

        <div class="col d-flex justify-content-end">
            <form method="POST" action="{{ url('/posts/' . $post->id) }}" id="form-remove">
                @csrf
                @method('DELETE')
            </form>

            <input type="submit" value="Remover" class="btn btn-danger" form="form-remove">
        </div>
    </div>

@endsection
