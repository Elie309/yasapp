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

    // Prevent blur event when clicking inside the dropdown
    dropdown.addEventListener('mousedown', function (event) {
        event.preventDefault();
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

//Remove tempData if it exists
if (sessionStorage.getItem('tempTableData')) {
    sessionStorage.removeItem('tempTableData');
}


