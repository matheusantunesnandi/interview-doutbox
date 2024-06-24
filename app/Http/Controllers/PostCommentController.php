<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $validatedData = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|integer',
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        // Criar um novo post
        $comment = PostComment::create($validatedData);

        // TODO Validar se rota está ok:
        // Redirecionar para a lista de posts com uma mensagem de sucesso
        return redirect()->route('posts.show', [$comment->post])->with('success', 'Post successfully created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostComment $comment)
    {
        $comment->delete();
        return redirect()
            ->back()
            ->with('success', 'Comment deleted successfully.');
    }
}
