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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // 고객 ID (Customer 테이블의 외래키)
            $table->unsignedBigInteger('stylelist_id'); // 스타일리스트 ID (Stylelist 테이블의 외래키)
            $table->unsignedBigInteger('reservation_id'); // 예약 ID
            $table->string('content');
            $table->float('star');
            $table->timestamps();


            // 외래키 제약조건 설정
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('stylelist_id')->references('id')->on('stylelists')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
