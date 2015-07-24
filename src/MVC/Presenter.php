<?php

namespace Aurora\MVC;

use Aurora\Http\Response;
use Aurora\Http\Request;
use Aurora\Http\CookieInterface;

use Aurora\ServiceLocator;
use Aurora\Model;

use Aurora\Exception\MissingDependencyException;

abstract class Presenter
{
   protected $Model;
   protected $Service;
   protected $Response;
   protected $Request;
   protected $View;

   public $Cookie;

   public $ApplicationConfig;
   public $Param;

   public function __construct(
      Response $Response,
      Request $Request,
      View $View,
      ServiceLocator $Container,
      Model $Model
   ) {
      $this->Response = $Response;
      $this->Request = $Request;
      $this->View = $View;
      $this->Container = $Container;
      $this->Model = $Model;
   }

   public function createCookie($name = "", $value = null, $expire = false, $path = false, $secure = null, $httpOnly = null)
   {
      if (!isset($this->Cookie)) {
         throw new MissingDependencyException("Error Processing Request", 1);
      }

      $Cookie = clone $this->Cookie;
      $Cookie->name = $name;
      $Cookie->setValue($value);

      if (!$expire) {
         $Cookie->maxAge = $expire;
      }
      if (!$path) {
         $Cookie->path = $path;
      }
      if ($secure !== null) {
         $Cookie->secure = (bool) $secure;
      }
      if ($httpOnly !== null) {
         $Cookie->httpOnly = (bool) $httpOnly;
      }

      $this->Response->addCookie($Cookie);
   }

   public function createModel($model, $name)
   {
      return $this->Model->create($model, $name);
   }

   public function setCookie(CookieInterface $Cookie)
   {
      $this->Cookie = $Cookie;
   }
}
