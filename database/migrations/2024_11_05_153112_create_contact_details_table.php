<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('ministry_department')->nullable();
            $table->unsignedBigInteger('state')->nullable();
            $table->string('designation')->nullable();
            $table->string('organitation')->nullable();
            $table->string('email')->unique();  // Add unique constraint if necessary
            $table->string('address')->nullable();
            $table->string('pin_code', 10)->nullable(); // Limit length of pin
            $table->string('phone_number', 15)->nullable(); // Limit length of phone
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->timestamps();

            $table->foreign('ministry_department')
                ->references('id')
                ->on('ministries')
                ->onDelete('set null');  // Set to null if ministry is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
