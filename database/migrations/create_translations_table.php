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
            $table->string('language_code');
            $table->enum('created_by', ['system', 'user'])->default('system');
            $table->boolean('is_enabled')->default(true);
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->unsignedBigInteger('translation_category_id')->nullable();
            $table->foreign('translation_category_id')->references('id')->on('yali_translation_categories')->onDelete('set null');
        
            $table->foreign('language_id')->references('id')->on('yali_languages')->onDelete('cascade');
            $table->unique(['group', 'key', 'language_code']);
        });

        Schema::create('yali_default_translations', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('key');
            $table->text('value')->nullable();
            $table->enum('created_by', ['system', 'user'])->default('system');
            $table->timestamps();

            $table->unique(['group', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('yali_translations');
        Schema::dropIfExists('yali_default_translations');
    }
};