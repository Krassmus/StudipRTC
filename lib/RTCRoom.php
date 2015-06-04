<?php

class RTCRoom extends SimpleORMap {

    static protected function configure($config = array()) {
        $config['db_table'] = 'rtc_rooms';
        $config['has_many']['users'] = array(
            'class_name' => 'RTCUser',
            'on_delete' => 'delete',
            'on_store' => 'store'
        );
        parent::configure($config);
    }

    public static function get($identifier) {
        $room = new RTCRoom(md5($identifier));
        if ($room->isNew()) {
            $room->setId(md5($identifier));
            $room->store();
        }
        return $room;
    }

    public function createConnector() {

    }

    public function displayUsers($format = "small") {
        echo '<ul class="clean rtc_room rtc_room_'.$this->getId().'"></ul>';
    }
}