<?php

use Illuminate\Database\Migrations\Migration;

class UpdateZerofill extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('ALTER TABLE `sysfo_group` CHANGE `key` `key` INT(2) unsigned zerofill DEFAULT 00;');
        DB::unprepared('ALTER TABLE `sysfo_member` CHANGE `key` `key` INT(3) unsigned zerofill DEFAULT 001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('ALTER TABLE `sysfo_group` CHANGE `key` `key` INT(11) unsigned DEFAULT 0;');
        DB::unprepared('ALTER TABLE `sysfo_member` CHANGE `key` `key` INT(11) unsigned DEFAULT 1;');
    }

}
