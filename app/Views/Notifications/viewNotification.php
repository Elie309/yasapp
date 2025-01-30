<div class="container-main print-container max-w-4xl overflow-auto mb-10">

    <div class="flex flex-row md:mt-0 items-center justify-between space-x-4">
        <button onclick="window.location.href='/'" class="my-auto flex space-x-2 cursor-pointer no-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            <p>Return Home</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Notifications</h2>

        <!-- Mark all as read -->
        <button class="primary-btn p-2 text-sm rounded-lg no-print" onclick="markAllAsRead">Mark all as read</button>
    </div>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    <div class="space-y-4">
        <?php if (empty($notifications)) : ?>
            <div class="p-4 bg-white shadow rounded-lg">
                <p class="text-center text-gray-900">No notifications</p>
            </div>
        <?php else : ?>
            <?php foreach ($notifications as $notification) : ?>

                <div class="p-4 shadow rounded-lg w-full flex flex-row justify-between items-center space-x-4
                         <?= $notification->notification_status === 'unread' ? 'bg-white' : 'bg-gray-400 bg-opacity-40'  ?>
                        hover:bg-gray-400
                        transition duration-300 ease-in-out transform hover:-translate-y-1 
                         ">

                    <div class="notification-icon flex-grow-0 flex-shrink-0 
                                <?= $notification->notification_type === 'info' ? 'notification-icon-info' : ($notification->notification_type === 'warning' ? 'notification-icon-warning' : ($notification->notification_type === 'error' ? 'notification-icon-error' : 'notification-icon-info')); ?>
                                w-8">
                        <span class="notification-icon-text m-0">
                            <?= $notification->notification_type === 'info' ? 'i' : ($notification->notification_type === 'warning' ? 'w' : ($notification->notification_type === 'error' ? 'e' : 'i')); ?>
                        </span>
                    </div>

                    <a href="<?= $notification->notification_link ?>"class="flex flex-col w-8/12 space-y-2 flex-grow-1 flex-shrink-1">
                        <h2 class="text-lg font-bold"><?= $notification->notification_title ?></h2>
                        <p class="text-gray-900 text-sm"><?= $notification->notification_message ?></p>
                    </a>


                    <div class="flex flex-col justify-between items-center mt-2 w-3/12">
                            <?php if ($notification->notification_status === 'unread') : ?>
                                <button data-id="<?= $notification->notification_id ?> " class="text-red-800" onclick="markAsRead(<?= $notification->notification_id ?>)">Mark as read</button>
                            <?php elseif ($notification->notification_status === 'read') : ?>
                                <button data-id="<?= $notification->notification_id ?> " class="text-red-800" onclick="markAsUnread(<?= $notification->notification_id ?>)">Mark as unread</button>
                            <?php endif; ?>
                        <span class="text-sm text-gray-600"><?= $notification->notification_created_at ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>