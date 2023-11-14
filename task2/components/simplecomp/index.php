<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"task2:simplecomp.catalog", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCTS_IBLOCK_ID" => "2",
		"PRODUCTS_IBLOCK_ID_PROPERTY" => "UF_NEWS_LINK",
		"COMPONENT_TEMPLATE" => ".default",
		"TEMPLATE_DETAIL_URL" => "catalog_task/#SECTION_ID#/#ELEMENT_CODE#",
		"ELEMENT_PER_PAGE" => "2"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>