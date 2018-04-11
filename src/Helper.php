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
		$this->varsTemplate    = file_get_contents(__DIR__."/Views/variables.twig");
	}

  public function run() {
    $storeData               = Data::get();
		$options                 = array();
		$options["patternPaths"] = $this->patternPaths;
    $patternDataStore        = PatternData::get();

		$patternEngineBasePath   = PatternEngine::getInstance()->getBasePath();
		$patternLoaderClass      = $patternEngineBasePath."\Loaders\PatternLoader";
    $patternLoader           = new $patternLoaderClass($options);

    $parser = new \cebe\markdown\GithubMarkdown();

    print_r($storeData);

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
          if (!empty($docblock->getSummary())) {
            PatternData::setPatternOption($patternStoreKey, 'nameClean', $docblock->getSummary());
          }
          $desc = "";
          if (!empty($docblock->getDescription())) {
            $desc = $parser->parse($docblock->getDescription()->render());
          }
          $variables = [];

          foreach ( $docblock->getTags() as $value) {
            if ( is_a($value, 'phpDocumentor\Reflection\DocBlock\Tags\Param')) {
              $variables[$value->getVariableName()] = [
                'type' => $value->getType() . "",
                'desc' => $value->getDescription()->render()
              ];
            }
          }
          if (count($variables)) {
            $desc .= '<table style="width: 100%" class="variables"><thead><tr><th>Name</th><th>Type</th><th>Description</th></tr></thead><tbody>';
            foreach ($variables as $name => $info) {
              $desc .= '<tr><td>' . $name . '</td><td>' . $info['type'] . '</td><td>' . $info['desc'] . '</td></tr>';
            }
            $desc .= '</tbody></table>';
          }

          if (!empty($desc)) {
            PatternData::setPatternOption($patternStoreKey, 'desc', $desc);
            PatternData::setPatternOption($patternStoreKey, 'descExists', 1);
          }

        }
      }
    }
  }

}