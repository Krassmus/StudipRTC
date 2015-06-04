<?php

class RTCUser extends SimpleORMap {

    static protected function configure($config = array()) {
        $config['db_table'] = 'rtc_users';
        parent::configure($config);
    }
}