<?php

namespace bconnect\twigdoc;

use \PatternLab\Config;
use \PatternLab\Data;
use \PatternLab\PatternData;
use \PatternLab\PatternData\Helper as PatternDataHelper;
use \PatternLab\PatternEngine;
use \PatternLab\Template;
use \PatternLab\Timer;


class Helper extends PatternDataHelper {

  const REG_EX_COMMENT = '/^{#(.*)#}/s';

	public function __construct($options = array()) {
		parent::__construct($options);
		$this->patternPaths    = $options["patternPaths"];
  }

  public function run() {

    // various set-up options
    $storeData               = Data::get();
		$options                 = array();
		$options["patternPaths"] = $this->patternPaths;
    $patternDataStore        = PatternData::get();

		$patternEngineBasePath   = PatternEngine::getInstance()->getBasePath();
		$patternLoaderClass      = $patternEngineBasePath."\Loaders\PatternLoader";
    $patternLoader           = new $patternLoaderClass($options);

    foreach ($patternDataStore as $patternStoreKey => $patternStoreData)  {
      if (isset($patternStoreData['patternRaw'])) {
        $matches = [];
        if ((preg_match(Helper::REG_EX_COMMENT, $patternStoreData['patternRaw'], $matches)) && count($matches)) {
          $factory  = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
          $docblock = $factory->create($matches[1]);
          foreach ($docblock->getTags() as $tag) {
            if ($tag->getName() === 'example') {
              PatternData::setPatternOption($patternStoreKey, 'patternRaw', $tag->getDescription());
            }
          }
        }
      }
    }
  }

}