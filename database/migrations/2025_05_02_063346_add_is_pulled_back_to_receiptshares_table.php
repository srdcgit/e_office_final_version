<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPulledBackToReceiptsharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receiptshares', function (Blueprint $table) {
            $table->boolean('is_pulled_back')->default(false)->after('is_read');
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
            $table->dropColumn('is_pulled_back');
        });
    }
}
