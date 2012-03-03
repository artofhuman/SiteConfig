<?php
if(!CModule::IncludeModule('iblock'))
	return false;

IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	'SiteConfig',
	array('SiteConfig' => 'classes/general/SiteConfig.php',)
);
	
	
?>