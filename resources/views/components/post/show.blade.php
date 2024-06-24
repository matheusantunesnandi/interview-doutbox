<div class="card-body">
    @if (request()->route()->getName() != 'posts.show')
        <a href="{{ url('/posts/' . $post->id) }}" class="text-reset text-decoration-none">
            <h2 class="display-4">{{ $post->title }}</h2>
        </a>
    @else
        <h2 class="display-4">{{ $post->title }}</h2>
    @endif

    <p class="lead">
        {{ $post->content }}
    </p>

    <p class="lead">
        <small class="text-body-secondary">
            Created at {{ $post->created_at }} by <strong>{{ $post->author->name }}</strong>.

            @if ($post->updated_at)
                Updated at: {{ $post->updated_at }}
            @else
                Never updated.
            @endif
        </small>
    </p>

    @can('edit-post', $post)
        <a href="{{ url('/posts/' . $post->id . '/edit') }}" class="text-decoration-none text-info">
            Edit
        </a>
    @endcan
</div>
