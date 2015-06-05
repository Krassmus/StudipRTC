<?php

require_once __DIR__."/lib/RTCRoom.php";
require_once __DIR__."/lib/RTCUser.php";
require_once __DIR__."/lib/RTCConnection.php";

class StudipRTC extends StudIPPlugin implements SystemPlugin {

    public function __construct()
    {
        parent::__construct();
        PageLayout::addScript($this->getPluginURL()."/assets/StudipRTC.js");
        $this->addStylesheet('assets/StudipRTC.less');
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

                    $output['rooms'][$room_id]['user'] = array();

                    foreach ($room->users as $roomuser) {
                        if ($roomuser['user_id'] !== $GLOBALS['user']->id) {
                            $template_factory = new Flexi_TemplateFactory(__DIR__."/views");
                            $template = $template_factory->open("rooms/_user.php");
                            $template->set_attribute("user", $roomuser);
                            $output['rooms'][$room_id]['user'][$roomuser['user_id']] = array(
                                'name' => get_fullname($roomuser['user_id']),
                                'html' => $template->render()
                            );
                        }
                    }
                }
                UpdateInformation::setInformation("StudipRTC.updateRooms", $output);
            }
        }
    }
}