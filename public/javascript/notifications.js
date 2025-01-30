const notificationInnerElement = `
        <div class="notification-container flex flex-col p-2 border-b border-gray-200 z-50">
            <div class="notification-container flex flex-row">
                <div class="notification-icon w-8">
                    <span class="notification-icon-text m-0"></span>
                </div>
                <a href="" class="notification-link w-4/6 pl-4 cursor-pointer">
                    <div class="flex justify-between align-middle">
                        <p class="notification-title"></p>
                    </div>
                    <p class="notification-message text-xs truncate w-40 py-2"></p>
                </a>
                <button class="notification-read-button w-1/6 ml-4 p-2">
                    <svg class="notification-icon-read" viewBox="0 -960 960 960" height="20" width="20" class="T-I-J3 J-J5-Ji kQ9Vzb aoH">
                        <path d="M168-192q-29.7,0-50.85-21.16T96-264.04V-696.28Q96-726 117.15-747T168-768H553q-2,17-1,35.5t6,36.5H168L480-517l140-81q14,13 37,24t41,16L480-432L168-611v347H792V-558.46q20-4.54 37.5-14.04T864-594v329.77Q864-234 842.5-213T792-192H168Zm0-504v432V-696Zm576,72q-50,0-85-35t-35-85t35-85t85-35t85,35t35,85t-35,85t-85,35Z"></path>
                    </svg>
                </button>
            </div>
            <p class="notification-time text-xs text-gray-500 italic text-end">Just now</p>
        </div>
    `;

const notificationsElements = document.getElementById('notifications-dropdown');
const notificationCountElement = document.getElementById('notification-count');
const noNotificationElement = document.getElementById('no-notifications');
const errorNotificationElement = document.getElementById('error-notifications');
const notificationElement = document.createElement('li');
notificationElement.classList.add('notification-li');
notificationElement.innerHTML = notificationInnerElement;

function markAllAsRead() {
    fetch('/api/notifications/mark-all-read')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('notifications-dropdown').innerHTML = '';
                document.getElementById('notification-count').textContent = '0';
                document.getElementById('notification-count').parentElement.classList.add('hidden');
                document.getElementById('notification-count').parentElement.classList.remove('flex');
                document.getElementById('no-notifications').classList.remove('hidden');

                // Update session storage
                saveNotificationsToSession([]);
            } else {
                console.error(data.message);
            }
        }).catch(error => {
            console.error(error);
        });
}

function updateNotificationElement(id) {
    let notificationElement = document.querySelector(`button.notification-read-button[data-id="${id}"]`)
            .closest('.notification-li');
    if (notificationElement) {
        notificationElement.remove();
        // Update the notification count
        let unreadCount = parseInt(notificationCountElement.textContent);
        notificationCountElement.textContent = unreadCount - 1;

        if(unreadCount - 1 === 0) {
            notificationCountElement.parentElement.classList.add('hidden');
            notificationCountElement.parentElement.classList.remove('flex');
        }

    }
}

function markAsRead(id) {
    fetch('/api/notifications/mark-read/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update session storage
                let notifications = getNotificationsFromSession();

                if (notifications) {
                    notifications = notifications.map(notification => {
                        if (notification.notification_id === id) {
                            notification.read = true;
                        }
                        return notification;
                    });
                    saveNotificationsToSession(notifications);
                }

                // Update the notification element in the DOM
                updateNotificationElement(id);
            } else {
                console.error(data.message);
            }
        }).catch(error => {
            console.error(error);
        });
}

function markAsUnread(id) {
    fetch('/api/notifications/mark-unread/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update session storage
                let notifications = getNotificationsFromSession();
                if (notifications) {
                    notifications = notifications.map(notification => {
                        if (notification.notification_id === id) {
                            notification.read = false;
                        }
                        return notification;
                    });
                    saveNotificationsToSession(notifications);
                }

            } else {
                console.error(data.message);
            }
        }).catch(error => {
            console.error(error);
        });
}

async function fetchUnreadNotifications() {
    let data = await fetch('/api/notifications')
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                return {
                    success: data.success,
                    message: data.message,
                    notifications: data.notifications,
                    unread_count: data.unread_count
                };
            } else {
                return {
                    success: data.success,
                    message: data.message
                };
            }
        }).catch(error => {
            console.error(error);
            return {
                success: false,
                message: error
            };
        });

    return data;
}

function saveNotificationsToSession(notifications) {
    sessionStorage.setItem('notifications', JSON.stringify(notifications));
    loadNotifications(notifications, notifications.filter(notification => !notification.read).length);
}

function getNotificationsFromSession() {
    const notifications = sessionStorage.getItem('notifications');
    return notifications ? JSON.parse(notifications) : null;
}

function clearNotifications() {
    notificationsElements.querySelectorAll('.notification-container').forEach(notification => {
        notification.remove();
    });
    sessionStorage.removeItem('notifications');
}

function loadSessionNotifications() {
    let notifications = getNotificationsFromSession();

    if (notifications) {
        loadNotifications(notifications, notifications.filter(notification => !notification.read).length);
    }
}

function loadNotifications(notifications, unread_count) {
    clearNotifications();
    if (notifications.length > 0) {
        notifications.forEach(notification => {
            let clone = notificationElement.cloneNode(true);

            clone.querySelector('p.notification-title').textContent = notification.notification_title;
            clone.querySelector('p.notification-message').textContent = notification.notification_message;
            clone.querySelector('a').href = notification.notification_link;

            let dateTime = new Date(notification.notification_created_at.date);
            let time = dateTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
            let date = dateTime.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
            clone.querySelector('p.notification-time').textContent = date + ' ' + time;

            if (notification.notification_type) {
                if (notification.notification_type == 'info') {
                    clone.querySelector('div.notification-icon').classList.add('notification-icon-info');
                    clone.querySelector('span.notification-icon-text').textContent = 'i';
                } else if (notification.notification_type == 'warning') {
                    clone.querySelector('div.notification-icon').classList.add('notification-icon-warning');
                    clone.querySelector('span.notification-icon-text').textContent = 'w';
                } else if (notification.notification_type == 'error') {
                    clone.querySelector('div.notification-icon').classList.add('notification-icon-error');
                    clone.querySelector('span.notification-icon-text').textContent = 'e';
                } else {
                    clone.querySelector('div.notification-icon').classList.add('notification-icon-info');
                    clone.querySelector('span.notification-icon-text').textContent = 'i';
                }
            }

            clone.querySelector('button.notification-read-button').setAttribute('data-id', notification.notification_id);

            notificationsElements.appendChild(clone);

            clone.querySelector('button.notification-read-button').addEventListener('click', function () {
                markAsRead(notification.notification_id);
            });
        });

        notificationCountElement.textContent = unread_count;
        notificationCountElement.parentElement.classList.remove('hidden');
        notificationCountElement.parentElement.classList.add('flex');
        noNotificationElement.classList.add('hidden');

    } else {
        noNotificationElement.classList.remove('hidden');
        notificationCountElement.textContent = '0';
        notificationCountElement.parentElement.classList.add('hidden');
        notificationCountElement.parentElement.classList.remove('flex');
    }
}

async function handleFetchedNotification() {
    loadSessionNotifications()

    let data = await fetchUnreadNotifications();

    if (data.success) {
        clearNotifications();
        loadNotifications(data.notifications, data.unread_count);
        // Save notifications to session storage
        saveNotificationsToSession(data.notifications);
    } else {
        console.error(data.message);
        errorNotificationElement.classList.remove('hidden');
        errorNotificationElement.textContent = data.message;
        notificationCountElement.textContent = '0';
        notificationCountElement.parentElement.classList.add('hidden');
        notificationCountElement.parentElement.classList.remove('flex');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    handleFetchedNotification();
});

