<?php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class UploadAWSClientServices
{
    private $s3Client;
    private $bucketName;

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region'  => getenv('aws.region'),
            'endpoint' => getenv('aws.endpoint'),
            'credentials' => [
                'key'    => getenv('aws.accessKeyId'),
                'secret' => getenv('aws.secretAccessKey'),
            ],
            'http' => [
                'verify' => getenv('aws.ssl.verify') === 'true'
            ]
        ]);

        // Remove unsupported headers using middleware
        $this->s3Client->getHandlerList()->appendBuild(function (callable $handler) {
            return function ($command, $request) use ($handler) {
                // Remove x-amz-checksum-crc32 from the request headers
                $request = $request->withoutHeader('x-amz-checksum-crc32');
                return $handler($command, $request);
            };
        });
        $this->bucketName = getenv('aws.bucketName');
    }

    public function uploadImage($filePath, $fileName)
    {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'images/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            return $result['ObjectURL'];

        } catch (AwsException $e) {
            throw new \Exception('AWS Error: ' . $e->getMessage());
        }
    }

    public function uploadVideo($filePath, $fileName)
    {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'videos/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            throw new \Exception('AWS Error: ' . $e->getMessage());
        }
    }

    public function uploadDocument($filePath, $fileName){
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => 'documents/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Adjust the ACL as needed
            ]);
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            throw new \Exception('AWS Error: ' . $e->getMessage());
        }
    }
    

    public function deleteFile($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        $key = ltrim($path, '/');
        log_message('info', 'Deleting file from AWS: ' . $key);
        try {
            $this->s3Client->deleteObject([
                'Bucket' => $this->bucketName,
                'Key'    => $key
            ]);
        } catch (AwsException $e) {
            log_message('error', 'AWS Error deleting file from AWS: ' . $e->getMessage());
            throw new \Exception('AWS Error: ' . $e->getMessage());
        }
    }

}
