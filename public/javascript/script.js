document.getElementById('sidebar-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
});


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
    }else {
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