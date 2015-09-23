<?php

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

// ** Read MySQL service properties from _ENV['VCAP_SERVICES']
$services = json_decode($_ENV['VCAP_SERVICES'], true);
$service = $services['cleardb'][0];  // pick the first MySQL service

// Database Credentials
$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = $service['credentials']['name'];
$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = $service['credentials']['hostname'];
$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = $service['credentials']['password'];
$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = $service['credentials']['username'];

// System variables
$GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = getenv('TYPO3_SYS_ENCRYPTIONKEY');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = getenv('TYPO3_SYS_SITENAME');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['isInitialDatabaseImportDone'] = getenv('TYPO3_SYS_ISINITIALIMPORTDONE');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['isInitialInstallationInProgress'] = getenv('TYPO3_SYS_ISINITIALINSTALLATIONINPROGRESS');

