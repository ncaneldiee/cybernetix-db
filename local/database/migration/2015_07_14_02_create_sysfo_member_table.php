<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysfoMemberTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sysfo_member', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('sysfo_group')->onDelete('cascade');
            $table->integer('key')->unsigned()->default(1);
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->default('default.jpg');
            $table->enum('gender', ['f', 'm'])->default('m');
            $table->text('address')->nullable();
            $table->integer('status')->unsigned()->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sysfo_member');
    }

}
