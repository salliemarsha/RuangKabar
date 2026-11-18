
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('article_id');
            $table->timestamp('last_read_at')->useCurrent();

            $table->unique(['user_id', 'article_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_histories');
    }
};
