<?php

require_once __DIR__."/lib/RTCRoom.php";
require_once __DIR__."/lib/RTCUser.php";
require_once __DIR__."/lib/RTCConnection.php";

class StudipRTC extends StudIPPlugin implements SystemPlugin {

    public function __construct()
    {
        parent::__construct();
        PageLayout::addScript($this->getPluginURL()."/assets/StudipRTC.js");
        if (UpdateInformation::isCollecting() && UpdateInformation::hasData("StudipRTC")) {
            $data = UpdateInformation::getData("StudipRTC");
            if ($data) {
                $output = array();
                foreach ($data['rooms'] as $room_id => $room_data) {
                    $roomuser = new RTCUser(array($room_id, $GLOBALS['user']->id));
                    $roomuser['chdate'] = time();
                    $roomuser->store();

                    $room = new RTCRoom($room_id);
                    $room->cleanup();
                    foreach ($room->users as $roomuser) {
                        if ($roomuser['user_id'] !== $GLOBALS['user']->id) {
                            $output[$room_id]['users'][$roomuser['user_id']] = array(
                                'name' => get_fullname($roomuser['user_id'])
                            );
                        }
                    }
                }
                UpdateInformation::setInformation("StudipRTC.updateRooms", $output);
            }
        }
    }
}