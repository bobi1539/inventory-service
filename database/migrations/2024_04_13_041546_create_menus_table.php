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
        Schema::create("menus", function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->integer("sequence")->unique()->nullable(false);
            $table->string("icon")->nullable(false);
            $table->string("url")->nullable(false);
            $table->unsignedBigInteger("created_by");
            $table->string("created_by_name");
            $table->unsignedBigInteger("updated_by");
            $table->string("updated_by_name");
            $table->boolean("is_deleted")->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("menus");
    }
};
