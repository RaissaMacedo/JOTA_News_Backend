<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do usuário
            $table->string('email')->unique(); // Email único
            $table->string('password'); // Senha
            $table->enum('role', ['admin', 'editor', 'reader']); // Papel do usuário
            $table->timestamps(); // Campos de timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

