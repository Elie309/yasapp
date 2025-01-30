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

    /**
     * Send a notification to an employee.
     *
     * @param int $employeeId
     * @param string $title
     * @param string $message
     * @param int $type
     * @param string|null $link
     * @return array
     */
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

    /**
     * Mark a notification as read.
     *
     * @param int $notificationId
     * @return array
     */
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

    /**
     * Mark a notification as unread.
     *
     * @param int $notificationId
     * @return array
     */
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

    /**
     * Mark all notifications as read for a specific employee.
     *
     * @param int $employeeId
     * @return array
     */
    public function markAllAsRead($employeeId)
    {
        try {
            $this->notificationModel->where('employee_id', $employeeId)->update([
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[0]
            ]);
            return ['success' => true, 'message' => 'All notifications marked as read'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Mark all notifications as unread for a specific employee.
     *
     * @param int $employeeId
     * @return array
     */
    public function markAllAsUnread($employeeId)
    {
        try {
            $this->notificationModel->where('employee_id', $employeeId)->update([
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[1]
            ]);
            return ['success' => true, 'message' => 'All notifications marked as unread'];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Delete a notification.
     *
     * @param int $notificationId
     * @return array
     */
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

    /**
     * Get notifications by employee ID.
     *
     * @param int $employeeId
     * @return array
     */
    public function getNotificationsByEmployeeId($employeeId)
    {
        try {
            $notifications = $this->notificationModel
            ->where('employee_id', $employeeId)
            ->where('notification_status', NotificationServices::$NOTIFICATION_STATUS[1])
            ->findAll();

            $notificationCount = count($notifications);
            

            return ['success' => true, 
            'message' => 'Notifications retrieved successfully', 
            'data' => $notifications,
            'unread_count' => $notificationCount
        ];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Check if a notification exists.
     *
     * @param int $notificationId
     * @return bool
     */
    public function isNotificationExist($notificationId)
    {
        return $this->notificationModel->where('notification_id', $notificationId)->countAllResults() > 0;
    }

    /**
     * Get a notification by its ID.
     *
     * @param int $notificationId
     * @return array|null
     */
    public function getNotificationById($notificationId)
    {
        return $this->notificationModel->find($notificationId);
    }

    /**
     * Check if a notification belongs to a specific employee.
     *
     * @param int $notificationId
     * @param int $employeeId
     * @return bool
     */
    public function checkIfNotificationBelongsToEmployee($notificationId, $employeeId)
    {
        return $this->notificationModel->where('notification_id', $notificationId)->where('employee_id', $employeeId)->countAllResults() > 0;
    }
}
