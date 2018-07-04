<?php
global $DB, $APPLICATION, $MESS, $DBType;

\Bitrix\Main\Loader::registerAutoLoadClasses(
	"prinum.gtmgo",
	array(
		'TagManager' => 'lib/tagmanager.php'
	)
);