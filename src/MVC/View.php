<?php

namespace Aurora\MVC;

use Aurora\Helper\Object;

class View extends Object
{
    protected $data = [];
    public $template = "master";
    public $extension;

    private $Engine;

    public function __construct($Engine, $extension = null)
    {
        $this->Engine = $Engine;
        $this->extension = $extension;
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
