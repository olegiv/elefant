<?php

/**
 * Displays a list of layout templates and stylesheets in two tabs.
 */

$page->layout = 'admin';

$this->require_acl ('admin', 'designer');

$lock = new Lock ();

$out = array (
	'layouts' => glob ('layouts/*.html'),
	'layouts2' => glob ('layouts/*/*.html'),
	'layouts3' => glob ('layouts/*/*/*.html'),
	'stylesheets' => glob ('css/*.css'),
	'stylesheets2' => glob ('layouts/*/*.css'),
	'stylesheets3' => glob ('layouts/*/*/*.css'),
	'locks' => array ()
);

if ($out['layouts2']) {
  foreach ($out['layouts2'] as $name) {
	  $out['layouts'][] = $name;
  }
}

if ($out['layouts3']) {
  foreach ($out['layouts3'] as $name) {
	  $out['layouts'][] = $name;
  }
}

if ($out['stylesheets2']) {
  foreach ($out['stylesheets2'] as $name) {
	  $out['stylesheets'][] = $name;
  }
}

if ($out['stylesheets3']) {
	foreach ($out['stylesheets3'] as $name) {
		$out['stylesheets'][] = $name;
	}
}

if ($out['layouts']) {
  foreach ($out['layouts'] as $name) {
	  $out['locks'][$name] = $lock->exists ('Designer', $name);
  }
}

if ($out['stylesheets']) {
  foreach ($out['stylesheets'] as $name) {
	  $out['locks'][$name] = $lock->exists ('Designer', $name);
  }
}

require_once ('apps/designer/lib/Functions.php');

$page->title = __ ('Designer');
echo $tpl->render ('designer/index', $out);
