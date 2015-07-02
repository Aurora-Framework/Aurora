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

namespace Aurora\Engine;

class Simple
{
   use \Aurora\Helper\StatefulTrait;

   function __construct(
      SimpleEnviromentInterface $Enviroment = null
   ) {

   }

   public function render($file, $data = null)
   {
      if (isset($data)) $this->data = (array) $data;

      include $file;
   }

   public function getHeader($file)
   {
      include $file;
   }

   public function getFooter($file)
   {
      include $file;
   }
}
