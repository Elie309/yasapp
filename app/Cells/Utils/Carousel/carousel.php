<div class="flex justify-end space-x-4 my-4">

    <?php if ($uploadOwner): ?>
        <!-- Upload Files -->
        <a href="upload" class="secondary-btn text-sm stroke-gray-800 hover:stroke-white flex flex-row items-center space-x-2">
            <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "upload", "class" => "size-6"]) ?>
            <span>Upload Files</span>
        </a>
    <?php endif; ?>

    <!-- Settings Popover -->
    <div class="relative">
        <button id="settingsBtn"
            popovertarget="settingsPopover"
            <?= empty($uploads) ? 'disabled' : '' ?>
            class="text-sm stroke-gray-800 hover:stroke-white hover:disabled:stroke-gray-800 flex flex-row items-center space-x-2 <?= empty($uploads) ? 'secondary-btn-disabled' : 'secondary-btn' ?>  ">
            <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "settings", "class" => "size-6"]) ?>
            <span>Settings</span>
        </button>

        <div id="settingsPopover"
            class="absolute hidden mt-2 right-0 w-48 bg-white shadow-2xl p-0 rounded-md z-10">
            <ul class="">
                <li>
                    <button id="downloadCurrent" <?= empty($uploads) ? 'disabled' : '' ?>
                        class="w-full text-left text-sm stroke-gray-800 hover:stroke-white hover:bg-gray-800
                        flex flex-row px-2 py-4 items-center space-x-2 hover:text-white
                        <?= empty($uploads) ? '' : '' ?> ">
                        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "download", "class" => "size-6"]) ?>
                        <span>Download</span>
                    </button>
                </li>
                <li>
                    <button id="downloadAll" <?= empty($uploads) ? 'disabled' : '' ?>
                        class="w-full text-left text-sm stroke-gray-800 hover:stroke-white hover:bg-gray-800
                        flex flex-row px-2 py-4 items-center space-x-2 hover:text-white
                        <?= empty($uploads) ? '' : '' ?> ">
                        <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "download-all", "class" => "size-6"]) ?>
                        <span>Download All</span>
                    </button>
                </li>
                <?php if ($uploadOwner): ?>
                    <li>
                        <button <?= empty($uploads) ? 'disabled' : '' ?>
                            class="w-full text-left text-sm stroke-red-800 hover:stroke-white hover:bg-red-800
                        flex flex-row px-2 py-4 items-center space-x-2 text-red-800 hover:text-white
                        <?= empty($uploads) ? '' : '' ?> "
                            popovertarget="deleteCarousel-popover">
                            <?= view_cell('\App\Cells\Utils\Icons\IconsCell::render', ['icon' => "trash", "class" => "size-6"]) ?>
                            <span>Delete</span>
                        </button>
                    </li>
                <?php endif; ?>
            </ul>
        </div>


    </div>

</div>

<?php if (!empty($uploads)): ?>
    <div class="carousel-container">
        <div class="carousel-wrapper">
            <div class="carousel mx-auto">
                <?php foreach ($uploads as $index => $upload): ?>
                    <?php if ($upload->upload_file_type === 'video'): ?>
                        <div class="carousel-item w-full <?= $index === 0 ? 'active' : '' ?>" data-upload-id="<?= $upload->upload_id ?>">
                            <video class="main-media mx-auto" controls>
                                <source src="<?= $upload->upload_storage_url ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php elseif ($upload->upload_file_type === 'image'): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-upload-id="<?= $upload->upload_id ?>">
                            <img src="<?= $upload->upload_storage_url ?>" alt="Main Media" class="main-media">
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

    <div popover id="deleteCarousel-popover" class="popover px-8 max-w-md">
        <div class="flex flex-col w-full justify-center">
            <h3 class="secondary-title text-lg md:text-2xl text-center">Are you sure you want to delete this property?</h3>
            <div class="grid grid-cols-2 gap-4 w-full my-4">
                <div class=" w-full">
                    <button type="button" class="primary-btn w-full cursor-pointer" onclick="closePopover('deleteCarousel-popover')">Cancel</button>
                </div>
                <div class="w-full">
                    <button id="deleteCurrent" type="button"
                        class="secondary-btn w-full cursor-pointer text-center">
                        Confirm
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');
        document.addEventListener('DOMContentLoaded', function() {
            const carouselWrapper = document.querySelector('.carousel-wrapper');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const settingsBtn = document.getElementById('settingsBtn');
            const settingsPopover = document.getElementById('settingsPopover');



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

            settingsBtn.addEventListener('click', function() {
                settingsPopover.classList.toggle('hidden');
            });

            //on click outside
            window.addEventListener('click', function(event) {
                if (!settingsBtn.contains(event.target) && !settingsPopover.contains(event.target)) {
                    settingsPopover.classList.add('hidden');
                }
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
                    const data = await response.json();
                    onError(data.errors);
                }
            } catch (error) {
                onError('An error occurred while downloading the file');
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

        <?php if ($uploadOwner): ?>
            // Delete current file
            document.getElementById('deleteCurrent').addEventListener('click', function() {
                const activeItem = document.querySelector('.carousel-item.active');
                const uploadId = activeItem.dataset.uploadId;
                closePopover('deleteCarousel-popover');

                showLoading();
                fetch(`/listings/delete-upload/${uploadId}`, {
                        method: 'delete',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        onError('An error occurred while deleting the file');
                        console.error('Error deleting file:', error);
                    })
                    .finally(() => {
                        hideLoading();
                    });
            });

        <?php endif; ?>

        function onSuccess(message) {
            successDiv.innerHTML = `<p class="text-center w-full"> ${message} </p> `;
            successDiv.classList.remove('hidden');
            successDiv.classList.add('flex');
        }

        function onError(message) {
            errorDiv.innerHTML = `<p class="text-center w-full">  ${message} </p> `;
            errorDiv.classList.remove('hidden');
            errorDiv.classList.add('flex');
        }
    </script>
<?php endif; ?>