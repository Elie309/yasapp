<div class="container-main">

    <h2 class="main-title-page">Files</h2>

    <div class="flex justify-center space-x-4 my-4">
        <button id="downloadCurrent" class="secondary-btn text-sm">Download Current File</button>
        <button id="downloadAll" class="main-btn text-sm">Download All Files</button>
    </div>

    <div id="propertyImages" class="carousel slide w-full max-w-4xl h-[600px] mx-auto" data-ride="carousel">
        <ol class="carousel-indicators relative translate-y-10">
            <?php foreach ($propertyUploads as $index => $upload): ?>
                <?php if ($upload['upload_file_type'] === 'image' || $upload['upload_file_type'] === 'video'): ?>
                    <li data-target="#propertyImages" data-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" style="background-color: #000;"></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner w-full h-full">
            <?php foreach ($propertyUploads as $index => $upload): ?>
                <?php if ($upload['upload_file_type'] === 'image'): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?> w-full h-full" data-upload-id="<?= $upload['upload_id']; ?>">
                        <img class="d-block h-full mx-auto" src="<?= $upload['upload_storage_url']; ?>" alt="<?= $upload['upload_file_name']; ?>">
                    </div>
                <?php elseif ($upload['upload_file_type'] === 'video'): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?> w-full h-full" data-upload-id="<?= $upload['upload_id']; ?>">
                        <video class="d-block h-full mx-auto" controls>
                            <source src="<?= $upload['upload_storage_url']; ?>" type="<?= $upload['upload_mime_type']; ?>">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#propertyImages" role="button" data-slide="prev">
            <span class=" bg-gray-800 p-2 rounded-full " aria-hidden="true">
                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'carouselLeft', 
                'class' => 'size-6 fill-white']) ?>

            </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#propertyImages" role="button" data-slide="next">
            <span class="bg-gray-800 p-2 rounded-full" aria-hidden="true">
                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'carouselRight', 
                'class' => 'size-6 fill-white']) ?>
            </span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="mt-4">
        <h3 class="main-title-page">Documents</h3>
        <ul>
            <?php foreach ($propertyUploads as $upload): ?>
                <?php if ($upload['upload_file_type'] === 'document'): ?>
                    <li>
                        <a href="<?= $upload['upload_storage_url']; ?>" target="_blank"><?= $upload['upload_file_name']; ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="">
        <div class="main-title-page">Upload Files</div>

        <input hidden type="text" name="property_id" value="<?= $property_id; ?>" />

        <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true"
            data-max-files="10" accept="image/*, video/*, .pdf, .doc, .docx, .txt" />
    </div>

    <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50">
        <div class="loader-red"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputElement = document.querySelector('input[type="file"]');
        const propertyId = document.querySelector('input[name="property_id"]').value;

        FilePond.registerPlugin(
            FilePondPluginImageEdit,
            FilePondPluginImagePreview
        );

        // Create a FilePond instance
        FilePond.create(inputElement, {
            allowMultiple: true,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['image/*', 'video/*', 'application/pdf', 'application/msword', 'text/plain'],
            server: {
                process: {
                    url: '/listings/uploads',
                    method: 'POST',
                    withCredentials: false,
                    headers: {},
                    timeout: 7000,
                    ondata: (formData) => {
                        formData.append('property_id', propertyId);
                        return formData;
                    },
                    onload: (response) => {
                        const jsonResponse = JSON.parse(response);
                        return jsonResponse.url;
                    },
                    onerror: (response) => {
                        const jsonResponse = JSON.parse(response);
                        return jsonResponse.error;
                    }
                }
            }
        });

        // Stop video playback when moving the carousel
        $('#propertyImages').on('slide.bs.carousel', function() {
            const videos = document.querySelectorAll('#propertyImages video');
            videos.forEach(video => {
                video.pause();
            });
        });

        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('loading').classList.remove('flex');
        }

        async function downloadFile(url) {
            showLoading();
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                if (response.ok) {
                    const blob = await response.blob();
                    const contentDisposition = response.headers.get('Content-Disposition');
                    let filename = 'downloaded_file';
                    if (contentDisposition && contentDisposition.indexOf('attachment') !== -1) {
                        const matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(contentDisposition);
                        if (matches != null && matches[1]) {
                            filename = matches[1].replace(/['"]/g, '');
                        }
                    }
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                } else {
                    alert('Failed to download file');
                }
            } catch (error) {
                console.error('Error downloading file:', error);
            } finally {
                hideLoading();
            }
        }

        // Download current file
        document.getElementById('downloadCurrent').addEventListener('click', function() {
            const activeItem = document.querySelector('#propertyImages .carousel-item.active');
            const uploadId = activeItem.dataset.uploadId;
            downloadFile(`/listings/download/${uploadId}`);
        });

        // Download all files
        document.getElementById('downloadAll').addEventListener('click', function() {
            const propertyId = document.querySelector('input[name="property_id"]').value;
            downloadFile(`/listings/download-all/${propertyId}`);
        });
    });
</script>