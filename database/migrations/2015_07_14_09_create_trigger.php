<?php

use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER `group_key` BEFORE INSERT ON `sysfo_group` FOR EACH ROW
            BEGIN
                SET NEW.key = (SELECT MAX(`key`) FROM `sysfo_group`) + 1;

                IF NEW.key IS NULL THEN
                   SET NEW.key = 00;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER `member_key` BEFORE INSERT ON `sysfo_member` FOR EACH ROW
            BEGIN
                SET NEW.key = (
                    SELECT MAX(`m`.`key`) FROM `sysfo_member` AS `m`
                    LEFT JOIN `sysfo_group` AS `g` ON `m`.`group_id` = `g`.`id`
                    WHERE `m`.`group_id` = NEW.group_id
                ) + 1;

                IF NEW.key IS NULL THEN
                   SET NEW.key = 001;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER `management_status` AFTER UPDATE ON `sysfo_management` FOR EACH ROW
            BEGIN
                UPDATE `sysfo_management_log`
                SET `status` = NEW.status
                WHERE `management_id` = NEW.id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `sysfo_group_key`');
        DB::unprepared('DROP TRIGGER `sysfo_member_key`');
        DB::unprepared('DROP TRIGGER `sysfo_management_status`');
    }

}
