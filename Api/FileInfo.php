<?php
namespace ETS\EchoSignBundle\Api;


class FileInfo implements ParameterInterface
{
    private $filename;
    private $file;

    public function __construct($filename, $file)
    {
        $this->filename = $filename;
        $this->file = $file;
    }

    public function build()
    {
        return array(
            'file' => file_get_contents($this->file),
            'fileName' => $this->filename
        );
    }

    public function isValid()
    {
        return $this->filename && $this->file;
    }
}