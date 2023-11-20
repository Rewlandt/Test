<?
IncludeModuleLangFile(__FILE__);
AddEventHandler("main", "OnBeforeEventAdd", "FeedbackHandlerEvent");
    function FeedbackHandlerEvent(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            if ($USER->isAuthorized()) {
                $arFields["AUTHOR"] = GetMessage(
                    "TASK2_AUTH_USER",
                    array(
                        "ID" => $USER->GetID(),
                        "LOGIN" => $USER->GetLogin(),
                        "NAME" => $USER->GetFullName(),
                        "NAME_FORM" => $arFields["AUTHOR"]
                    )
                );echo ($arFields["AUTHOR"]);
            } else {
                $arFields["AUTHOR"] = GetMessage(
                    "TASK2_NO_AUTH_USER",
                    array(
                        "#NAME_FORM#" => $arFields["AUTHOR"]
                    )
                );
            }
            CEventLog::Add(
                array(
                    "SEVERITY" => "SECURITY",
                    "AUDIT_TYPE_ID"  => GetMessage("TASK2_REPLACEMENT"),
                    "MODULE_ID" => "main",
                    "ITEM_ID" => $event,
                    "DESCRIPTION" => GetMessage("TASK2_REPLACEMENT") . '-' . $arFields["AUTHOR"]
                )
            );
        }
    }
