<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();
        $view = 'pages.posts.list';

        // Apply scopes based on query string parameters
        if ($request->has('author')) {
            $query->byAuthor($request->input('author'));
        }

        if ($request->has('title')) {
            $query->byTitle($request->input('title'));
        }

        if ($request->has('date')) {
            $query->byDate($request->input('date'));
        }

        if ($request->has('my_posts')) {
            if (!Auth::check()) {
                return redirect('/login')->with(['error' => 'User not authenticated.']);
            }

            $query->byAuthorId(Auth::user()->id);

            if ($request->has('my_drafts')) {
                $query->published(false);
            }

            $view = 'pages.posts.listMine';
        } else {
            $query->published(true);
        }

        // Get the filtered posts
        $posts = $query->orderBy('id', 'DESC')->get();

        return view($view, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-post');

        // Validar os dados do formulário
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'required|boolean',
        ]);

        $validatedData['author_id'] = Auth::user()->id;

        // Criar um novo post
        Post::create($validatedData);

        // Redirecionar para a lista de posts com uma mensagem de sucesso
        return redirect()->route('posts.index', ['my_posts'])->with('success', 'Post successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('pages.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('pages.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('edit-post', $post);

        // Validar os dados do formulário
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'required|boolean',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Atualizar o post
        $post->update($validatedData);

        // Redirecionar para a lista de posts com uma mensagem de sucesso
        return redirect()->route('posts.index', ['my_posts'])->with('success', 'Post successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete-post', $post);

        // Excluir o post
        $post->delete();

        // Redirecionar para a lista de posts com uma mensagem de sucesso
        return redirect()->route('posts.index', ['my_posts'])->with('success', 'Post successfully removed!');
    }
}
