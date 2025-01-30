<?php 

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class UploadServices {
    private $s3Client;
    private $bucketName;

    public function __construct() {
        $this->s3Client = new S3Client([
            'version' => 'latest',
            'profile' => 'b2',
            'region'  => 'eu-central-003', 
            'endpoint' => 's3.eu-central-003.backblazeb2.com',
            'credentials' => [
                'key'    => 'your-access-key-id',
                'secret' => 'your-secret-access-key',
            ],
        ]);
        $this->bucketName = 'your-bucket-name';
    }

    public function uploadImage($filePath, $fileName) {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'images/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            // Output error message if fails
            return 'Error: ' . $e->getMessage();
        }
    }

    public function uploadVideo($filePath, $fileName) {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'videos/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            // Output error message if fails
            return 'Error: ' . $e->getMessage();
        }
    }
}
