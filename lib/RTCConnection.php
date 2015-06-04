<?php

class RTCConnection extends SimpleORMap {

    static protected function configure($config = array()) {
        $config['db_table'] = 'rtc_connections';
        parent::configure($config);
    }
}