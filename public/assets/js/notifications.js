importScripts("https://js.pusher.com/beams/service-worker.js");
// import Pusher from "pusher-js";
//Remember to replace key and cluster with your credentials.
var pusher = new Pusher('ec590b2373ef86240afa', {
    cluster: 'ap2',
    encrypted: true
});

//Also remember to change channel and event name if your's are different.
var channel = pusher.subscribe('notification');
channel.bind('notification-event', function(message) {
    console.log(message);
    getNotifications();
});

$(document).ready(function () {
    getNotifications();
});

function getNotifications() {
    let notificationsHtml = ``;
    $.ajax({
        url:BASE_URL+'customer/notification/list',
        method:'GET',
        data:{
            limit:5,
        },
        success:function (response) {
            console.log(response.notifications);
            $(".notifications-count").text(response.notifications.length);
            if (response.notifications.length) {
                $.each(response.notifications,function (key,notification) {
                    let notificationMessage = notification.data.message.substring(0,30);
                    notificationsHtml += `
                      <div class="dropdown-divider"></div>
                        <a href="javaScript:void(0)"  class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> `+notificationMessage+`
                        </a>`;
                });
                notificationsHtml += `
                        <div class="dropdown-divider"></div>
                         <a href="javaScript:void(0);" onclick="markAllAsRead();" class="dropdown-item dropdown-footer text-center"><b>Mark All Read</b></a>`;

             }
            else{
                notificationsHtml += `<a href="javaScript:void(0)" class="dropdown-item d-none no-notification"><i class="fa fa-bell-slash text-danger mr-2"></i>There is no notification</a>`;
            }
            notificationsHtml += `<a href="${BASE_URL}customer/notification" class="dropdown-item dropdown-footer text-center"><b>View All Notifications</b></a>`;
            $(".notification-dropdown").html(notificationsHtml);

            $(".notification-dropdown .no-notification").removeClass('d-none');
        },
        error:function (errorResponse) {
            console.log(errorResponse);
        }
    });
}

/**
 * This function marks all notifications to read
 */
function markAllAsRead() {
    $.ajax({
        url: BASE_URL + 'customer/notification/mark-all-read',
        method: 'POST',
        data: {},
        success: function (response) {
            if (response.success){
                toastr.success(response.message);
                getNotifications();
            }
        }
    });
}
