<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // Método para criar um comentário
    public function store(Request $request, $newsId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $news = News::findOrFail($newsId);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id; // Assumindo que o usuário está autenticado
        $comment->news_id = $news->id;
        $comment->save();

        return response()->json(['message' => 'Comentário criado com sucesso!'], 201);
    }

    // Método para listar comentários de uma notícia específica
    public function index($newsId)
    {
        $news = News::findOrFail($newsId);
        $comments = $news->comments; // Acesse os comentários relacionados à notícia

        return response()->json($comments, 200);
    }

    // Método para atualizar um comentário
    public function update(Request $request, $commentId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = Comment::findOrFail($commentId);
        
        // Verifica se o usuário é o autor do comentário
        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Você não tem permissão para editar este comentário.'], 403);
        }

        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comentário atualizado com sucesso!'], 200);
    }

    // Método para excluir um comentário
    public function destroy($commentId, Request $request)
    {
        $comment = Comment::findOrFail($commentId);

        // Verifica se o usuário é o autor do comentário
        if ($comment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Você não tem permissão para excluir este comentário.'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comentário excluído com sucesso!'], 200);
    }
}
