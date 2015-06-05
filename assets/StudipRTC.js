
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
        for (var room_id in data.rooms) {
            jQuery(".rtc_room_" + room_id).html('');
            for (var user_id in data.rooms[room_id].user) {
                jQuery(".rtc_room_" + room_id).append(data.rooms[room_id].user[user_id].html);
            }
        }
    }
};