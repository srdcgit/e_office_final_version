<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts',function(Blueprint $table){
            $table->id();
            $table->string('receip_tstatus');
            $table->string('receipt_file');
            $table->string('dairy_date');
            $table->string('form_of_communication');
            $table->string('language');
            $table->string('receved_date');
            $table->string('letter_date');
            $table->string('letter_ref_no');
            $table->string('delivery_mode');
            $table->string('mode_number');
            $table->string('sender_type');
            $table->string('vip');
            $table->string('name');
            $table->string('department');
            $table->string('designation');
            $table->string('organitation');
            $table->string('email');
            $table->string('address');
            $table->string('pin_code');
            $table->string('phone_number');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('category');
            $table->string('subcategory');
            $table->string('subject');
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
