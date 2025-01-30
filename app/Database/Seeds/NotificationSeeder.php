<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
       //Get all employees
         $employees = $this->db->table('employees')->get()->getResultArray();

            //Get all notification types
        $notificationsServices = new \App\Services\NotificationServices();
        
        $notificationTypes = $notificationsServices::$NOTIFICATION_TYPE;

        //Get all notification statuses
        $notificationStatuses = $notificationsServices::$NOTIFICATION_STATUS;

        //Generate 100 notifications
        for ($i = 0; $i < 100; $i++) {
            $employee = $employees[array_rand($employees)];
            $type = array_rand($notificationTypes);
            $status = array_rand($notificationStatuses);
            $data = [
                'employee_id' => $employee['employee_id'],
                'notification_title' => 'Notification Title ' . $i,
                'notification_message' => 'Notification Message ' . $i,
                'notification_type' => $notificationTypes[$type],
                'notification_status' => $notificationStatuses[$status],
                'notification_link' => 'https://example.com/notification/' . $i,
            ];

            $this->db->table('notifications')->insert($data);
        }
    }
}
