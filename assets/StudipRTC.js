
STUDIP.StudipRTC = {
    rooms: {},
    periodicalPushData: function () {
        if (jQuery(".rtc_room").length === 0) {
            return null;
        } else {
            var output = {
                rooms: {}
            };
            var rooms = jQuery(".rtc_room").each(function () {
                var room_id = jQuery(this).data("room_id");
                output.rooms[room_id] = 1;
            });
            return output;
        }
    },
    updateRooms: function (data) {

    }
};