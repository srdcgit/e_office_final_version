<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCcRemarkDueDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receiptshares', function (Blueprint $table) {
            $table->text('remark')->nullable()->after('share_type'); 
            $table->date('due_date')->nullable()->after('remark'); 
            $table->string('action')->nullable()->after('due_date');
            $table->integer('priority')->nullable()->after('action'); 
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
            
            $table->dropColumn(['remark', 'due_date', 'action', 'priority']);
        });
    }
}
