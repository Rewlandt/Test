<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
---
</br>
<p><b><?=GetMessage("SIMPLECOMP_TASK2_CAT_TITLE")?></b></p>
<?php if (is_countable($arResult["CLASSIF"]) && count($arResult["CLASSIF"]) > 0) { ?>
    <ul>
        <?php foreach ($arResult["CLASSIF"] as $arClassificator) { ?>
            <li>
                <b>
                    <?=$arClassificator["NAME"];?>
                </b>
                <?php if (count($arClassificator["ELEMENTS"]) > 0) { ?>
                    <ul>
                        <?php foreach ($arClassificator["ELEMENTS"] as $arItems) { ?>
                            <li>
                                <?=$arItems["NAME"];?> -
                                <?=$arItems["PROPERTY"]["PRICE"]["VALUE"];?> -
                                <?=$arItems["PROPERTY"]["MATERIAL"]["VALUE"];?> -
                                <?=$arItems["PROPERTY"]["ARTNUMBER"]["VALUE"];?> -
                                <a href="<?=$arItems["DETAIL_PAGE_URL"];?>">ссылка на детальный просмотр</a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
<?php } ?>