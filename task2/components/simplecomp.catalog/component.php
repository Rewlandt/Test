<?
if(!defined( constant_name: "B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule( moduleName: "iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_TASK2_IBLOCK_MODULE_NONE"));
	return;
}

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

if(!isset($arParams["PRODUCTS_IBLOCK_ID"]))
	$arParams["PRODUCTS_IBLOCK_ID"] = 0;

if(!isset($arParams["NEWS_IBLOCK_ID"]))
	$arParams["NEWS_IBLOCK_ID"] = 0;

//Кеширование
if ($this->startResultCache()) {
	$arNews = array();
	$arNewsID = array();
	//Массив новостей
	$obNews = CIBlockElement::GetList(
		array(),
		array(
			"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
			"ACTIVE" => "Y"
		),
		false,
		false,
		array(
			"NAME",
			"ACTIVE_FROM",
			"ID",
		)
	);


	while ($newsElements = $obNews->Fetch()) {
		$arNewsID[] = $newsElements["ID"];
		$arNews[$newsElements["ID"]] = $newsElements;
	}


	$arSections = array();
	$arSectionsID = array();
	
	// Получаем список активных разделов с привязкой к активным новостям
	$obSection = CIBlockElement::GetList(
		array(),
		array(
			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
			"ACTIVE" => "Y",
			$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"] => $arNewsID
		),
		false,
		false,
		array(
			"NAME",
			"IBLOCK_ID",
			"ID",
			$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]
		),
		false
	);
	
	while ($arSectionCatalog = $obSection->Fetch()) {
		$arNewsID[] = $arSectionCatalog["ID"];
		$arNews[$arSectionCatalog["ID"]] = $arSectionCatalog;
	}
	

	//Получаем список активных элементов
	$obProduct = CIBlockElement::GetList(
		array(),
		array(
			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
			"ACTIVE" => "Y",
			"SECTION_ID" => $arSectionsID
		),
		false,
		false,
		array(
			"NAME",
			"IBLOCK_SECTION_ID",
			"ID",
			"IBLOCK_ID",
			"PROPERTY_ARTNUMBER",
			"PROPERTY_MATERIAL",
			"PROPERTY_PRICE",
		)
	);


	$arResult["PRODUCT_CNT"] = 0;
	while ($arProduct = $obProduct->Fetch()) {
		$arResult["PRODUCT_CNT"] ++;
		foreach ($arSections[$arProduct["IBLOCK_SECTION_ID"]][$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newsId) {
			$arNews[$newsId]["PRODUCTS"][] = $arProduct;
		}
	}
	

	//Распределяем разделы по новостям
	foreach ($arSections as $arSection) {

		foreach ($arSection[$arParams["PRODUCTS_IBLOCK_ID_PROPERTY"]] as $newId) {
			$arNews[$newId]['SECTIONS'] = $arSection["NAME"];
		}
	}

	$arResult["NEWS"] = $arNews;
	$this->SetResultCacheKeys(array("PRODUCT_CNT"));
	$this->includeComponentTemplate();
} else {
	$this->abortResultCache();
}
$APPLICATION->SetTitle( title: GetMessage("COUNT").$arResult["PRODUCT_CNT"]);
?>
