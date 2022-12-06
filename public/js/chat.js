$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    if ($("#tipe-user").val() == 1) {
        let adminId = $("#admin-id").val();

        if (adminId == undefined) {
            const now = new Date();
            let hour = "" + now.getHours();
            let minute = "" + now.getMinutes();
            if (hour < 10) hour = "0" + hour;
            if (minute < 10) minute = "0" + minute;
            const current = hour + ":" + minute;
            $("#msg_history").append(
                `                   
                <div class="incoming_msg">
                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p>You dont have any transaction</p>
                        <span class="time_date"> ${current} | Today</span>
                    </div>
                </div>
                </div>
                `
            );
        } else {
            let formData = new FormData();
            formData.append("friend_id", adminId);
            createRoom(formData, adminId);
        }
    }

    $(".user").on("click", function () {
        event.preventDefault();
        let id = this.getAttribute("data-id");
        let old_room = $("#old-room-id").val();
        $("#old-user-id").val(id);

        $(".user").removeClass("active_chat");
        $(this).addClass("active_chat");
        // console.log(id);

        if (old_room != "") {
            Echo.leave(`chat.${old_room}`);
        }

        let formData = new FormData();
        formData.append("friend_id", id);
        createRoom(formData);
    });
});

function createRoom(data) {
    $.ajax({
        type: "POST",
        url: "/room/create",
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
            // console.log(data.data);
            var roomId = data.data.room.id_room;
            loadMessage(roomId, $("#old-user-id").val());
            $("#old-room-id").val(roomId);
            Echo.join(`chat.${roomId}`)
                .here((users) => {
                    let room_id = users[0].roomId;
                    // console.log(room_id);
                    $("#msg_send_btn").unbind("click");
                    $("#msg_send_btn").click(function () {
                        let message = $("#write_msg").val();
                        if (message != "") {
                            // console.log(room_id);
                            sendMessage(message, room_id);

                            $("#write_msg").val("");
                        }
                    });
                })
                .listen("SendMessage", (e) => {
                    let old = $("#old-user-id").val();
                    // console.log(old);
                    if (old != undefined) {
                        if (e.userId == old) {
                            incomingMessage(e.message);
                        }
                    } else {
                        incomingMessage(e.message);
                    }
                })
                .joining((user) => {
                    // console.log(user, "join");
                })
                .leaving((user) => {
                    // console.log(user, "leaving");
                })
                .error((error) => {
                    console.error(error, "error");
                });
        },
        error: function (xhr, textStatus, errorThrown) {
            swal({
                title: "Interupt!",
                text: "User Connect Failed",
                type: "warning",
                showConfirmButton: false,
                timer: 1500,
            }).catch(function (timeout) {});
        },
    });
}

function sendMessage(message, roomId) {
    let formData = new FormData();
    formData.append("roomId", roomId);
    formData.append("message", message);

    // for (const pair of formData.entries()) {
    //     console.log(`${pair[0]}, ${pair[1]}`);
    // }

    $.ajax({
        type: "POST",
        url: "/chat/save-chat",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            // console.log(data.success);
            const now = new Date();
            let hour = "" + now.getHours();
            let minute = "" + now.getMinutes();
            if (hour < 10) hour = "0" + hour;
            if (minute < 10) minute = "0" + minute;
            const current = hour + ":" + minute;
            $("#msg_history").append(
                `                   
                <div class="outgoing_msg">
                    <div class="sent_msg">
                        <p>${message}</p>
                        <span class="time_date"> ${current} | Today</span>
                    </div>
                </div>
                `
            );
            $("#msg_history").animate(
                { scrollTop: $("#msg_history").prop("scrollHeight") },
                1000
            );
        },
        error: function (xhr, textStatus, errorThrown) {
            swal({
                title: "Interupt!",
                text: "Send Message Failed",
                type: "warning",
                showConfirmButton: false,
                timer: 1500,
            }).catch(function (timeout) {});
        },
    });
}

function incomingMessage(message) {
    const now = new Date();
    let hour = "" + now.getHours();
    let minute = "" + now.getMinutes();
    if (hour < 10) hour = "0" + hour;
    if (minute < 10) minute = "0" + minute;
    const current = hour + ":" + minute;
    $("#msg_history").append(
        `                   
        <div class="incoming_msg">
        <div class="received_msg">
            <div class="received_withd_msg">
                <p>${message}</p>
                <span class="time_date"> ${current} | Today</span>
            </div>
        </div>
        </div>
        `
    );
    $("#msg_history").animate(
        { scrollTop: $("#msg_history").prop("scrollHeight") },
        1000
    );
}

function formatHourMinute(date) {
    let tanggal = moment(date, "YYYY-MM-DD HH:mm:ss").format("HH:mm");
    return tanggal;
}

function formatDate(date) {
    let tanggal = moment(date, "YYYY-MM-DD HH:mm:ss").format("D MMM");
    return tanggal;
}

function loadMessage(roomId, friend_id) {
    $("#msg_history").html("");
    if (friend_id == undefined) {
        friend_id = 1;
    }
    $.ajax({
        type: "GET",
        url: "chat/load-chat/" + roomId,
        success: function (data) {
            // console.log(data.data);
            let pesans = data.data;
            if (pesans.length > 0) {
                pesans.forEach((pesan) => {
                    let tanggal = formatDate(pesan.updated_at);
                    let jam = formatHourMinute(pesan.updated_at);
                    if (pesan.id_user == friend_id) {
                        $("#msg_history").append(
                            `                   
                            <div class="incoming_msg">
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>${pesan.message}</p>
                                    <span class="time_date"> ${jam} | ${tanggal}</span>
                                </div>
                            </div>
                            </div>
                            `
                        );
                    } else {
                        let tanggal = formatDate(pesan.updated_at);
                        let jam = formatHourMinute(pesan.updated_at);
                        $("#msg_history").append(
                            `                   
                            <div class="outgoing_msg">
                                <div class="sent_msg">
                                    <p>${pesan.message}</p>
                                    <span class="time_date"> ${jam} | ${tanggal} </span>
                                </div>
                            </div>
                            `
                        );
                    }
                });
                $("#msg_history").animate(
                    {
                        scrollTop: $("#msg_history").prop("scrollHeight"),
                    },
                    1000
                );
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            swal({
                title: "Interupt!",
                text: "Send Message Failed",
                type: "warning",
                showConfirmButton: false,
                timer: 1500,
            }).catch(function (timeout) {});
        },
    });
}
