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
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[0],
                'notification_read_at' => date('Y-m-d H:i:s')
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
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[1],
                'notification_read_at' => null
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
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[0],
                'notification_read_at' => date('Y-m-d H:i:s')
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
                'notification_status' => NotificationServices::$NOTIFICATION_STATUS[1],
                'notification_read_at' => null
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
     * Get all read notifications by employee ID.
     * @param int $employeeId
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function getNotificationReadByEmployeeId($employeeId, $limit = null, $offset = 0)
    {
        return $this->getNotificationsByEmployeeIdHelper($employeeId, NotificationServices::$NOTIFICATION_STATUS[0], $limit, $offset);
    }

    /**
     * Get all unread notifications by employee ID.
     * @param int $employeeId
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function getNotificationUnreadByEmployeeId($employeeId, $limit = null, $offset = 0)
    {
        return $this->getNotificationsByEmployeeIdHelper($employeeId, NotificationServices::$NOTIFICATION_STATUS[1], $limit, $offset);
    }

    /**
     * Get all notifications.
     * @param int $employeeId
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function getAllNotificationsByEmployeeId($employeeId, $limit = null, $offset = 0)
    {
        return $this->getNotificationsByEmployeeIdHelper($employeeId, -1, $limit, $offset);
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

    /**
     * Paginate all notifications for an employee.
     * 
     * @param int $employeeId
     * @param int $perPage
     * @param int $group null for default group
     * @return array
     */
    public function paginateAllNotifications($employeeId, $perPage = 10)
    {
        try {
            $builder = $this->notificationModel->where('employee_id', $employeeId)
                                              ->orderBy('notification_created_at', 'DESC');
            
            $data = $builder->paginate($perPage);
            $pager = $this->notificationModel->pager;
            
            return [
                'success' => true, 
                'message' => 'Notifications retrieved successfully', 
                'data' => $data, 
                'pager' => $pager
            ];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Paginate notifications by status for an employee.
     * 
     * @param int $employeeId
     * @param string $status
     * @param int $perPage
     * @return array
     */
    public function paginateNotificationsByStatus($employeeId, $status, $perPage = 10)
    {
        try {
            $builder = $this->notificationModel->where('employee_id', $employeeId)
                                              ->where('notification_status', $status)
                                              ->orderBy('notification_created_at', 'DESC');
            
            $data = $builder->paginate($perPage);
            $pager = $this->notificationModel->pager;
            
            return [
                'success' => true, 
                'message' => 'Notifications retrieved successfully', 
                'data' => $data, 
                'pager' => $pager
            ];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Get notifications by employee ID.
     *
     * @param int $employeeId
     * @param int $status
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    private function getNotificationsByEmployeeIdHelper($employeeId, $status = -1, $limit = null, $offset = 0)
    {
        try {
            $notifications = $this->notificationModel->where('employee_id', $employeeId);
            if($status != -1) {
                $notifications = $notifications->where('notification_status', $status);
            }
            
            // Count total before applying limit/offset
            $count = $notifications->countAllResults(false);
            
            $notifications = $notifications->orderBy('notification_created_at', 'DESC');
            
            if ($limit !== null) {
                $notifications = $notifications->findAll($limit, $offset);
            } else {
                $notifications = $notifications->findAll();
            }

            return ['success' => true, 'message' => 'Notifications retrieved successfully', 'data' => $notifications, 'count' => $count];
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
