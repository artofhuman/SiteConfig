<?php
IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("SiteConfig")!="D")
{
	$aMenu = array(
		"parent_menu" => "global_menu_settings",
		"section" => "SiteConfig",
		"sort" => 1,
		"text" => "Настройки сайта",
		"title" => "Настройки сайта",
		"url" => "site_config.php?lang=".LANGUAGE_ID,
		"icon" => "site_config_menu_icon",
		"page_icon" => "site_config_page_icon",
		"items_id" => "menu_site_config",
		
	);
        
	return $aMenu;
}
return false;