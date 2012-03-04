<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/SiteConfig/classes/general/SiteConfig.php");

$blogModulePermissions = $APPLICATION->GetGroupRight("SiteConfig");
if ($blogModulePermissions < "R") {
  $APPLICATION->AuthForm('Доступ запрещен');
}
$siteConfig = new SiteConfig();

if ($_REQUEST['save'] || $_REQUEST['apply']) {
  $siteConfig->save();
}

$APPLICATION->SetTitle('Настройки сайта');

$sTableID='SiteConfig';
$oSort = new CAdminSorting($sTableID, "ID", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);


$lAdmin->CheckListMode();

$xmlSections = $siteConfig->readXmlFile();

$aTabs = array();
foreach ($xmlSections as $section) {
  $aTabs[] = array(
      "DIV" => $section['id'],
      "TAB" => $section['title'],
  );
}


$tabControl = new CAdminTabControl("tabControl", $aTabs);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/SiteConfig/helpers/form.php");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>
