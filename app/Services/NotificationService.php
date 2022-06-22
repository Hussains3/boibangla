<?php


namespace App\Services;


use App\Notifications\UserNotification;
use App\User;
use Pusher\Pusher;

class NotificationService
{
    /**
     * This function sends to notifications to users
     * @param $user
     * @param $message
     * @return bool
     * @throws \Pusher\PusherException
     */
    public static function sendNotification($user,$message)
    {
        $user->notify(new UserNotification($message));
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $pusher->trigger('notification', 'notification-event', $message);
        return true;
    }

    /**
     * This function returns the all the notifications
     * @param $userId
     * @param $limit
     * @return mixed
     */
    public static function getNotifications($userId,$limit)
    {
        $notification = User::find($userId)->unreadNotifications();
        if ($limit){
            return $notification->limit($limit)->get();
        }else{
            return $notification->get();
        }
    }
    /**
     * This function returns the all the notifications
     * @param $userId
     * @param $limit
     * @return mixed
     */
    public static function getAllNotifications($userId)
    {
        return User::find($userId)->notifications()->get();
    }

    /**
     * This function marks the notification to be read
     * @param $user
     * @param $request
     * @return bool
     */
    public static function markAsRead($user,$request)
    {
        $notification = $user->unreadNotifications()->find($request->notificationId);
        if ($notification){
            $notification->markAsRead();
        }
        return true;
    }

    /**
     * This function marks all the notifications to be read
     * @param $user
     * @return bool
     */
    public static function markAllAsRead($user)
    {
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return true;
    }
}
