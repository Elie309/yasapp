<?php

namespace App\Services;

use App\Models\Notifications\NotificationModel;
use Exception;

class NotificationServices extends BaseServices
{
    protected $notificationModel;

    /**
     * Notification type - Order of array is important
     * 1 - Info
     * 2 - Warning
     * 3 - Error
     */
    public static $NOTIFICATION_TYPE = [
        1 => 'info',
        2 => 'warning',
        3 => 'error'
    ];

    /**
     * Notification status - Order of array is important
     */
    public static $NOTIFICATION_STATUS = [
        'read',
        'unread'
    ];

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    public function send($employeeId, $title, $message, $type, $link = null)
    {
        $data = [
            'employee_id' => $employeeId,
            'notification_title' => $title,
            'notification_message' => $message,
            'notification_type' => $type,
            'notification_status' => 'unread',
            'notification_link' => $link,
        ];

        try {
            $this->notificationModel->save($data);
            return ['success' => true, 'message' => 'Notification sent successfully'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function markAsRead($notificationId)
    {
        try {
            $this->notificationModel->update($notificationId, [
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[0]
            ]);
            return ['success' => true, 'message' => 'Notification marked as read'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function markAsUnread($notificationId)
    {
        try {
            $this->notificationModel->update($notificationId, [
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[1]
            ]);
            return ['success' => true, 'message' => 'Notification marked as unread'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteNotification($notificationId)
    {
        try {
            $this->notificationModel->delete($notificationId);
            return ['success' => true, 'message' => 'Notification deleted successfully'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getNotificationsByEmployeeId($employeeId)
    {
        try {
            $notifications = $this->notificationModel->where('employee_id', $employeeId)->findAll();
            return ['success' => true, 'message' => 'Notifications retrieved successfully', 'data' => $notifications];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
