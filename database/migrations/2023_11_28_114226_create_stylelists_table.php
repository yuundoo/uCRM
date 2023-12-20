<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylelists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_image');
            $table->text('description');
            $table->integer('review_count')->default(0);
            $table->float('average_rating', 8, 2)->default(0.0);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stylelists');
    }
};
