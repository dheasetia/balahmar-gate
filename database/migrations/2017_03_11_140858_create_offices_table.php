<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('user_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('advisor_id')->unsigned();
            $table->string('manager_name')->nullable();
            $table->string('license_no')->unique()->nullable();
            $table->string('license_date')->nullable();
            $table->integer('bank_id')->unsigned();
            $table->string('iban');
            $table->string('representative');
            $table->string('mobile', 10);
            $table->string('phone', 16);
            $table->string('second_phone', 16)->nullable();
            $table->string('fax', 16)->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('is_banned')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_approved')->default(0);
            $table->integer('area_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('building_no')->nullable();
            $table->string('additional_no')->nullable();
            $table->string('po_box')->nullable();
            $table->string('zip_code');
            $table->string('coordinate')->nullable();
            $table->text('ban_reason')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('advisor_id')->references('id')->on('advisors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
