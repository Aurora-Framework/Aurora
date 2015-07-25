<?php

namespace Aurora\MVC;

use Aurora\Http\Response;
use Aurora\Http\Request;
use Aurora\Http\Cookie;
use Aurora\Session;

use Aurora\ServiceLocator;
use Aurora\Model;

use Aurora\Exception\MissingDependencyException;

abstract class Controller
{
   protected $Model;
   protected $Service;
   public $Response;
   protected $Request;
   protected $View;

   public $Cookie;
   public $Session;

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
         throw new MissingDependencyException("Missing Cookie Dependency");
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

   public function getCookie($key, $object = false)
   {
      if (!isset($this->Cookie)) {
         throw new MissingDependencyException("Missing Cookie Dependency");
      }

      $Cookie = clone $this->Cookie;
      $Cookie->name = $key;
      $Cookie->setValue($this->Request->getCookie($key));

      return ($object) ? $Cookie : $Cookie->getValue();
   }

   public function removeCookie($key)
   {
      $Cookie = clone $this->Cookie;
      $Cookie->name = $key;
      $Cookie->setValue($this->Request->getCookie($key));

      $this->Response->deleteCookie(
         $Cookie
      );
   }

   public function createModel($model, $name)
   {
      return $this->Model->create($model, $name);
   }

   public function setCookie(CookieInterface $Cookie)
   {
      $this->Cookie = $Cookie;
   }

   public function setSession(Session $Session)
   {
      $this->Session = $Session;
   }
}
