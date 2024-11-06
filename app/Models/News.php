<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // Adicionando a propriedade $fillable para permitir a atribuição em massa
    protected $fillable = [
        'title',        // Título da notícia
        'subtitle',     // Subtítulo da notícia
        'image',        // Imagem da notícia
        'content',      // Conteúdo da notícia
        'user_id',      // ID do usuário que criou a notícia
    ];

    // Relação com os comentários
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
