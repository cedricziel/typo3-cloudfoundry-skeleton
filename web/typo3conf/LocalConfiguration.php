<?php

// ** Read MySQL service properties from _ENV['VCAP_SERVICES']
$services = json_decode($_ENV['VCAP_SERVICES'], true);
$service = $services['cleardb'][0];  // pick the first MySQL service

return array(
    'BE' => array(
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$P$CbLBI.8b2iFtQF08sX.EAGudttep/E1',
        'loginSecurityLevel' => 'rsa',
    ),
    'DB' => array(
        'database' => $service['credentials']['name'],
        'host' => $service['credentials']['hostname'],
        'password' => $service['credentials']['password'],
        'port' => 3306,
        'username' => $service['credentials']['username'],
    ),
    'EXT' => array(
        'extConf' => array(
            'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
            'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
        ),
    ),
    'FE' => array(
        'debug' => false,
        'loginSecurityLevel' => 'rsa',
    ),
    'GFX' => array(
        'colorspace' => 'sRGB',
        'im' => 1,
        'im_mask_temp_ext_gif' => 1,
        'im_path' => '/usr/bin/',
        'im_path_lzw' => '/usr/bin/',
        'im_v5effects' => 1,
        'im_version_5' => 'im6',
        'image_processing' => 1,
        'jpg_quality' => '80',
    ),
    'INSTALL' => array(
        'wizardDone' => array(
            'TYPO3\CMS\Install\Updates\BackendUserStartModuleUpdate' => 1,
            'TYPO3\CMS\Install\Updates\FileListIsStartModuleUpdate' => 1,
            'TYPO3\CMS\Install\Updates\FilesReplacePermissionUpdate' => 1,
            'TYPO3\CMS\Install\Updates\LanguageIsoCodeUpdate' => 1,
            'TYPO3\CMS\Install\Updates\MigrateShortcutUrlsAgainUpdate' => 1,
            'TYPO3\CMS\Install\Updates\PageShortcutParentUpdate' => 1,
            'TYPO3\CMS\Install\Updates\ProcessedFileChecksumUpdate' => 1,
            'TYPO3\CMS\Install\Updates\TableFlexFormToTtContentFieldsUpdate' => 1,
            'TYPO3\CMS\Rtehtmlarea\Hook\Install\DeprecatedRteProperties' => 1,
            'TYPO3\CMS\Rtehtmlarea\Hook\Install\RteAcronymButtonRenamedToAbbreviation' => 1,
        ),
    ),
    'MAIL' => array(
        'transport_sendmail_command' => ' -t -i ',
    ),
    'SYS' => array(
        'caching' => array(
            'cacheConfigurations' => array(
                'extbase_object' => array(
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
                    'groups' => array(
                        'system',
                    ),
                    'options' => array(
                        'defaultLifetime' => 0,
                    ),
                ),
            ),
        ),
        'clearCacheSystem' => false,
        'devIPmask' => '',
        'displayErrors' => 0,
        'enableDeprecationLog' => false,
        'encryptionKey' => getenv('TYPO3_SYS_ENCRYPTIONKEY'),
        'isInitialDatabaseImportDone' => false,
        'isInitialInstallationInProgress' => true,
        'sitename' => getenv('TYPO3_SYS_SITENAME'),
        'sqlDebug' => 0,
        'systemLogLevel' => 2,
        't3lib_cs_convMethod' => 'iconv',
        't3lib_cs_utils' => 'iconv',
    ),
);
?>
