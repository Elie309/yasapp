<div class="flex justify-end space-x-4 my-4">
    <button id="downloadCurrent"
        class=" <?= empty($uploads) ? 'secondary-btn-disabled' : 'secondary-btn' ?> flex flex-row items-center space-x-2 text-sm"
        <?= empty($uploads) ? 'disabled' : '' ?>>
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "download", "class" => "size-6"]) ?>
        <span>Download</span>
    </button>
    <!-- <button id="downloadAll" class="<?= empty($uploads) ? 'primary-btn-disabled' : 'primary-btn' ?> flex flex-row items-center text-sm"
        <?= empty($uploads) ? 'disabled' : '' ?>>
        Download All Files
    </button> -->

    <a href="uploads" class="secondary-btn text-sm stroke-gray-900 hover:stroke-white flex flex-row items-center space-x-2">
        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "upload", "class" => "size-6"]) ?>
        <span>Upload Files</span>
    </a>
</div>
<?php if (!empty($uploads)): ?>

    <div class="carousel-container">
        <div class="carousel-wrapper">
            <div class="carousel">
                <?php foreach ($uploads as $index => $upload): ?>
                    <?php if ($upload['upload_file_type'] === 'video'): ?>
                        <div class="carousel-item w-full">
                            <video class="main-media" controls>
                                <source src="<?= $upload['upload_storage_url'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php elseif ($upload['upload_file_type'] === 'image'): ?>
                        <div class="carousel-item">
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
            const activeItem = document.querySelector('#propertyImages .carousel-item.active');
            const uploadId = activeItem.dataset.uploadId;
            downloadFile(`/listings/download/${uploadId}`);
        });

        // // Download all files
        // document.getElementById('downloadAll').addEventListener('click', function() {
        //     const propertyId = document.querySelector('input[name="property_id"]').value;
        //     downloadFile(`/listings/download-all/${propertyId}`);
        // });
    </script>
<?php endif; ?>