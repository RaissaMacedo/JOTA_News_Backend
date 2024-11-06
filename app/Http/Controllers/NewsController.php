<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // Listar todas as notícias
    public function index()
    {
        return News::with('user')->get(); // Retorna as notícias com os autores
    }

    // Criar uma nova notícia
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string', // URL ou caminho da imagem
        ]);

        $news = News::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => Auth::id(), // Autor da notícia
        ]);

        return response()->json($news, 201);
    }

    // Exibir uma notícia específica
    public function show($id)
    {
        return News::with('user')->findOrFail($id);
    }

    // Atualizar uma notícia
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'subtitle' => 'string|max:255',
            'content' => 'string',
            'image' => 'nullable|string',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->only('title', 'subtitle', 'content', 'image'));

        return response()->json($news);
    }

    // Excluir uma notícia
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json(null, 204);
    }
}

