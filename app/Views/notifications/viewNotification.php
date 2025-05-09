<div class="container-main print-container max-w-2xl overflow-auto mb-10">

    <div class="flex flex-col sm:flex-row md:mt-0 items-center justify-between mb-4">

        <h2 class=" main-title-page pl-4 md:p-0 text-center sm:text-start ">Notifications</h2>
        <!-- Mark all as read -->
        <select class="secondary-input max-w-40" name="" id="notification_status">
            <option value="all">All</option>
            <option value="unread">Unread</option>
            <option value="read">Read</option>
        </select>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <!-- Notification Counter -->
    <div class="mb-4 px-1">
        <span class="text-sm text-gray-600">
            <?php
            $unreadCount = 0;
            foreach ($notifications as $notification) {
                if ($notification->notification_status === 'unread') $unreadCount++;
            }
            echo count($notifications) . " notification" . (count($notifications) != 1 ? "s" : "");
            if ($unreadCount > 0) echo " ($unreadCount unread)";
            ?>
        </span>
    </div>

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
                <div class="notification-container p-4 transition-all duration-200
                         <?= $notification->notification_status === 'unread' ? 'notification-container-unread' : 'notification-container-read'  ?>">

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-3">
                        <div class="notification-icon flex-shrink-0 mr-2 sm:mr-4 rounded-full flex items-center justify-center
                                  <?= $notification->notification_type === 'info' ? 'notification-icon-info' : ($notification->notification_type === 'warning' ? 'notification-icon-warning' : ($notification->notification_type === 'error' ? 'notification-icon-error' : 'notification-icon-info')); ?>
                                  w-9 h-9">
                            <span class="notification-icon-text m-0 text-center font-semibold">
                                <?= $notification->notification_type === 'info' ? 'i' : ($notification->notification_type === 'warning' ? 'w' : ($notification->notification_type === 'error' ? 'e' : 'i')); ?>
                            </span>
                        </div>

                        <a href="<?= $notification->notification_link ?>"
                            class="flex flex-col w-full sm:w-8/12 space-y-2 flex-grow">
                            <h2 class="text-sm md:text-base font-bold"><?= $notification->notification_title ?></h2>
                            <p class="text-gray-900 text-sm text-wrap">
                                <?= $notification->notification_message ?>
                            </p>
                        </a>

                        <div class="flex flex-row sm:flex-col justify-between items-center mt-2 w-full sm:w-auto sm:min-w-24">
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
                            <span class="button-read-text text-xs ml-2 sm:ml-0 sm:mt-1"><?= $notification->notification_status === "read" ? "Mark as unread" : "Mark as read" ?></span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between w-full mt-3 pr-2 text-xs text-gray-600">
                        <p class="p-0">Created on <?= $createdAt ?></p>
                        <!-- Read at or unread -->
                        <p class="notification-read-at <?= $notification->notification_status === 'unread' ? 'font-medium text-blue-600' : '' ?>"><?= $readAt ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (isset($pager)) : ?>
        <div class="pagination-container">
            <?= $pager->links() ?>
        </div>

        <div>
            <span class="main-label">Current Page: <?= count($notifications) ?> / <?= $pager->getPerPage() ?></span>
            <span class="main-label">Total Clients: <?= $pager->getTotal() ?></span>

        </div>
    <?php endif; ?>
</div>