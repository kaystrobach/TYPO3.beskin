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
	if(is_readable(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($t['logintemplate']))) {
		$loginFileName = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($t['logintemplate']);
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
	 * change favicon
	 */
	if($t['favicon'] !== '') {
		$GLOBALS['TBE_STYLES']['skinImg']['gfx/favicon.ico'] = array(
			0 => $t['favicon'],
			1 => 'width="16" height="16"'
		);
	}

	/**
	 * change backendlogo
	 */
	$paths = array ();
	if(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($t['logo'])) {
		$paths['logo']    = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($t['logo']);
	}
	$paths = \TYPO3\CMS\Core\Utility\GeneralUtility::removePrefixPathFromList($paths,PATH_site);
	$GLOBALS['TBE_STYLES']['logo'] = '../'.$paths['logo'];

}

?>
