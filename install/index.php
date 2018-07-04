<?php
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class prinum_gtmgo extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'prinum.gtmgo';
        $this->MODULE_NAME = Loc::getMessage('BEX_D7DULL_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('BEX_D7DULL_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('BEX_D7DULL_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'https://w7.ru';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        EventManager::getInstance()->registerEventHandler("main", "OnEndBufferContent", "prinum.gtmgo", "TagManager", "AddSiteTagmanager");
    }

    public function doUninstall()
    {
        EventManager::getInstance()->unRegisterEventHandler("main", "OnEndBufferContent", "prinum.gtmgo", "TagManager", "AddSiteTagmanager");  
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
