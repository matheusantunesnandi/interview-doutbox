@extends('layouts.main')

@section('title', 'My posts')

@section('navbar_post_mine_active', 'active')

@section('content')

    @foreach ($posts as $post)
        <div class="row mt-2">
            <div class="col col-md-8 col-lg-10">
                <strong>{{ $post->id }}</strong> {{ $post->title }}
            </div>

            <div class="col">
                <div class="row">
                    <div class="col-sm-12 col-md-6 p-1">
                        <a href="{{ url('/posts/' . $post->id) }}"
                            class="btn btn-sm btn-outline-secondary w-100 text-nowrap">View</a>
                    </div>

                    <div class="col-sm-12 col-md-6 p-1">
                        @if (!$post->published)
                            <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-sm btn-primary w-100 text-nowrap">
                                Edit draft
                            </a>
                        @else
                            <a href="{{ url('/posts/' . $post->id . '/edit') }}"
                                class="btn btn-sm btn-outline-dark w-100 text-nowrap">
                                Edit pub
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
