<?php

class Utils {

    public static function getArrayByLink($link) {
        $data = file_get_contents($link);
        $data = json_decode($data, true);

        if(json_last_error()) {
            throw new Exception('Error by parsing data by URL = ' . URL);
        }
        return $data;
    }

    public static function createFolder($path) {
        if(!file_exists($path)) {
            if(!mkdir($path)) {
                throw new Exception('Could create folder ' . $path);
            }
        }
    }

    public static function info($messsage) {
        echo "$messsage\n";
    }
}