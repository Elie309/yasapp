<div class="container-main">
    <div class="main-title-page">Upload Files</div>
    
    <input type="file" class="filepond" multiple data-allow-reorder="true" data-max-file-size="10MB"
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
            maxFileSize: '10MB',
            acceptedFileTypes: ['image/*', 'video/*', 'application/pdf', 'application/msword', 'text/plain']
        });
    });
</script>