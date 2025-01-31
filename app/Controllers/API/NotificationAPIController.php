<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Services\NotificationServices;
use Exception;

class NotificationAPIController extends BaseController
{

    private $notificationServices;

    public function __construct()
    {
        $this->notificationServices = new NotificationServices();
    }

    public function unreadNotifications()
    {
        $employee_id = $this->session->get('id');

        try {

            $notifications = $this->notificationServices->getNotificationUnreadByEmployeeId($employee_id);

            return $this->response->setStatusCode(200)->setJSON(
                [
                    'success' => true,
                    'notifications' => $notifications['data'],
                    'unread_count' => $notifications['count']
                ]
            );

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function markRead($notification_id)
    {
        try {

            $employee_id = $this->session->get('id');

            if ($this->notificationServices->checkIfNotificationBelongsToEmployee($notification_id,  $employee_id) === false) {
                return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Notification does not belong to you']);
            }


            $response = $this->notificationServices->markAsRead($notification_id);

            if ($response['success'] === false) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => $response['message']]);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Notification marked as read']);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function markUnread($notification_id)
    {
        try {

            $employee_id = $this->session->get('id');

            if ($this->notificationServices->checkIfNotificationBelongsToEmployee($notification_id,  $employee_id) === false) {
                return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Notification does not belong to you']);
            }

            $response = $this->notificationServices->markAsUnread($notification_id);

            if ($response['success'] === false) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => $response['message']]);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Notification marked as unread']);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function markAllRead()
    {
        try {

            $employee_id = $this->session->get('id');

            $response = $this->notificationServices->markAllAsRead($employee_id);

            if ($response['success'] === false) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => $response['message']]);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'All notifications marked as read']);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function markAllUnread()
    {
        try {

            $employee_id = $this->session->get('id');

            $response = $this->notificationServices->markAllAsUnread($employee_id);

            if ($response['success'] === false) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => $response['message']]);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'All notifications marked as unread']);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete($notification_id)
    {
        try {

            $employee_id = $this->session->get('id');

            if ($this->notificationServices->checkIfNotificationBelongsToEmployee($notification_id,  $employee_id) === false) {
                return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Notification does not belong to you']);
            }

            $response = $this->notificationServices->deleteNotification($notification_id);

            if ($response['success'] === false) {
                return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => $response['message']]);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Notification deleted']);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
