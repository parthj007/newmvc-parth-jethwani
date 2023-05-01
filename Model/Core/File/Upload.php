<?php
class Model_Core_File_Upload
{
    protected $file = null;
    protected $fileName = null;
    protected $path = 'var';
    protected $extensions = ['csv'];

    public function save($name)
    {

        if(!array_key_exists($name, $_FILES)){
            return false;
        }

        $this->file = $_FILES[$name];

        if(!$this->getFileName())
        {
            $this->setFileName($this->file['name']);
        }

        move_uploaded_file($this->file['tmp_name'], $this->getPath(). DS . $this->getFileName());

        return $this;

    }

    public function setPath($subPath)
    {
        if($subPath){
            $this->path = Ccc::getBaseDir(DS . $this->path. DS . $subPath);
        }
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setExtensions(array $extensions)
    {
        $this->extensions = $extensions;
        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }




}

?>