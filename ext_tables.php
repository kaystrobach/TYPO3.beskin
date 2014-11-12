<?php


if(TYPO3_MODE == 'BE') {
	/**
	 * add Stylesheets for outer frame
	 */	 	
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = 'EXT:beskin/Classes/Hook/PreHeaderRenderHook.php:Tx_beskin_Be_PreHeaderRenderHook->main';

	/**
	 * make loginscreen configurable
	 */	 	
	$t = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['beskin']);
	if(is_readable(t3lib_div::getFileAbsFileName($t['logintemplate']))) {
		$loginFileName = t3lib_div::getFileAbsFileName($t['logintemplate']);
		// pre 6.x
		$GLOBALS['TBE_STYLES']['htmlTemplates']['templates/login.html'] = $loginFileName;
		// 6.x+
		$GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = $loginFileName;
	}
	if($t['loginLogoPath'] !== '') {
		$GLOBALS['TBE_STYLES']['logo_login'] = $t['loginLogoPath'];
		#$GLOBALS['TBE_STYLES']['loginBoxImage_rotationFolder'] = $t['loginLogoPath'];
		#$GLOBALS['TBE_STYLES']['loginBoxImage_rotationFolder'] = t3lib_div::getFileAbsFileName($t['loginLogoPath'], TRUE);
	}

	/**
	 * change backendlogo
	 */
	$paths = array ();
	if(t3lib_div::getFileAbsFileName($t['logo'])) {
		$paths['logo']    = t3lib_div::getFileAbsFileName($t['logo']);
	}
	$paths = t3lib_div::removePrefixPathFromList($paths,PATH_site);
	$GLOBALS['TBE_STYLES']['logo'] = '../'.$paths['logo'];

}

?>