<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Adicionando a propriedade $fillable para permitir a atribuição em massa
    protected $fillable = [
        'user_id', // ID do usuário que fez o comentário
        'news_id', // ID da notícia à qual o comentário pertence
        'content',  // Conteúdo do comentário
    ];

    // Relação com a notícia
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
