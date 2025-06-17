<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Share extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentshares', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('role');
            $table->string('userlist');
            $table->string('department_id');
            $table->string('section_id');
            $table->string('createdBy');
            $table->string('modifiedBy');
            $table->string('deletedBy');
            $table->string('deleted_at');
            $table->string('doc_id');
            $table->string('sharetype');
            $table->string('status');
            $table->string('revert_status');
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
        Schema::dropIfExists('shares');
    }
}
