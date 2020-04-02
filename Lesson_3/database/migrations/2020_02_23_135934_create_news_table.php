<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('category_id');
            $table->string('title')->comment('Заголовок новости');
            $table->text('text')->comment('Содержимое новости');
            $table->boolean('is_private')
                ->default(false)
                ->comment('Скрытая ли новость для неавторизованных');
            $table->string('img')
                ->default('')
                ->nullable(true)
                ->comment('Ссылка на картинку');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
