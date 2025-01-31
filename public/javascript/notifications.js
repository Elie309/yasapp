const notificationInnerElement = `
        <div class="flex flex-col p-2 border-b border-gray-200 z-50">
            <div class="flex flex-row">
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
            <div class="flex flex-col justify-end">
                <p class="notification-read-at text-xs text-gray-500 italic text-end">Unread</p>
                <p class="notification-time text-xs text-gray-500 italic text-end">Just now</p>
            </div>
        </div>
    `;

const notificationsElements = document.getElementById('notifications-dropdown');
const notificationCountElement = document.getElementById('notification-count');
const noNotificationElement = document.getElementById('no-notifications');
const errorNotificationElement = document.getElementById('error-notifications');
const notificationElement = document.createElement('li');
notificationElement.classList.add('notification-li');
notificationElement.innerHTML = notificationInnerElement;



function deleteNotificationElementDropdown(id) {
    let notificationElement = document.querySelector(`button.notification-read-button[data-id="${id}"]`)
        .closest('.notification-li');
    if (notificationElement) {
        notificationElement.remove();
        // Update the notification count
        let unreadCount = parseInt(notificationCountElement.textContent);
        notificationCountElement.textContent = unreadCount - 1;

        if (unreadCount - 1 === 0) {
            notificationCountElement.parentElement.classList.add('hidden');
            notificationCountElement.parentElement.classList.remove('flex');
        }

    }
}

updateNotificationPageElement = (id, status) => {
    let buttonElement = document.querySelector(`button.page-button[data-id='${id}']`);
    let notificationElement = buttonElement.closest('.notification-container');
    if (notificationElement) {
        let readAtElement = notificationElement.querySelector('p.notification-read-at');
        let buttonReadTextElement = notificationElement.querySelector('span.button-read-text');
        if (readAtElement) {
            if (status === "read") {
                readAtElement.textContent = 'Read now';
                buttonReadTextElement.textContent = 'Mark as unread';
                notificationElement.classList.remove('notification-container-unread');
                notificationElement.classList.add('notification-container-read');
                // Change buttonEvent 
                buttonElement.addEventListener('click', function () {
                    handleOnUnreadNotification(id, "page");
                }); 

            } else {
                readAtElement.textContent = 'Unread';
                buttonReadTextElement.textContent = 'Mark as read';
                notificationElement.classList.remove('notification-container-read');
                notificationElement.classList.add('notification-container-unread');
                
                // Change buttonEvent
                buttonElement.addEventListener('click', function () {
                    handleOnReadNotification(id, "page");
                });

                handleFetchedNotification();
            }
        } else {
            console.error('Element p.notification-read-at not found');
        }
    }
}

function markAsRead(id) {
    return fetch('/api/notifications/mark-read/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                return true;
            } else {
                return null;
            }
        }).catch(error => {
            return null;
        });
}

function markAsUnread(id) {
   return fetch('/api/notifications/mark-unread/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                return true;
            } else {
                return null;
            }
        }).catch(error => {
            return null;
        });
}

function handleOnReadNotification($id, $source) {
    let succcess = markAsRead($id);
    if(succcess) {
        if($source === "notification") {
            deleteNotificationElementDropdown($id);
            //check location and update the page element
            if(window.location.pathname === '/notifications') {
                updateNotificationPageElement($id, "read");
            }
        }

        if($source === "page") {
            deleteNotificationElementDropdown($id);
            updateNotificationPageElement($id, "read");
        }
    }
}

function handleOnUnreadNotification($id) {
    let succcess = markAsUnread($id);
    if(succcess) {

       updateNotificationPageElement($id, "unread");
    }else{
        console.error("Failed to mark as unread");
    }
}
    
        


function loadNotifications(notifications, unread_count) {
    if (notifications.length > 0) {
        notifications.forEach(notification => {
            let clone = notificationElement.cloneNode(true);

            clone.querySelector('p.notification-title').textContent = notification.notification_title;
            clone.querySelector('p.notification-message').textContent = notification.notification_message;
            clone.querySelector('a').href = notification.notification_link;

            let dateTime = new Date(notification.notification_created_at.date);
            let time = dateTime.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
            let date = dateTime.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
            clone.querySelector('p.notification-time').textContent = 'Created at ' + date + ' ' + time;

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
                handleOnReadNotification(notification.notification_id, "notification");
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

    await fetch('/api/notifications')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications(data.notifications, data.unread_count);
            } else {
                errorNotificationElement.classList.remove('hidden');
                errorNotificationElement.textContent = "Failed to fetch notifications";
                notificationCountElement.textContent = '0';
                notificationCountElement.parentElement.classList.add('hidden');
                notificationCountElement.parentElement.classList.remove('flex');
            }
        }).catch(error => {
            console.error(error.message);
            errorNotificationElement.classList.remove('hidden');
            errorNotificationElement.textContent = "Failed to fetch notifications";
            notificationCountElement.textContent = '0';
            notificationCountElement.parentElement.classList.add('hidden');
            notificationCountElement.parentElement.classList.remove('flex');
        });

}


function setSelectStatus() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status) {
        document.getElementById("notification_status").value = status;
    }
}

document.getElementById("notification_status").addEventListener('change', function () {

    //This is a select option with ALL, READ and UNREAD
    const status = this.value;
    //change parameter and reload the page
    window.location.href = '/notifications?status=' + status;

});




document.addEventListener('DOMContentLoaded', function () {
    handleFetchedNotification();
    setSelectStatus();

});

