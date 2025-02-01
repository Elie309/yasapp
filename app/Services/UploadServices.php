<?php 
namespace App\Services;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class UploadServices {
    private $s3Client;
    private $bucketName;

    public function __construct() {
        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region'  => getenv('aws.region'), 
            'endpoint' => getenv('aws.endpoint'),
            'credentials' => [
                'key'    => getenv('aws.accessKeyId'),
                'secret' => getenv('aws.secretAccessKey'),
            ],
            'rejectUnauthorized' => false,
        ]);
        $this->bucketName = getenv('aws.bucketName');
    }

    public function uploadImage($filePath, $fileName) {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'images/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            log_message('info', 'Image uploaded to S3: ' . json_encode($result['ObjectURL']));
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            // Output error message if fails
            log_message('error', 'Error uploading image to S3: ' . $e->getMessage());
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
