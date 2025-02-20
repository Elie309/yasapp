<div class="flex justify-end space-x-4 my-4">
    <!-- Download one file -->
    <button id="downloadCurrent"
        class=" <?= empty($uploads) ? 'secondary-btn-disabled' : 'secondary-btn' ?> flex flex-row items-center space-x-2 text-sm"
        <?= empty($uploads) ? 'disabled' : '' ?>>
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "download", "class" => "size-6"]) ?>
        <span>Download</span>
    </button>


    <!-- Download all files -->
    <button id="downloadAll"
        class="<?= empty($uploads) ? 'primary-btn-disabled' : 'primary-btn' ?> 
                flex flex-row items-center  text-sm stroke-red-800 
                hover:stroke-white space-x-2
                "
        <?= empty($uploads) ? 'disabled' : '' ?>>
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "download-all", "class" => "size-6"]) ?>
        Download All
    </button>

    <a href="uploads" class="secondary-btn text-sm stroke-gray-900 hover:stroke-white flex flex-row items-center space-x-2">
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "upload", "class" => "size-6"]) ?>
        <span>Upload Files</span>
    </a>

    <!-- Delete current file -->
    <button id="deleteCurrent" 
        class="<?= empty($uploads) ? 'primary-btn-disabled' : 'primary-btn' ?>
        flex flex-row items-center space-x-2 text-sm stroke-red-800 hover:stroke-white"
        <?= empty($uploads) ? 'disabled' : '' ?>>
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "trash", "class" => "size-6 "]) ?>
        <span>Delete</span>
</div>
<?php if (!empty($uploads)): ?>

    <div class="carousel-container">
        <div class="carousel-wrapper">
            <div class="carousel mx-auto">
                <?php foreach ($uploads as $index => $upload): ?>
                    <?php if ($upload['upload_file_type'] === 'video'): ?>
                        <div class="carousel-item w-full <?= $index === 0 ? 'active' : '' ?>" data-upload-id="<?= $upload['upload_id'] ?>">
                            <video class="main-media mx-auto" controls>
                                <source src="<?= $upload['upload_storage_url'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php elseif ($upload['upload_file_type'] === 'image'): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-upload-id="<?= $upload['upload_id'] ?>">
                            <img src="<?= $upload['upload_storage_url'] ?>" alt="Main Media" class="main-media">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="carousel-controls">
            <button id="prevBtn">
                <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'carouselLeft', 'class' => 'size-6 fill-white']) ?>
            </button>
            <button id="nextBtn">
                <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'carouselRight', 'class' => 'size-6 fill-white']) ?>
            </button>
        </div>
    </div>
<?php else : ?>
    <!-- TODO: Make it better -->
    <p class="text-center">No media available</p>
<?php endif; ?>


<?php if (!empty($uploads)): ?>
    <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50">
        <div class="loader-red"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselWrapper = document.querySelector('.carousel-wrapper');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let currentIndex = 0;

            function showMedia(index) {
                const offset = -index * 100;
                carouselWrapper.style.transform = `translateX(${offset}%)`;
                document.querySelector('.carousel-item.active').classList.remove('active');
                carouselItems[index].classList.add('active');
            }

            prevBtn.addEventListener('click', function() {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
                showMedia(currentIndex);
            });

            nextBtn.addEventListener('click', function() {
                currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
                showMedia(currentIndex);
            });

            // Preload media
            function preloadMedia() {
                carouselItems.forEach(item => {
                    const media = item.querySelector('.main-media');
                    if (media.tagName.toLowerCase() === 'video') {
                        media.load();
                    }
                });
            }

            preloadMedia();

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
            const activeItem = document.querySelector('.carousel-item.active');
            const uploadId = activeItem.dataset.uploadId;
            downloadFile(`/listings/download/${uploadId}`);
        });

        // Download all files
        document.getElementById('downloadAll').addEventListener('click', function() {
            const entity_id = "<?= $entity_id ?>";
            downloadFile(`/listings/download-all/${entity_id}`);
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') {
                document.getElementById('prevBtn').click();
            } else if (event.key === 'ArrowRight') {
                document.getElementById('nextBtn').click();
            }
        });

        // Delete current file
        document.getElementById('deleteCurrent').addEventListener('click', function() {
            const activeItem = document.querySelector('.carousel-item.active');
            const uploadId = activeItem.dataset.uploadId;
            if (confirm('Are you sure you want to delete this file?')) {
                showLoading();
                fetch(`/listings/delete-upload/${uploadId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to delete file');
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting file:', error);
                    })
                    .finally(() => {
                        hideLoading();
                    });
            }
        });

    </script>
<?php endif; ?>