<?php

require_once 'utils.php';

class Images {

    private $list = [];
    private $link;

    public static function init($link) {
        $images = new self();
        $list = Utils::getArrayByLink($link);
        $images->setList($list);
        $images->setLink($link);
        return $images;
    }

    public function setList($value) {
        $this->list = $value;
    }

    public function setLink($value) {
        $this->link = $value;
    }

    protected function getIdByLink() {
        $result = explode('/', $this->link);
        return $result[count($result) - 2];
    }

    protected function getLinkBySize($size) {
        $result = array_filter($this->list, function($link) use ($size) {
            return strpos($link, $size) !== false;
        });

        return $result ? array_pop($result) : false;
    }

    public function store($path, $size) {

        $link = $this->getLinkBySize($size);

        if(!$link) {
            return;
        }

        $array = explode('.',  $link);
        $extension = array_pop($array);
        $filename = $path . DIRECTORY_SEPARATOR . $this->getIdByLink() . "." . $extension;
        if(file_put_contents($filename, fopen($link, 'r')) === false) {
            throw new Exception("Couldn't store file $filename");
        }

        return $filename;


    }



}