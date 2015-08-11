<?php

namespace Aurora\MVC;

class View
{
    protected $data = [];
    protected $template = "master";
    protected $extension;
    
    private $Engine;

    public function __construct($Engine)
    {
        $this->Engine = $Engine;
    }

    public function __get($key)
	{
		return $this->data[$key];
	}

	public function __set($key, $value)
	{
        $this->data[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->data[$key]);
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate($extension = null)
    {
        return $this->template.$extension;
    }

    public function render($template = null, $data = [])
    {
        if ($template !== null) {
            $this->template = $template;
        }

        $template = $this->getTemplate($this->extension);
        $this->data = ($data + $this->data);

        return $this->Engine->render($template, $this->data);
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getExtension($extension)
    {
        return $this->extension;
    }

    public function setEngine($Engine)
    {
        $this->Engine = $Engine;
    }
}
