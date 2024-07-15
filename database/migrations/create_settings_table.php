<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yali_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('value')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->default('default');
            $table->text('note')->nullable();
            $table->string('source')->default('yali');
            $table->boolean('lock')->default(false);
            $table->boolean('encrypt')->default(false);
            $table->boolean('cache')->default(true);
            $table->unique(['source', 'group', 'name']);
            $table->softDeletes();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('yali_settings');
    }
};
