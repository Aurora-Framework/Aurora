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
 * Aurora.Application
 *
 * @category   Common
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    1.0
 *
 */

use Aurora\DI\ResolverInterface;
use Aurora\DI\Rule;
use Aurora\Exceptions\MethodNotAllowedExeption;

class Application
{
	/**
 	* Namespace used for application
 	* @var string
 	*/
	public static $namespace;

	/**
 	* Instance of Dependency resolver with ProviderInterface
 	* @var \ResolverInterface Dependency resolver
 	*/
	public $Injector;

	/**
 	* Contains Configuration for Aurora
 	* @var \Aurora\Config Config
 	*/
	private $Config;

	/**
 	* Constructor
 	* @param Config   $Config   Instance of Config must be given
 	* @param Dice $Dice Dice instance
 	*/
	public function __construct(
		Config $Config = null,
		ResolverInterface $Injector = null
	) {
		$this->Config = $Config;
		$this->Injector = $Injector;
	}

	public function setConfig(Config $Config)
	{
		$this->Config = $Config;
	}

	public function setInjector(Injector $Injector)
	{
		$this->Injector = $Injector;
	}

	/**
 	* Set the namespace, which will be use for
 	* whole application
 	*
 	* @param   $namespace Namespace to use
 	* @return \Aurora\App Returns concurrent instance of App
 	*/
	public static function useNamespace($namespace = null)
	{
		self::$namespace = $namespace;
	}

	/**
 	* Set the namespace, which will be use for
 	* whole application
 	*
 	* @param   $namespace Namespace to use
 	* @return \Aurora\App Returns concurrent instance of App
 	*/
	public static function setNamespace($namespace = null)
	{
		self::$namespace = $namespace;
	}

	/**
 	* Run
 	* @todo Fix strings in PHP7
 	*
 	* @param  string $controller Namespace of controller
 	* @param  string $action     Method of the given controller
 	* @param  array  $vars       Variables passed for method
 	* @return null               Not handled for now
 	*/
	public function run($callable, $vars = array())
	{
		$isArray = is_array($callable);

		if ($isArray) {

			/* Assign variables for callable */
			$controllerClass = self::getNamespace($callable[0]);
			$controllermethod = $callable[1];

			/* Create callable */
			$callableController = array($controllerClass, $controllermethod);

			if (!is_callable($callableController)) {

				throw new MethodNotAllowedException();

			} else {
				$Rule = new Rule($controllerClass);
				$Rule->reflectionable = true;
				$Rule->setParametersArray(array_values($vars), $controllermethod);
				$Rule->hasInstance = true;
				$Rule->Instance = $this->Injector->make($controllerClass);
				$this->Injector->addRule($Rule);

				$this->Injector->callMethod($controllerClass, "onConstruct");
				$this->Injector->callMethod($controllerClass, "before");
				$this->Injector->callMethod($controllerClass, $controllermethod);
				$this->Injector->callMethod($controllerClass, "after");
			}

		} else if (is_callable($callable)) {
			$this->Injector->execute($callable, $vars);
		}
	}

	/**
 	* getNamespace Returns namespace
 	* @param string $namespace Get namespace
 	* @return string Namespace
 	*/
	public static function getNamespace($namespace = null)
	{

		if ($namespace[0] !== "\\") {
			$namespace = self::$namespace.$namespace;
		}

		return (string) $namespace;
	}

	public function addErrorHandler($errorCallable, $shutdownCallable)
	{
		set_error_handler($errorCallable);
	}

	public function errorHandler($errno, $errstr = '', $errfile = '', $errline = '')
	{
		if (!($errno & error_reporting())) {
				return;
		}
		throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
	}

}
