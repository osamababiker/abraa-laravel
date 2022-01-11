<?php 

namespace App\Http\Traits;

trait FilesUploadTrait {

    
    public static function move($localFile, $remoteFile, $path = 'files')
    {
        
        $ftp = self::loadBalance();
        
        $conn_id = ftp_connect($ftp['host']);

        ftp_login($conn_id, $ftp['user'], $ftp['pass']); 

        ftp_set_option($conn_id, FTP_USEPASVADDRESS, false);

        ftp_pasv($conn_id, true);


        $temp = explode('/', $path);
        $ftpPath = '';
        for ($i = 0; $i < count($temp); $i++) {
            $ftpPath .= '/' . $temp[$i];
            if (!@ftp_chdir($conn_id, $ftpPath)) {
                ftp_mkdir($conn_id, $ftpPath);
                ftp_chdir($conn_id, $ftpPath);
            }
        }
        
        if (ftp_put($conn_id, $remoteFile, $localFile, FTP_BINARY)) {
            @unlink($path . '/' . $remoteFile);
            return 'https://' . $ftp['domain'] . '/' . $path . '/' . $remoteFile;
        } else {
            return false;
        }
    }

    public static function moveS3($localFile, $remoteFile, $path = 'files'){
        define('S3_REGION', 'me-south-1');
        define('S3_BUCKET_NAME', 's101.abraacdn.com');
        define('S3_ACCESS_KEY_ID', 'AKIAS7RZG4VJYKBTESXB');
        define('S3_SECRET_ACCESS_KEY', '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');
        require_once(APPPATH.'third_party/aws/aws-autoloader.php');
        
        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => S3_REGION,
            'credentials' => [
                'key'    => S3_ACCESS_KEY_ID,
                'secret' => S3_SECRET_ACCESS_KEY
            ]
        ]);
        
        try {
            $result = $s3->putObject([
                'Bucket' => S3_BUCKET_NAME,
                'Key' => $path . '/' . $remoteFile,
                'Body' => fopen($localFile, 'r+'),
                'ACL' => 'public-read'
            ]);
            @unlink($localFile);
            //print_r($result);
            return $result['ObjectURL'];
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo __('Something went worng');
            // if (Core::$debug) {
                 dd($e->getMessage());
            // }
        }
    }


    public static function loadBalance()
    {
        //global $configs;
        $cdn = [
            '1' => [
                'domain' => 's101.abraacdn.com',
                'host' => '15.185.164.234',
                'user' => 'cdn@s101.abraacdn.com',
                'pass' => 'rnyR5e4n6bivj3',
            ]
        ];
        
        $cdn_number = mt_rand(1, count($cdn));


        return $cdn[$cdn_number];
    }


    public function upload_image($new_name, $temp_file, $folder){

        $part = explode(".", $new_name);
        $ext = strtolower(end($part));
        $target_file = '';
        if (!in_array($ext, array('exe', 'php', 'js', 'css', 'html', 'htm', 'dhtml', 'dll', 'patch', 'batch', 'bat', 'dat', 'xhtml', 'xml', 'dmg', 'dhtml', 'sh', 'shell', 'bin', 'com', 'elf', 'h', 'c', 'php5', 'php4', 'rb', 'so', 'o', 'dhtml', 'py', 'pyc', 'pyo', 'pyd', 'cx', 'asp', 'aspx', 'cs'))) {
            $pic_name = time() . rand(10000, 99999) . "." . $ext;

            $target_file = $this->move($temp_file, $pic_name, $folder);
        }
        if ($target_file) {
            return $target_file;
        } else {
            return 0; 
        }
    }

}

?>