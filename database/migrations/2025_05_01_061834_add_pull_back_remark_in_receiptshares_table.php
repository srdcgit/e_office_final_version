<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPullBackRemarkInReceiptsharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receiptshares', function (Blueprint $table) {
            $table->string('pull_back_remark')->nullable()->after('is_read');
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
        $table->dropColumn('pull_back_remark');
        });
    }
}
