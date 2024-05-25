<?php

use Knuckles\Scribe\Extracting\Strategies;

return [
    // 生成的文檔的 HTML <title>。如果這是空的，Scribe 將從 config('app.name') 推斷。
    'title' => null,

    // API 的簡短描述。將包含在文檔網頁、Postman 集合和 OpenAPI 規範中。
    'description' => '',

    // 文檔中顯示的基礎 URL。如果這是空的，Scribe 將在生成時使用 config('app.url') 的值。
    // 如果您使用的是 `laravel` 類型，您可以將其設置為動態字符串，例如 '{{ config("app.tenant_url") }}' 以獲取動態基礎 URL。
    'base_url' => null,

    'routes' => [
        [
            // 符合這些條件的路由將包含在文檔中
            'match' => [
                // 只匹配其路徑符合此模式的路由（使用 * 作為通配符匹配任何字符）。示例：'users/*'。
                'prefixes' => ['api/*'],

                // 只匹配其域名符合此模式的路由（使用 * 作為通配符匹配任何字符）。示例：'api.*'。
                'domains' => ['*'],

                // [僅 Dingo 路由器] 只匹配在此版本下註冊的路由。不支持通配符。
                'versions' => ['v1'],
            ],

            // 即使不符合上述規則，也包含這些路由。
            'include' => [
                // 'users.index', 'POST /new', '/auth/*'
            ],

            // 即使符合上述規則，也排除這些路由。
            'exclude' => [
                // 'GET /health', 'admin.*'
            ],
        ],
    ],

    // 要生成的文檔輸出類型。
    // - "static" 將在 /public/docs 文件夾中生成靜態 HTML 頁面，
    // - "laravel" 將生成文檔作為 Blade 視圖，這樣您就可以添加路由和身份驗證。
    // - "external_static" 和 "external_laravel" 與上面相同，但生成基本模板，
    // 傳遞 OpenAPI 規範作為 URL，允許您輕鬆地將文檔與外部生成器一起使用
    'type' => 'laravel',

    // 查看 https://scribe.knuckles.wtf/laravel/reference/config#theme 以獲取支持的選項
    'theme' => 'default',

    'static' => [
        // HTML 文檔、資產和 Postman 集合將生成到此文件夾。
        // 源 Markdown 仍將位於 resources/docs 中。
        'output_path' => 'public/docs',
    ],

    'laravel' => [
        // 是否自動為您創建文檔端口以查看生成的文檔。
        // 如果這是 false，您仍然可以手動設置路由。
        'add_routes' => true,

        // 用於文檔端口的 URL 路徑（如果 `add_routes` 為 true）。
        // 默認情況下，`/docs` 打開 HTML 頁面，`/docs.postman` 打開 Postman 集合，`/docs.openapi` 打開 OpenAPI 規範。
        'docs_url' => '/docs',

        // 在 `public` 中存儲 CSS 和 JS 資產的目錄。
        // 默認情況下，資產存儲在 `public/vendor/scribe` 中。
        // 如果設置，資產將存儲在 `public/{{assets_directory}}`
        'assets_directory' => null,

        // 要附加到文檔端口的中間件（如果 `add_routes` 為 true）。
        'middleware' => [],
    ],

    'external' => [
        'html_attributes' => []
    ],

    'try_it_out' => [
        // 為您的端口添加一個“試試看”按鈕，以便消費者可以直接從他們的瀏覽器測試端口。
        // 不要忘記為您的端口啟用 CORS 標頭。
        'enabled' => true,

        // API 測試器使用的基礎 URL（例如，您可以將其設置為您的暫存 URL）。
        // 生成時留空以使用當前應用程序 URL (config("app.url"))。
        'base_url' => null,

        // [Laravel Sanctum] 在每個請求之前獲取 CSRF 令牌，並將其添加為 X-XSRF-TOKEN 標頭。
        'use_csrf' => true,

        // 用於獲取 CSRF 令牌的 URL（如果 `use_csrf` 為 true）。
        'csrf_url' => '/sanctum/csrf-cookie',
    ],

    // 您的 API 如何進行身份驗證？此信息將用於顯示的文檔、生成的示例和回應調用中。
    'auth' => [
        // 如果您的 API 中的任何端口使用身份驗證，請設置為 true。
        'enabled' => true,

        // 如果您的 API 默認應進行身份驗證，請設置為 true。如果是這樣，您還必須將 `enabled`（上面）設置為 true。
        // 然後您可以在單個端口上使用 @unauthenticated 或 @authenticated 來更改其狀態。
        'default' => false,

        // 身份驗證值應發送到請求中的位置？
        // 選項：query, body, basic, bearer, header（自定義標頭）
        'in' => 'bearer',

        // 身份驗證參數（例如 token, key, apiKey）或標頭（例如 Authorization, Api-Key）的名稱。
        'name' => 'key',

        // Scribe 用於身份驗證回應調用的參數值。
        // 這不會包含在生成的文檔中。如果為空，Scribe 將使用隨機值。
        'use_value' => env('SCRIBE_AUTH_KEY'),

        // 在示例請求中用戶將看到的身份驗證參數佔位符。
        // 如果您希望 Scribe 使用隨機值作為佔位符，請將其設置為 null。
        'placeholder' => '{YOUR_AUTH_KEY}',

        // 為您的用戶提供的任何額外身份驗證相關信息。支持 Markdown 和 HTML。
        'extra_info' => '您可以訪問您的儀表板，然後點擊 <b>生成 API 令牌</b> 來獲取您的令牌',
    ],

    // “介紹”部分中的文本，位於 `description` 之後。支持 Markdown 和 HTML。
    'intro_text' => <<<INTRO
本文件旨在提供所有您需要的資訊，以便與我們的 API 進行互動。

<aside>當您向下滾動時，您會在右側的黑色區域（或在移動設備上作為內容的一部分）看到使用不同程式語言與 API 互動的代碼示例。
您可以使用右上角的選項卡（或在移動設備上從左上角的導航菜單）切換使用的程式語言。</aside>
INTRO
    ,

    // 每個端口的示例請求將以每種語言顯示。
    // 支持的選項有：bash, javascript, php, python
    // 要添加您自己的語言，請參閱 https://scribe.knuckles.wtf/laravel/advanced/example-requests
    'example_languages' => [
        'bash',
        'javascript',
    ],

    // 除了 HTML 文檔外，還生成一個 Postman 集合（v2.1.0）。
    // 對於 'static' 文檔，集合將生成到 public/docs/collection.json。
    // 對於 'laravel' 文檔，將生成到 storage/app/scribe/collection.json。
    // 將 `laravel.add_routes` 設置為 true（上面）也將添加集合的路由。
    'postman' => [
        'enabled' => true,

        'overrides' => [
            // 'info.version' => '2.0.0',
        ],
    ],

    // 除了文檔網頁外，還生成一個 OpenAPI 規範（v3.0.1）。
    // 對於 'static' 文檔，集合將生成到 public/docs/openapi.yaml。
    // 對於 'laravel' 文檔，將生成到 storage/app/scribe/openapi.yaml。
    // 將 `laravel.add_routes` 設置為 true（上面）也將添加規範的路由。
    'openapi' => [
        'enabled' => true,

        'overrides' => [
            // 'info.version' => '2.0.0',
        ],
    ],

    'groups' => [
        // 沒有 @group 的端口將被放置在此默認組中。
        'default' => '端口',

        // 默認情況下，Scribe 將按字母順序排序組，並按路由定義的順序排序端口。
        // 您可以通過在此處列出組、子組和端口來覆蓋此設置。
        // 有關詳細信息，請參閱 https://scribe.knuckles.wtf/blog/laravel-v4#easier-sorting 和 https://scribe.knuckles.wtf/laravel/reference/config#order
        'order' => [],
    ],

    // 自定義徽標路徑。這將用作 <img> 標籤的 src 屬性的值，
    // 因此請確保它指向可訪問的 URL 或路徑。設置為 false 以不使用徽標。
    // 例如，如果您的徽標在 public/img 中：
    // - 'logo' => '../img/logo.png' // 對於 'static' 類型（輸出文件夾為 public/docs）
    // - 'logo' => 'img/logo.png' // 對於 'laravel' 類型
    'logo' => false,

    // 通過指定令牌和格式來自定義文檔中顯示的“最後更新”值。
    // 示例：
    // - {date:F j Y} => March 28, 2022
    // - {git:short} => 最後一次 Git 提交的短哈希值
    // 可用的令牌有 `{date:<format>}` 和 `{git:<format>}`。
    // 傳遞給 `date` 的格式將傳遞給 PHP 的 `date()` 函數。
    // 傳遞給 `git` 的格式可以是“short”或“long”。
    'last_updated' => '最後更新: {date:F j, Y}',

    'examples' => [
        // 將此設置為任何數字（例如 1234）以在每次運行時生成相同的參數示例值，
        'faker_seed' => null,

        // 使用 API 資源和轉換器時，Scribe 會嘗試生成示例模型以在您的 API 回應中使用。
        // 默認情況下，Scribe 將嘗試模型的工廠，如果失敗，則嘗試從數據庫中獲取第一個。
        // 您可以在此處重新排序或刪除策略。
        'models_source' => ['factoryCreate', 'factoryMake', 'databaseFirst'],
    ],

    // Scribe 將在每個階段使用的策略，以提取有關您的路由的信息。
    // 如果您創建或安裝自定義策略，請在此處添加。
    'strategies' => [
        'metadata' => [
            Strategies\Metadata\GetFromDocBlocks::class,
            Strategies\Metadata\GetFromMetadataAttributes::class,
        ],
        'urlParameters' => [
            Strategies\UrlParameters\GetFromLaravelAPI::class,
            Strategies\UrlParameters\GetFromUrlParamAttribute::class,
            Strategies\UrlParameters\GetFromUrlParamTag::class,
        ],
        'queryParameters' => [
            Strategies\QueryParameters\GetFromFormRequest::class,
            Strategies\QueryParameters\GetFromInlineValidator::class,
            Strategies\QueryParameters\GetFromQueryParamAttribute::class,
            Strategies\QueryParameters\GetFromQueryParamTag::class,
        ],
        'headers' => [
            Strategies\Headers\GetFromHeaderAttribute::class,
            Strategies\Headers\GetFromHeaderTag::class,
            [
                'override',
                [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]
        ],
        'bodyParameters' => [
            Strategies\BodyParameters\GetFromFormRequest::class,
            Strategies\BodyParameters\GetFromInlineValidator::class,
            Strategies\BodyParameters\GetFromBodyParamAttribute::class,
            Strategies\BodyParameters\GetFromBodyParamTag::class,
        ],
        'responses' => [
            Strategies\Responses\UseResponseAttributes::class,
            Strategies\Responses\UseTransformerTags::class,
            Strategies\Responses\UseApiResourceTags::class,
            Strategies\Responses\UseResponseTag::class,
            Strategies\Responses\UseResponseFileTag::class,
            [
                Strategies\Responses\ResponseCalls::class,
                ['only' => ['GET *']]
            ]
        ],
        'responseFields' => [
            Strategies\ResponseFields\GetFromResponseFieldAttribute::class,
            Strategies\ResponseFields\GetFromResponseFieldTag::class,
        ],
    ],

    // 對於回應調用、API 資源回應和轉換器回應，
    // Scribe 將嘗試啟動數據庫交易，以便您的數據庫不會有任何變更。
    // 告訴 Scribe 這些連接應該在此處進行交易。如果您只使用一個數據庫連接，則可以保持此設置。
    'database_connections_to_transact' => [config('database.default')],

    'fractal' => [
        // 如果您使用自定義序列化程序與 league/fractal，您可以在此處指定。
        'serializer' => null,
    ],

    'routeMatcher' => \Knuckles\Scribe\Matching\RouteMatcher::class,
];
