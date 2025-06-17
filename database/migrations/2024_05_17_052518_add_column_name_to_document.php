<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNameToDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('doc_id');
            $table->string('documentpath')->after('file');
            $table->string('description')->nullable()->after('documentpath');
            $table->string('status')->enum();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
             $table->dropColumn('doc_id');
             $table->dropColumn('documentpath');
             $table->dropColumn('description');
             $table->dropColumn('status');
        });
    }
}
