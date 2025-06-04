<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');                  // título do livro
            $table->string('cover_image')->nullable(); // caminho da imagem de capa (upload opcional)
            $table->text('description')->nullable();
            $table->unsignedBigInteger('author_id');  // relacionamento com authors
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
