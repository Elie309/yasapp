<div class="container-main">
    <div class="main-title-page">Upload Files</div>
    <div id="drop-zone" class="drop-zone">
        <p class="main-label">Drag & Drop files here or click to upload</p>
        <input type="file" id="file-input" class="hidden" multiple>
    </div>
    <div id="file-list" class="mt-4"></div>
</div>

<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    function handleFiles(files) {
        fileList.innerHTML = '';
        for (const file of files) {
            const listItem = document.createElement('div');
            listItem.className = 'main-input';
            listItem.textContent = file.name;
            fileList.appendChild(listItem);
            uploadFile(file);
        }
    }

    function uploadFile(file) {
        const formData = new FormData();
        formData.append(file.type.startsWith('image/') ? 'image' : 'video', file);

        fetch(`uploads/upload-${file.type.startsWith('image/') ? 'image' : 'video'}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(() => alert('Upload failed'));
    }
</script>