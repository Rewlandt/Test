<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_TASK2_CAT_IBLOCK"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_TASK2_NEWS_IBLOCK"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"PRODUCTS_IBLOCK_ID_PROPERTY" => array(
			"NAME" => GetMessage("SIMPLECOMP_TASK2_CAT_PROPERTY_IBLOCK"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"CACHE_TIME" => array(
			"DEFAULT" => 36000000
		),
	),
);
