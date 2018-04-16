<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('nth')->default(1);
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
            $table->string('video_link')->nullable();
            $table->date('report_from');
            $table->date('report_to');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('office_id')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reports');
    }
}
