<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
---
</br>
<p><b><?=GetMessage("SIMPLECOMP_TASK2_CAT_TITLE")?></b></p>
<?php if (is_countable($arResult["NEWS"]) && count($arResult["NEWS"]) > 0) { ?>
    <ul>
        <?php foreach ($arResult["NEWS"] as $arNews) { ?>
            <li>
                <b>
                    <?=$arNews["NAME"];?>
                </b>
                - <?=$arNews["ACTIVE_FORM"];?>
                (<?=implode(",", $arNews ?? ["SECTIONS"]);?>)
            </li>
    
            <?php if (is_countable($arNews["PRODUCTS"]) && count($arNews["PRODUCTS"]) > 0) { ?>
                <ul>
                    <?php foreach ($arNews["PRODUCTS"] as $arProduct) { ?>
                        <li>
                            <?=$arProduct["NAME"];?> -
                            <?=$arProduct["PROPERTY_PRICE_VALUE"];?> -
                            <?=$arProduct["PROPERTY_MATERIAL_VALUE"];?> -
                            <?=$arProduct["PROPERTY_ARTNUMBER_VALUE"];?> -
                            <!-- <a href="<?=$arItems["DETAIL_PAGE_URL"];?>">ссылка на детальный просмотр</a> -->
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>
