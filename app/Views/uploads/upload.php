<div class="container-main print-container max-w-6xl overflow-auto">

    <div class="flex flex-row md:mt-0">
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="main-title-page">Upload Files</h2>
    </div>


    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">

        <h3 class="secondary-title text-gray-500 text-center">Uploads images, videos and documents</h3>

        <input hidden type="text" name="property_id" value="<?= $property_id; ?>" />

        <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true"
            data-max-files="10" accept="image/*, video/*, .pdf, .doc, .docx, .txt, xlsx" />
    </div>

    <!-- Existing Uploads Section -->
    <?php if (!empty($propertyUploads)): ?>
    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">
        <h3 class="secondary-title text-gray-500 text-center mb-6">Existing Files</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($propertyUploads as $upload): ?>
                <div id="upload-card-<?= $upload->id ?>" class="border rounded-lg p-4 relative file-card">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <?php 
                            $icon = 'document-text';
                            if ($upload->upload_file_type === 'image') {
                                $icon = 'photograph';
                            } elseif ($upload->upload_file_type === 'video') {
                                $icon = 'film';
                            }
                            ?>
                            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => $icon, 'class' => 'size-8']) ?>
                        </div>
                        
                    </div>
                    <div class="mt-2">
                        <h4 class="font-semibold text-sm truncate" title="<?= $upload->upload_file_name ?>">
                            <?= $upload->upload_file_name ?>
                        </h4>
                        <p class="text-xs text-gray-500">
                            <?= strtoupper($upload->upload_file_type) ?> • 
                            <?= round($upload->upload_file_size / 1024) ?> KB • 
                            <?= date('M d, Y', strtotime($upload->upload_created_at)) ?>
                        </p>
                    </div>
                    <?php if ($upload->upload_file_type === 'image'): ?>
                    <div class="mt-2">
                        <img src="<?= $upload->upload_storage_url ?>" alt="Preview" class="w-full h-32 object-cover rounded">
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputElement = document.querySelector('input[type="file"]');
        const propertyId = document.querySelector('input[name="property_id"]').value;

        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');

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
                    ondata: (formData) => {
                        formData.append('property_id', propertyId);
                        return formData;
                    },
                    onload: (response) => {
                        const jsonResponse = JSON.parse(response);
                        onSuccess('File uploaded successfully');
                        return jsonResponse.url;
                    },
                    onerror: (response) => {
                        const jsonResponse = JSON.parse(response);
                        onError(jsonResponse.error);
                        return jsonResponse.error;
                    },
                    ondataerror: (response) => {
                        const jsonResponse = JSON.parse(response);
                        onError(jsonResponse.error);
                        return jsonResponse.error;
                    }
                }
            }
        });

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
    });

    function deleteFile(uploadId) {
        if (confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
            fetch('/listings/delete-file', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `upload_id=${uploadId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Success - remove the file card from the UI
                    const fileCard = document.getElementById(`upload-card-${uploadId}`);
                    if (fileCard) {
                        fileCard.remove();
                    }
                    
                    const successDiv = document.getElementById('success-div');
                    successDiv.innerHTML = `<p class="text-center w-full"> ${data.message} </p> `;
                    successDiv.classList.remove('hidden');
                    successDiv.classList.add('flex');
                } else if (data.error) {
                    // Error
                    const errorDiv = document.getElementById('error-div');
                    errorDiv.innerHTML = `<p class="text-center w-full"> ${data.error} </p> `;
                    errorDiv.classList.remove('hidden');
                    errorDiv.classList.add('flex');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const errorDiv = document.getElementById('error-div');
                errorDiv.innerHTML = `<p class="text-center w-full"> An error occurred while deleting the file </p> `;
                errorDiv.classList.remove('hidden');
                errorDiv.classList.add('flex');
            });
        }
    }
</script>

<style>
    .file-card {
        transition: all 0.3s ease;
    }
    .file-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transform: translateY(-2px);
    }
</style>