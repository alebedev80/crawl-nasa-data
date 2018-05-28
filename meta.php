<?php

class Meta {

    private $nasa_id;
    private $keywords;
    private $center;
    private $date_created;
    private $description;
    private $location;
    private $media_type;
    private $photographer;
    private $title;

    public static function init($data)
    {

        $meta = new self();

        if(isset($data['nasa_id'])) {
            $meta->setNasaID($data['nasa_id']);
        }

        if(isset($data['keywords'])) {
            $meta->setKeywords($data['keywords']);
        }

        if(isset($data['center'])) {
            $meta->setCenter($data['center']);
        }

        if(isset($data['date_created'])) {
            $meta->setDataCreated($data['date_created']);
        }

        if(isset($data['description'])) {
            $meta->setDescription($data['description']);
        }

        if(isset($data['location'])) {
            $meta->setLocation($data['location']);
        }

        if(isset($data['media_type'])) {
            $meta->setMediaType($data['media_type']);
        }

        if(isset($data['photographer'])) {
            $meta->setPhotographer($data['photographer']);
        }

        if(isset($data['title'])) {
            $meta->setPhotographer($data['title']);
        }

        return $meta;

    }

    private function getFilename($path) {
        return $path . DIRECTORY_SEPARATOR . $this->nasa_id . '.txt';
    }

    public function store($path) {

        $filename = $this->getFilename($path);
        if(file_exists($filename)) {
            unlink($filename);
        }

        if(!file_put_contents($filename, (string)$this)) {
            throw new Exception("Couldn't store file $filename");
        }

        return $filename;
    }

    public function setNasaID($value)
    {
        $this->nasa_id = $value;
    }

    public function setKeywords($value)
    {
        $this->keywords = is_array($value) ? implode(', ', $value) : $value;
    }

    public function setCenter($value)
    {
        $this->center = $value;
    }

    public function setDataCreated($value)
    {
        $this->date_created = $value;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function setLocation($value)
    {
        $this->location = $value;
    }

    public function setMediaType($value)
    {
        $this->media_type = $value;
    }

    public function setPhotographer($value)
    {
        $this->photographer = $value;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function __toString()
    {
        $result = [];
        $result[] = "Nasa ID: {$this->nasa_id}";
        $result[] = "Keywords: {$this->keywords}";
        $result[] = "Center: {$this->center}";
        $result[] = "Data created: {$this->date_created}";
        $result[] = "Description: {$this->description}";
        $result[] = "Location: {$this->location}";
        $result[] = "Media type: {$this->media_type}";
        $result[] = "Photographer: {$this->photographer}";
        $result[] = "Title: {$this->title}";

        return implode("\n", $result);
    }



}