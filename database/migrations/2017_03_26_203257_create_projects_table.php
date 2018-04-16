<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id')->unsigned();
            $table->string('name');
            $table->date('execution_date')->nullable();
            $table->integer('kind_id')->unsigned();
            $table->string('responsible_person');
            $table->string('mobile', 10);
            $table->string('phone')->nullable();
            $table->string('document_path')->nullable;
            $table->tinyInteger('is_active')->default(0);
            $table->integer('percentage')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('proposal_id')->unsigned();
            $table->text('note')->nullable();
            $table->timestamps();


            $table->foreign('office_id')->references('id')->on('offices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('proposal_id')->references('id')->on('proposals');
            $table->foreign('kind_id')->references('id')->on('kinds');
        });

    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('projects');
    }
}
