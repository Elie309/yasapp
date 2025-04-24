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
        
        // Pagination settings
        $perPage = 10; // Number of items per page

        $response = [];

        if ($status === 'unread') {
            $response = $this->notificationServices->paginateNotificationsByStatus($employeeId, 'unread', $perPage);
        } elseif ($status === 'read') {
            $response = $this->notificationServices->paginateNotificationsByStatus($employeeId, 'read', $perPage);
        } else {
            $response = $this->notificationServices->paginateAllNotifications($employeeId, $perPage);
        }

        $notifications = [];
        $pager = null;

        if ($response['success']) {
            $notifications = $response['data'];
            $pager = $response['pager'];
        }

        return view("template/header") . 
        view('notifications/viewNotification', [
            'notifications' => $notifications,
            'notificationType' => NotificationServices::$NOTIFICATION_TYPE,
            'notificationStatus' => NotificationServices::$NOTIFICATION_STATUS,
            'pager' => $pager,
            'status' => $status
        ]) . 
        view("template/footer");
    }
}
