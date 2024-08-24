function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');

}

document.getElementById('sidebar-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
});


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
