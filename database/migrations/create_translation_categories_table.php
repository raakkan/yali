<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yali_translation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('source_name')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('yali_translation_categories');
    }
};