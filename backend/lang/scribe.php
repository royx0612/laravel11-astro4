<?php

return [
    "labels" => [
        "search" => "搜尋",
        "base_url" => "基礎 URL",
    ],

    "auth" => [
        "none" => "此 API 無需身份驗證。",
        "instruction" => [
            "query" => <<<TEXT
                若要進行身份驗證，請在請求中包含查詢參數 **`:parameterName`**。
                TEXT,
            "body" => <<<TEXT
                若要進行身份驗證，請在請求的主體中包含參數 **`:parameterName`**。
                TEXT,
            "query_or_body" => <<<TEXT
                若要進行身份驗證，請在查詢字串或請求主體中包含參數 **`:parameterName`**。
                TEXT,
            "bearer" => <<<TEXT
                若要進行身份驗證，請在 **`Authorization`** 標頭中包含值 **`"Bearer :placeholder"`**。
                TEXT,
            "basic" => <<<TEXT
                若要進行身份驗證，請在 **`Authorization`** 標頭中使用形式 **`"Basic {credentials}"`**。
                `{credentials}` 的值應為您的用戶名/ID 和密碼，中間用冒號 (:) 連接，
                然後進行 base64 編碼。
                TEXT,
            "header" => <<<TEXT
                若要進行身份驗證，請在 **`:parameterName`** 標頭中包含值 **`":placeholder"`**。
                TEXT,
        ],
        "details" => <<<TEXT
            所有需要身份驗證的端口在以下文檔中標有 `requires authentication` 徽章。
            TEXT,
    ],

    "headings" => [
        "introduction" => "介紹",
        "auth" => "身份驗證請求",
    ],

    "endpoint" => [
        "request" => "請求",
        "headers" => "標頭",
        "url_parameters" => "URL 參數",
        "body_parameters" => "主體參數",
        "query_parameters" => "查詢參數",
        "response" => "回應",
        "response_fields" => "回應欄位",
        "example_request" => "範例請求",
        "example_response" => "範例回應",
        "responses" => [
            "binary" => "二進制數據",
            "empty" => "空回應",
        ],
    ],

    "try_it_out" => [
        "open" => "試試看 ⚡",
        "cancel" => "取消 🛑",
        "send" => "發送請求 💥",
        "loading" => "⏱ 發送中...",
        "received_response" => "收到回應",
        "request_failed" => "請求失敗，錯誤",
        "error_help" => <<<TEXT
            提示：檢查您是否正確連接到網絡。
            如果您是此 API 的維護者，請確認您的 API 正在運行並且已啟用 CORS。
            您可以檢查開發工具控制台以獲取調試信息。
            TEXT,
    ],

    "links" => [
        "postman" => "查看 Postman 集合",
        "openapi" => "查看 OpenAPI 規範",
    ],
];
?>
