<?php

namespace bconnect\twigdoc;

use \PatternLab\Config;
use \PatternLab\Data;
use \PatternLab\PatternData;
use \PatternLab\PatternEngine\Twig\TwigUtil;
use \PatternLab\PatternData\Event;

class PatternLabListener extends \PatternLab\Listener {

  /**
  * Add the listeners for this plug-in
  */
  public function __construct() {
    // add listener
    $this->addListener("patternData.codeHelperStart","runHelper");
  }

  public function runHelper(Event $event) {
    $helper = new Helper($event->getOptions());
    $helper->run();
  }

}