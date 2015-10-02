<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_account', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('confirm')->default(0);
            $table->string('confirm_token', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_account_amnesia', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email');
            $table->string('token', 100);
            $table->timestamps();
        });

        Schema::create('app_account_attempt', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('ip');
            $table->integer('count')->default(0);
            $table->timestamps();
        });

        Schema::create('app_role', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('name')->nullable();
            $table->text('description');
        });

        Schema::create('app_role_account', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('app_role')->onDelete('cascade');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('app_account')->onDelete('cascade');
        });

        Schema::create('app_permission', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('name')->nullable();
            $table->text('description');
        });

        Schema::create('app_permission_role', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('app_permission')->onDelete('cascade');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('app_role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_account');
        Schema::drop('app_account_amnesia');
        Schema::drop('app_account_attempt');
        Schema::drop('app_role');
        Schema::drop('app_role_account');
        Schema::drop('app_permission');
        Schema::drop('app_permission_role');
    }
}
