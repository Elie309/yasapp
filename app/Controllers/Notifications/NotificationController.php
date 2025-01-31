<?php

namespace App\Controllers\Notifications;

use App\Controllers\BaseController;
use App\Services\NotificationServices;

class NotificationController extends BaseController
{
    private $notificationServices;

    public function __construct()
    {
        $this->notificationServices = new NotificationServices();
    }

    public function index()
    {

        $employeeId = $this->session->get('id');

        $status = esc($this->request->getGet('status'));

        $response = [];

        if($status === 'unread'){
            $response = $this->notificationServices->getNotificationUnreadByEmployeeId($employeeId);
        } elseif($status === 'read'){
            $response = $this->notificationServices->getNotificationReadByEmployeeId($employeeId);
        } else {
            $response = $this->notificationServices->getAllNotificationsByEmployeeId($employeeId);
        }

        if($response['success']){
            $notifications = $response['data'];
        } else {
            $notifications = [];
        }

        return view("template/header") . 
        view('Notifications/viewNotification', [
            'notifications' => $notifications,
            'notificationType' => NotificationServices::$NOTIFICATION_TYPE,
            'notificationStatus' => NotificationServices::$NOTIFICATION_STATUS
        ]) . 
        view("template/footer");
    }
}
