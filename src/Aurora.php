<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora;

/**
 * Aurora
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.3
 *
 */

class Aurora
{
	public $Application;
	const VERSION = 0.3;
	
	public function __construct(Application $Application = null)
	{
		$this->Application = $Application;
	}

	public function setApplication(Application $Application)
	{
		$this->Application = $Application;
	}
}
