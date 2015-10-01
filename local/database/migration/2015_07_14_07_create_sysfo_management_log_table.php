<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysfoManagementLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysfo_management_log', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('management_id')->unsigned();
            $table->foreign('management_id')->references('id')->on('sysfo_management')->onDelete('cascade');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('sysfo_employee')->onDelete('cascade');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('sysfo_member')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('status')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sysfo_management_log');
    }
}
