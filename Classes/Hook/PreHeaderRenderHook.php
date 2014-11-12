<?php

class Tx_beskin_Be_PreHeaderRenderHook {
	function main($arg) {
		/** @var \t3lib_PageRenderer $pagerenderer*/
		$pagerenderer = $arg['pageRenderer'];

		$extConfigs = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['beskin']);
		$paths = array ();

		if(t3lib_div::getFileAbsFileName($extConfigs['cssFile'])) {
			$paths['cssFile'] = t3lib_div::getFileAbsFileName($extConfigs['cssFile']);
			$paths = t3lib_div::removePrefixPathFromList($paths,PATH_site);
			$pagerenderer->addCssFile('../' . $paths['cssFile']);
		}
	}
}
