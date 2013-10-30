<?php
//Remove reposes
exec("find . | grep .git | xargs rm -rf");

$fileName = 'yandex-sdk.phar';

//Create PHAR
$phar = new Phar($fileName, 0, $fileName);
//Add files to Phar
$phar->buildFromDirectory(dirname(__FILE__), '/vendor/');
$phar->buildFromDirectory(dirname(__FILE__), '/src/');
$phar->addFile('CHANGELOG.md');
$phar->addFile('LICENSE');
$phar->addFile('README.md');

require_once dirname(__FILE__) . '/vendor/autoload.php';
use Yandex\Disk\DiskClient;

$disk = new DiskClient();
$disk->setAccessToken(getenv('ACCESS_TOKEN'));

//Send to Yandex.DisK
$disk->uploadFile('/', array('path' => $fileName, 'size' => filesize($fileName), 'name' => $fileName));

//Compressing
if (Phar::canCompress(Phar::BZ2)) {
    $phar->compress(Phar::BZ2, '.phar.bz2');
    $fileName .= '.bz2';
    //Send to Yandex.DisK
    $disk->uploadFile('/', array('path' => $fileName, 'size' => filesize($fileName), 'name' => $fileName));
}

