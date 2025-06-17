<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fileshare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileshares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('gnotes_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('recever_id')->nullable();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('section_id');
            $table->string('notifyby')->nullable();
            $table->integer('share_file_status');
            $table->string('remarks')->nullable();
            $table->date('duedate')->nullable();
            $table->string('actiontype')->nullable();
            $table->string('priority')->nullable();
            $table->string('comments')->nullable();
            $table->integer('status')->comment('0=Shared, 1=revert, 2=forward, 3=The status will set, when the reverted file is corrected and send');
            $table->integer('read_status')->nullable()->comment('0 = Unread,1 = Read');
            $table->unsignedBigInteger('createdBy');

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
        Schema::dropIfExists('fileshares');
    }
}
