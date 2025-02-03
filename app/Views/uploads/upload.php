<div class="container-main">
    <div class="main-title-page">Upload Files</div>
    <div id="drop-zone" class="drop-zone">
        <p class="main-label">Drag & Drop files here or click to upload</p>
        <input type="file" id="file-input" class="hidden" multiple>
    </div>
    <div id="file-list" class="mt-4"></div>
    <div id="progress-container" class="progress-container hidden">
        <progress id="progress-bar" value="0" max="100" class="w-full"></progress>
        <button id="cancel-upload" class="secondary-btn mt-2">Cancel Upload</button>
    </div>
</div>

<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');
    const progressContainer = document.getElementById('progress-container');
    const progressBar = document.getElementById('progress-bar');
    const cancelUploadButton = document.getElementById('cancel-upload');

    let currentXHR = null;

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

    cancelUploadButton.addEventListener('click', () => {
        if (currentXHR) {
            currentXHR.abort();
            progressContainer.classList.add('hidden');
            alert('Upload canceled');
        }
    });

    window.addEventListener('beforeunload', (e) => {
        if (currentXHR) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    function handleFiles(files) {
        fileList.innerHTML = '';
        for (const file of files) {
            const listItem = document.createElement('div');
            listItem.className = 'main-input';
            listItem.textContent = file.name;

            const progressWrapper = document.createElement('div');
            progressWrapper.className = 'progress-wrapper';

            const fileProgressBar = document.createElement('div');
            fileProgressBar.className = 'file-progress-bar';

            const progressText = document.createElement('div');
            progressText.className = 'progress-text';
            progressText.textContent = '0%';

            progressWrapper.appendChild(fileProgressBar);
            progressWrapper.appendChild(progressText);
            listItem.appendChild(progressWrapper);

            fileList.appendChild(listItem);
            uploadFile(file, fileProgressBar, progressText);
        }
    }

    function uploadFile(file, fileProgressBar, progressText) {
        const formData = new FormData();
        let fileType = 'video';

        if (file.type.startsWith('image/')) {
            fileType = 'image';
        } else if (file.type === 'application/pdf' ||
            file.type === 'application/msword' ||
            file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
            file.type === 'application/vnd.ms-powerpoint' ||
            file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
            fileType = 'document';
        }

        formData.append(fileType, file);
        formData.append('upload_file_type', fileType);
        formData.append('property_id', '1');

        progressContainer.classList.remove('hidden');
        progressBar.value = 0;

        currentXHR = new XMLHttpRequest();
        currentXHR.open('POST', 'uploads', true);

        // Make sure we're handling progress correctly
        currentXHR.upload.onprogress = (event) => {
            if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                console.log(`Upload progress: ${percentComplete}%`);
                fileProgressBar.style.width = percentComplete + '%';
                progressText.textContent = Math.round(percentComplete) + '%';
                progressBar.value = percentComplete;
            }

            
        };

      
        currentXHR.onreadystatechange = function() {
            if (currentXHR.readyState === 4) { // Request completed
                if (currentXHR.status === 201) {
                    try {
                        const response = JSON.parse(currentXHR.responseText);
                        //Response.url
                        document.getElementById('file-list').innerHTML = `<a href="${response.url}" target="_blank">${file.name}</a>`;
                    } catch (error) {
                        console.error('Invalid JSON response:', currentXHR.responseText);
                        alert('Unexpected server response.');
                    }
                } else {
                    alert('Upload failed');
                }
                progressContainer.classList.add('hidden');
                currentXHR = null;
            }
        };

        currentXHR.onerror = (error) => {
            console.error(error);
            alert('Upload failed');
            progressContainer.classList.add('hidden');
            currentXHR = null;
        };

        currentXHR.send(formData);
    }
</script>