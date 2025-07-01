<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrespondenceMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondence_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_notes_id');
            $table->json('correspondence_ids');
            $table->text('remark');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('file_notes_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correspondence_movements');
    }
}

