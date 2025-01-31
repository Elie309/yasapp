<div class="container-main print-container max-w-4xl overflow-auto mb-10">

    <div class="flex flex-row md:mt-0 items-center justify-between space-x-4">
        <button onclick="window.location.href='/'" class="my-auto flex space-x-2 cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <p>Return Home</p>
        </button>
        <h2 class="block main-title-page text-wrap">Notifications</h2>

        <!-- Mark all as read -->
        <select class="secondary-input max-w-40" name="" id="notification_status">
            <option value="all">All</option>
            <option value="unread">Unread</option>
            <option value="read">Read</option>
        </select>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    <div class="space-y-4">
        <?php if (empty($notifications)) : ?>
            <div class="p-4 bg-white shadow rounded-lg">
                <p class="text-center text-gray-900">No notifications</p>
            </div>
        <?php else : ?>
            <?php foreach ($notifications as $notification) : ?>
                <?php
                $createdAt = date('D, M d - h:i A', strtotime($notification->notification_created_at));
                $readAt = $notification->notification_status === 'read' ? "Read on " . date('D, M d - h:i A', strtotime($notification->notification_read_at)) : 'Unread';
                ?>
                <div class="notification-container 
                         <?= $notification->notification_status === 'unread' ? 'notification-container-unread' : 'notification-container-read'  ?>
                            
                         ">

                    <div class="flex flex-row justify-between items-center w-full">
                        <div class="notification-icon flex-grow-0 flex-shrink-0 mr-4   
                                  <?= $notification->notification_type === 'info' ? 'notification-icon-info' : ($notification->notification_type === 'warning' ? 'notification-icon-warning' : ($notification->notification_type === 'error' ? 'notification-icon-error' : 'notification-icon-info')); ?>
                                  w-8">
                            <span class="notification-icon-text m-0">
                                <?= $notification->notification_type === 'info' ? 'i' : ($notification->notification_type === 'warning' ? 'w' : ($notification->notification_type === 'error' ? 'e' : 'i')); ?>
                            </span>
                        </div>

                        <a href="<?= $notification->notification_link ?>"
                            class="flex flex-col w-8/12 space-y-2 flex-grow-1 flex-shrink-1">
                            <h2 class=" text-sm md:text-base  font-bold"><?= $notification->notification_title ?></h2>
                            <p class="text-gray-900 text-sm text-wrap">
                                <?= $notification->notification_message ?>
                            </p>
                        </a>


                        <div class="flex flex-col justify-between items-center mt-2 w-3/12">
                            <?php if ($notification->notification_status === 'unread') : ?>
                                <button data-id="<?= $notification->notification_id ?>"
                                    class="notification-read-button page-button hover:bg-gray-600 hover:bg-opacity-40"
                                    onclick="handleOnReadNotification(<?= $notification->notification_id ?>, 'page')">
                                    <svg class="notification-icon-read" viewBox="0 -960 960 960" height="20" width="20" class="T-I-J3 J-J5-Ji kQ9Vzb aoH">
                                        <path d="M168-192q-29.7,0-50.85-21.16T96-264.04V-696.28Q96-726 117.15-747T168-768H553q-2,17-1,35.5t6,36.5H168L480-517l140-81q14,13 37,24t41,16L480-432L168-611v347H792V-558.46q20-4.54 37.5-14.04T864-594v329.77Q864-234 842.5-213T792-192H168Zm0-504v432V-696Zm576,72q-50,0-85-35t-35-85t35-85t85-35t85,35t35,85t-35,85t-85,35Z"></path>
                                    </svg>
                                </button>

                            <?php elseif ($notification->notification_status === 'read') : ?>
                                <button data-id="<?= $notification->notification_id ?>"
                                    class="notification-read-button page-button hover:bg-gray-600 hover:bg-opacity-40" 
                                    onclick="handleOnUnreadNotification(<?= $notification->notification_id ?>)">
                                    <svg class="notification-icon-read" viewBox="0 -960 960 960" height="20" width="20" class="T-I-J3 J-J5-Ji kQ9Vzb aoH">
                                        <path d="M168-192q-29.7,0-50.85-21.16T96-264.04V-696.28Q96-726 117.15-747T168-768H553q-2,17-1,35.5t6,36.5H168L480-517l140-81q14,13 37,24t41,16L480-432L168-611v347H792V-558.46q20-4.54 37.5-14.04T864-594v329.77Q864-234 842.5-213T792-192H168Zm0-504v432V-696Zm576,72q-50,0-85-35t-35-85t35-85t85-35t85,35t35,85t-35,85t-85,35Z"></path>
                                    </svg>
                                </button>

                            <?php endif; ?>
                            <span class="button-read-text text-xs">Mark as <?= $notification->notification_status =="read" ? "unread" :"read" ?> </span>

                        </div>
                    </div>
                    <div class="flex flex-row justify-between w-full mt-2 pr-2 ">
                        <p class="p-0 text-xs text-gray-600">Created on <?= $createdAt ?></p>
                        <!-- Read at or unread -->
                        <p class="notification-read-at text-xs text-gray-600"><?= $readAt ?></p>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>