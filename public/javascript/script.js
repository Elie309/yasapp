function toggleDropdown(id) {
    var dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');

    // Ensure the dropdown can receive focus
    dropdown.setAttribute('tabindex', '-1');
    dropdown.focus();

    // Add blur event listener to toggle dropdown again
    dropdown.addEventListener('blur', function () {
        setTimeout(function () {
            dropdown.classList.add('hidden');
        }, 100); // Adjust the timeout as needed
    });
}

function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');
}


function removeParent(event) {
    event.parentElement.remove();
}


function updateURLParameter(key, value) {
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);

    //check if key and values are arrays
    if (Array.isArray(key)) {
        key.forEach((k, i) => {
            if (Array.isArray(value)) {
                params.set(k, value[i]);
            } else {
                params.set(k, value);
            }
        });
    } else {
        // Update or add the parameter
        params.set(key, value);
    }

    // Construct the new URL
    url.search = params.toString();
    window.location.href = url.toString();
}

function closePopover(popoverId) {
    const popover = document.getElementById(popoverId);

    popover.hidePopover();
}

function showPopover(popoverId) {
    const popover = document.getElementById(popoverId);

    popover.showPopover();
}

function resetURL(url) {
    window.location.href = url;
}

async function markAllAsRead() {
   //TODO: Mark all notifications as read
}

document.addEventListener('DOMContentLoaded', function () {

    //API FETCH NOTIFICATIONS
    const notificationsElements = document.getElementById('notifications-dropdown');
    const notificationCountElement = document.getElementById('notification-count');

    let notificationElement = document.createElement('li');
    notificationElement.innerHTML = `
        <a href="" class="notification-link">
            <span></span>
            <div class="ml-2">
                <p class="notification-title">John Doe</p>
                <p class="notification-message">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </a>
        <svg class="size-4" viewBox="0 -960 960 960" 
                    height="20" width="20" focusable="false" 
                    class="T-I-J3 J-J5-Ji kQ9Vzb aoH">
                    <path d="M168-192q-29.7,0-50.85-21.16T96-264.04V-696.28Q96-726 117.15-747T168-768H553q-2,17-1,35.5t6,36.5H168L480-517l140-81q14,13 37,24t41,16L480-432L168-611v347H792V-558.46q20-4.54 37.5-14.04T864-594v329.77Q864-234 842.5-213T792-192H168Zm0-504v432V-696Zm576,72q-50,0-85-35t-35-85t35-85t85-35t85,35t35,85t-35,85t-85,35Z">
                </path>
        </svg>
    `;

    fetch('/api/notifications')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        let clone = notificationElement.cloneNode(true);

                        clone.querySelector('span').classList.add('bg-green-500', 'h-2', 'w-2', 'rounded-full');

                        clone.querySelector('p.notification-title').textContent = notification.notification_title;
                        clone.querySelector('p.notification-message').textContent = notification.notification_message;
                        clone.querySelector('a').href = notification.notification_link;
                        notificationsElements.appendChild(clone);
                    });
                    notificationCountElement.textContent = data.unread_count;
                    notificationCountElement.parentElement.classList.remove('hidden');
                    notificationCountElement.parentElement.classList.add('flex');

                } else {

                    let noNotif = document.getElementById('no-notifications');
                    noNotif.classList.remove('hidden');
                    notificationCountElement.textContent = '0';
                    notificationCountElement.parentElement.classList.add('hidden');
                    notificationCountElement.parentElement.classList.remove('flex');
                }
            } else {
                console.error('Error:', data.message);
            }

        }).catch(error => {
            console.error('Error:', error);
        });

});
