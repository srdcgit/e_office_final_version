<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receiptshare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('receipt_share',function(Blueprint $table){
            $table->id()->nullable();
            $table->string('receipt_id')->nullable();
            $table->string('sender_id');
            $table->string('department_id');
            $table->string('section_id');
            $table->string('recever_id');
            $table->string('formdate');
            $table->string('todate');
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
        Schema::dropIfExists('receipt_share');
    }
}
