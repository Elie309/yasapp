# PHP Configuration Instructions

To enable the upload progress bar, you need to have the `session.upload_progress` enabled in your `php.ini` file.

## Steps

1. Open your `php.ini` file.
2. Check for the following line:
   ```ini
   session.upload_progress.enabled = On
   ```
3. If the line is not present or is set to `Off`, add or update it to:
   ```ini
   session.upload_progress.enabled = On
   ```

Save the file and restart your web server to apply the changes.