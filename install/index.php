<?php
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-18);
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

Class SiteConfig extends CModule
{
	var $MODULE_ID = "SiteConfig";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;

	function SiteConfig()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}
		
		$this->MODULE_NAME = "Настройки сайта";
		$this->MODULE_DESCRIPTION = "Модуль предназначен для хранения настроек сайта";
                
                $this->PARTNER_NAME = "Pupkov Semen";
		$this->PARTNER_URI = "http://www.clever-site.ru";
	}

	function InstallDB($arParams = array())
	{
		RegisterModule("SiteConfig");
                
                // Регитрируем обработчик события перед построением меню в админке
                RegisterModuleDependences(
                        'main', 
                        'OnBuildGlobalMenu', 
                        $this->MODULE_ID, 
                        'SiteConfigIncludeModule', 
                        'OnBuildGlobalMenu');
                return true;
	}

	function UnInstallDB($arParams = array())
	{
		UnRegisterModule("SiteConfig");
		UnRegisterModuleDependences(
                        'main', 
                        'OnBuildGlobalMenu', 
                        $this->MODULE_ID, 
                        'SiteConfigIncludeModule', 
                        'OnBuildGlobalMenu');
		
                return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}
	
	function InstallFiles($arParams = array())
	{
	    CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/SiteConfig/install/admin", 
			$_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin", true, true);
		
		CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/images/", 
			$_SERVER["DOCUMENT_ROOT"]."/bitrix/images/".$this->MODULE_ID."/", true, true);
		
		return true;
	}

	function UnInstallFiles()
	{
	    DeleteDirFiles(
	        $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/SiteConfig/install/admin", 
	        $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
		
		DeleteDirFiles(
			$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/images/", 
			$_SERVER["DOCUMENT_ROOT"]."/bitrix/images/".$this->MODULE_ID."/");
		
	    return true;
	}

	function DoInstall()
	{
	    global $DOCUMENT_ROOT, $APPLICATION;
	   
	    if ($this->InstallDB()) {
	        $this->InstallFiles();
	    }
	
	    $APPLICATION->IncludeAdminFile("Установка модуля конфигурации сайта", $DOCUMENT_ROOT."/bitrix/modules/compression/install/step.php");
	}

	function DoUninstall()
	{
	    global $DOCUMENT_ROOT, $APPLICATION;
	    if ($this->UnInstallDB()) {
		    $this->UnInstallFiles();
		}
		
	    $APPLICATION->IncludeAdminFile("Удаление модуля конфигурации сайта", $DOCUMENT_ROOT."/bitrix/modules/compression/install/unstep.php");
	}
}