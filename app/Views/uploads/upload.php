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


        <input hidden type="text" name="property_id" value="<?= $property_id; ?>" />

        <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true"
            data-max-files="10" accept="image/*, video/*, .pdf, .doc, .docx, .txt, xlsx" />
    </div>
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
</script>