<?php
/**
 * Created by PhpStorm.
 * User: alm
 * Date: 28/05/2018
 * Time: 13:46
 */

set_time_limit(0);

define('URL', 'https://images-assets.nasa.gov/recent.json');
define('STORAGE', '/tmp/nasa');
define('META_STORAGE', STORAGE . DIRECTORY_SEPARATOR . 'meta');
define('IMAGES_STORAGE', STORAGE . DIRECTORY_SEPARATOR . 'images');

require_once 'meta.php';
require_once 'images.php';
require_once 'utils.php';

Utils::createFolder(STORAGE);
Utils::createFolder(META_STORAGE);
Utils::createFolder(IMAGES_STORAGE);


$data = Utils::getArrayByLink(URL);
if(empty($data['collection']['items'])) {
    throw new Exception('Image information doesn\'t exists' . URL);
}

$items = $data['collection']['items'];

foreach($items as $item) {
    if(!empty($item['data'][0])) {
        $filename = Meta::init($item['data'][0])->store(META_STORAGE);
        Utils::info("File $filename was succesfuly stored");
    }

    if(!empty($item['href'])) {
        $filename = Images::init($item['href'])->store(IMAGES_STORAGE, 'medium');
        Utils::info("File $filename was succesfuly stored");
    }

}