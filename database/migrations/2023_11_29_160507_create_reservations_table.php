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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // 예약의 고유 ID
            $table->unsignedBigInteger('customer_id'); // 고객 ID (Customer 테이블의 외래키)
            $table->unsignedBigInteger('stylist_id'); // 스타일리스트 ID (Stylelist 테이블의 외래키)
            $table->date('date'); // 예약 날짜
            $table->time('time'); // 예약 시간
            $table->string('status')->default('reservated'); // 예약 상태 ('확정', '취소' 등)
            $table->timestamps(); // 생성 및 업데이트 시간 기록

            // 외래키 제약조건 설정
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('stylist_id')->references('id')->on('stylelists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
