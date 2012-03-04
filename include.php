<?php
class SiteConfigIncludeModule {
    
    /**
     * Перед построением меню в админке подгружаем стили
     * @global type $APPLICATION
     * @param type $aGlobalMenu
     * @param type $aModuleMenu 
     */
    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu) {
        global $APPLICATION;
        $APPLICATION->AddHeadString('<link rel="stylesheet" href="/bitrix/images/SiteConfig/icons.css" />');
    }
}

CModule::AddAutoloadClasses('SiteConfig', array('SiteConfig' => 'classes/general/SiteConfig.php'));
