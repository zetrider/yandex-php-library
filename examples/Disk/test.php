<?php
/**
 * User: naxel
 * Date: 29.10.13 18:19
 */
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use Yandex\Disk\DiskClient;
$disk = new DiskClient();
$disk->setAccessToken('ca8bd493ee5d4a9e96b95e1e8e08c5ce');
$disk->uploadFile('/', array('path' => 'CHANGELOG.md', 'size' => filesize('CHANGELOG.md'), 'name' => 'test2.txt'));