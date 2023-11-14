<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задание2");
?><?$APPLICATION->IncludeComponent(
	"simplecomp.catalog",
	"",
Array()
);?>Text here....<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>