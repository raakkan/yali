<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yali_translations', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('key');
            $table->text('value')->nullable();
            $table->longText('note')->nullable();
            $table->enum('created_by', ['system', 'user'])->default('system');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();

            $table->foreignId('translation_category_id')->references('id')->on('yali_translation_categories')->constrained();
        
            $table->string('language_code');
            $table->foreign('language_code')->references('code')->on('yali_languages')->onDelete('cascade');

            $table->unique(['group', 'key', 'language_code']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('yali_translations');
    }
};