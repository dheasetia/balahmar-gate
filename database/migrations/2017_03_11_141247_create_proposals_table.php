<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name');
            $table->tinyInteger('hijri_created_day');
            $table->tinyInteger('hijri_created_month');
            $table->integer('hijri_created_year');
            $table->text('description');
            $table->string('responsible_person');
            $table->string('mobile', 10);
            $table->string('email');
            $table->integer('office_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('kind_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->date('execution_date')->nullable();
            $table->string('document_path');
            $table->string('video_link')->nullable();
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('offices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
