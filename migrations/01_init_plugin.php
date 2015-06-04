<?php
class InitPlugin extends DBMigration
{
    function up()
    {
        DBManager::exec("
            CREATE TABLE IF NOT EXISTS `rtc_rooms` (
                `room_id` varchar(32) NOT NULL,
                `seminar_id` varchar(32) DEFAULT NULL,
                `settings` text,
                `chdate` bigint(20) NOT NULL,
                `mkdate` bigint(20) NOT NULL,
                PRIMARY KEY (`room_id`),
                KEY `seminar_id` (`seminar_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `rtc_users` (
                `room_id` varchar(32) NOT NULL,
                `user_id` varchar(32) NOT NULL,
                `webrtc` tinyint(4) NOT NULL,
                `chdate` int(11) NOT NULL,
                `mkdate` int(11) NOT NULL,
                PRIMARY KEY (`room_id`,`user_id`)
            )
        ");
        
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `rtc_connections` (
                `room_id` varchar(32) NOT NULL,
                `user_id` varchar(32) NOT NULL,
                `offer_sdp` text NOT NULL,
                `answerer_id` varchar(32) NOT NULL,
                `answer_sdp` text,
                `chdate` bigint(20) NOT NULL,
                `mkdate` bigint(20) NOT NULL,
                PRIMARY KEY (`room_id`,`user_id`,`answerer_id`)
            ) ENGINE=MyISAM
        ");
    }
    
    function down() {
        DBManager::get()->exec("DROP TABLE IF EXISTS `videochat_users` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `videochat_connections` ");
    }
}