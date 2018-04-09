<?php

namespace PatternLab\TwigDoc;

use \PatternLab\Config;
use \PatternLab\Data;
use \PatternLab\PatternData;
use \PatternLab\PatternEngine\Twig\TwigUtil;

class TwigDocListener extends \PatternLab\Listener {

  /**
  * Add the listeners for this plug-in
  */
  public function __construct() {

    // add listener
    $this->addListener("twigLoader.customize","init");
  }

  public function init() {
    $instance = TwigUtil::getInstance();
    print_r($instance);
    die();
  }
}