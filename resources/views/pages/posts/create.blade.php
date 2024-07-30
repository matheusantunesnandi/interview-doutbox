@extends('layouts.main')

@section('title', 'Create post')

@section('navbar_post_create_active', 'active')

@section('content')

    <form method="POST" action="{{ url('/posts') }}">
        @csrf
        <input type="text" name="published" value="0" hidden>

        <div class="form-group mt-2">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" value="" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group mt-2">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <div class="mt-2">
            <input type="submit" value="Save" class="btn btn-primary">
            <a href="{{ url('/posts?my_posts') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>

@endsection
