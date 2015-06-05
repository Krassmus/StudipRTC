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

    public static function get($identifier, $seminar_id = null) {
        $room = new RTCRoom(md5($identifier));
        if ($room->isNew()) {
            $room->setId(md5($identifier));
            if ($seminar_id) {
                $room['seminar_id'] = $seminar_id;
            }
            $room['chdate'] = time();
            $room->store();
        }
        return $room;
    }

    public function createConnector($display = "small") {
        $onlineuser = new RTCUser(array($this->getId(), $GLOBALS['user']->id));
        $onlineuser['chdate'] = time();
        $onlineuser->store();

        $this->cleanup();

        $template_factory = new Flexi_TemplateFactory(__DIR__."/../views");
        $template = $template_factory->open("rooms/".$display.".php");
        $template->set_attribute("room", $this);
        return $template;
    }

    public function render($display = "small") {
        return $this->createConnector($display)->render();
    }

    public function cleanup() {
        RTCUser::deleteBySQL("room_id = ? and chdate < UNIX_TIMESTAMP() - 30", array($this->getId()));
        return $this;
    }
}