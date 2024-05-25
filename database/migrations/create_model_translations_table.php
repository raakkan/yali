<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yali_model_translations', function (Blueprint $table) {
            $table->id();
            $table->morphs('translatable');
            $table->string('key');
            $table->string('locale');
            $table->text('value')->nullable();
            $table->timestamps();
        
            $table->unique(['translatable_id', 'translatable_type', 'key', 'locale'], 'unique_translation_key');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('yali_model_translations');
    }
};
