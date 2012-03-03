<?
IncludeModuleLangFile(__FILE__);

if($APPLICATION->GetGroupRight("SiteConfig")!="D")
{
	$aMenu = array(
		"parent_menu" => "global_menu_services",
		"section" => "SiteConfig",
		"sort" => 200,
		"text" => "Настройки сайта",
		"title" => "Настройки сайта",
		"url" => "site_config.php?lang=".LANGUAGE_ID,
		"icon" => "site_config_menu_icon",
		"page_icon" => "site_config_page_icon",
		"items_id" => "menu_site_config",
		"items" => array(
			array(
				"text" => "Настройки сайта",
				"url" => "site_config.php?lang=".LANGUAGE_ID,
				"title" => "Настройки сайта"
			),
               )
	);
	return $aMenu;
}
return false;
?>

