<?php

class Model_Core_Session
{
    public function __construct()
    {
        $this->start();
    }

    public function start()
    {
        if ($this->getId()) {
            return $this;
        }
        session_start();
        return $this;
    }

    public function getId()
    {
        return session_id();
    }

    public function destroy()
    {
        session_destroy();
        return $this;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function unset($key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
        return $this;
    }

    public function has($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return true;
        }
        return false;
    }


}

?>