<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('code');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->default(0);
            $table->tinyInteger('new')->default(0);
            $table->tinyInteger('hit')->default(0);
            $table->tinyInteger('recommend')->default(0);
            $table->unsignedInteger('count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('count');
            $table->dropColumn('deleted_at');
            $table->dropColumn('new');
            $table->dropColumn('hit');
            $table->dropColumn('recommend');
        });
    }
};
