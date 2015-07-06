<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora\MVC;

/**
 * Controller
 *
 * Part of MVC
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */

use Aurora\Http\Response;
use Aurora\Http\Request;
use Aurora\Service;
use Aurora\Service\Model;

/**
 * Controller
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */
abstract class Controller
{

  protected $Model;
  protected $Service;
  protected $Response;
  protected $Request;
  protected $View;
  /**
  * Contains Configuration for Aurora
  * @var \Aurora\Config Config
  */
  public $ApplicationConfig;

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
