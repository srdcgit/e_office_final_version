<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSendBackToReceiptShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receiptshares', function (Blueprint $table) {
            $table->integer('send_back')->nullable()->comment("1=>Send Back,2=>Normal Share"); // Example column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receiptshares', function (Blueprint $table) {
            $table->dropColumn('send_back');
        });
    }
}
