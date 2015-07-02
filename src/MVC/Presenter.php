<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 * PHP version 6
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.2
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora\MVC;

/**
 * Presenter
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    1.0
 */

use Aurora\Http\Response;
use Aurora\Http\Request;
use Aurora\Service;
use Aurora\Service\Model;

abstract class Presenter
{

  protected $Model;
  protected $Response;
  protected $Request;
  protected $View;
  protected $Service;

  public function __construct(
     Response $Response,
     Request $Request,
     View $View,
     Service $Service,
     Model $Model
  ) {
     $this->Response = $Response;
     $this->Request = $Request;
     $this->View = $View;
     $this->Service = $Service;
     $this->Model = $Model;
  }
}
