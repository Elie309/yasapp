<div class="container-main">
    <div class="main-title-page">Upload Files</div>
    
    <input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true"
        data-max-files="10" accept="image/*, video/*, .pdf, .doc, .docx, .txt" />
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputElement = document.querySelector('input[type="file"]');

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
                    url: '/uploads',
                    method: 'POST',
                    withCredentials: false,
                    headers: {},
                    timeout: 7000,
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
    });
</script>