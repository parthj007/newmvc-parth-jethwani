<?php
class Model_Core_Log
{
    const DIR_PATH = "var";
    protected $_handler = null;

    public function open($fileName)
    {
        $filePath = Ccc::getBaseDir(DS.self::DIR_PATH).DS.$fileName;
        $this->_handler = fopen($filePath, 'a');
    }

    public function close()
    {
        fclose($this->_handler);
    }

    public function write($data)
    {
        $data = print_r($data, true);
        fwrite($this->_handler, date("Y-m-d H:i:s")." : ".$data."\n\n");
    }

    public function log($data, $fileName = 'system.log', $newFile = false)
    {
        $this->open($fileName);
        $this->write($data);
        $this->close();
    }

}

