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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('kana');
            $table->string('tel')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('postcode');
            $table->string('address');
            $table->string('role')->default('user');
            $table->date('birthday');
            $table->tinyInteger('gender'); // 0男性, 1女性、2その他
            $table->text('usermemo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
};
