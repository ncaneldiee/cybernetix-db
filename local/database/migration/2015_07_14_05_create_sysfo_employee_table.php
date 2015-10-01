<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysfoEmployeeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysfo_employee', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('sysfo_employee')->onDelete('set null');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('lane')->unsigned()->default(0);
            $table->integer('sort')->unsigned()->default(0);
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
        Schema::drop('sysfo_employee');
    }

}
