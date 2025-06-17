<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class file extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('storage');
            $table->string('metatags');
            $table->string('file')->nullable();
            $table->text('description')->nullable();
            $table->string('category_id');
            $table->string('subcategory_id');
            $table->string('department_id');
            $table->string('section_id');
            $table->string('createdBy');
            $table->string('modifiedBy');
            $table->string('deletedBy');
            $table->string('deleted_at');
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
        Schema::dropIfExists('files');
    }
}
