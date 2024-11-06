<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // ID da notícia
            $table->string('title'); // Título da notícia
            $table->string('subtitle')->nullable(); // Subtítulo da notícia (opcional)
            $table->string('image')->nullable(); // URL da imagem (opcional)
            $table->text('content'); // Conteúdo da notícia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Autor da notícia
            $table->timestamps(); // Campos de timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
}

