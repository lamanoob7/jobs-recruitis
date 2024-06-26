# App\Module\RecruitisApi\EnumerationsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**enumsChannelsGet()**](EnumerationsApi.md#enumsChannelsGet) | **GET** /enums/channels | Get Company channels |
| [**enumsEmploymentsGet()**](EnumerationsApi.md#enumsEmploymentsGet) | **GET** /enums/employments | Get Employment list |
| [**enumsFlowsGet()**](EnumerationsApi.md#enumsFlowsGet) | **GET** /enums/flows | Get Flows |
| [**enumsOfficesGet()**](EnumerationsApi.md#enumsOfficesGet) | **GET** /enums/offices | Get Offices |
| [**enumsRejectReasonsGet()**](EnumerationsApi.md#enumsRejectReasonsGet) | **GET** /enums/reject_reasons | Get Reject reasons |
| [**enumsSourcesGet()**](EnumerationsApi.md#enumsSourcesGet) | **GET** /enums/sources | Get Company sources |
| [**enumsWorkfieldsGet()**](EnumerationsApi.md#enumsWorkfieldsGet) | **GET** /enums/workfields | Get Workfields |


## `enumsChannelsGet()`

```php
enumsChannelsGet(): \App\Module\RecruitisApi\Model\EnumsChannelsGet200Response
```

Get Company channels

Získá všechny publikační kanály, na kterých může daná firma publikovat inzeráty. Při filtraci inzerátu lze pak ID kanálu používat jako argument.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->enumsChannelsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsChannelsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\EnumsChannelsGet200Response**](../Model/EnumsChannelsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsEmploymentsGet()`

```php
enumsEmploymentsGet($lang): \App\Module\RecruitisApi\Model\EnumsEmploymentsGet200Response
```

Get Employment list

Vrací všechny naše pracovní poměry a jejich ID.  #### Requirements  * Není potřeba žádná autorizace.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$lang = 'lang_example'; // string | Jazyk, ve kterém se mají obory vrátit (momentálně je podporována pouze čeština).

try {
    $result = $apiInstance->enumsEmploymentsGet($lang);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsEmploymentsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lang** | **string**| Jazyk, ve kterém se mají obory vrátit (momentálně je podporována pouze čeština). | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\EnumsEmploymentsGet200Response**](../Model/EnumsEmploymentsGet200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsFlowsGet()`

```php
enumsFlowsGet($name, $job_id): \App\Module\RecruitisApi\Model\EnumsFlowsGet200Response
```

Get Flows

Toto volání vrací bez parametru výčet všech flow šablon a jejich stavů. Při zadání obou parametrů zároveň má ve vyhledávání přednost `jobId` - parametr `name` se ignoruje.  #### Requirements * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$name = Základní rozřazení; // string | Jméno flow šablony. Vrátí stavy tohoto náborového flow.
$job_id = 138798; // int | ID pozice. Ze zadané pozice zjistí flow šablonu a vrátí její stavy. Pokud je zadaný parametr jobID, parametr name se ignoruje.

try {
    $result = $apiInstance->enumsFlowsGet($name, $job_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsFlowsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **name** | **string**| Jméno flow šablony. Vrátí stavy tohoto náborového flow. | [optional] |
| **job_id** | **int**| ID pozice. Ze zadané pozice zjistí flow šablonu a vrátí její stavy. Pokud je zadaný parametr jobID, parametr name se ignoruje. | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\EnumsFlowsGet200Response**](../Model/EnumsFlowsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsOfficesGet()`

```php
enumsOfficesGet(): \App\Module\RecruitisApi\Model\EnumsOfficesGet200Response
```

Get Offices

Vrací veškeré pobočky dané společnosti, ID tohoto prvku se následně použije při filtraci inzerátů (volání `jobs` s parametrem `office_id`).  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->enumsOfficesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsOfficesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\EnumsOfficesGet200Response**](../Model/EnumsOfficesGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsRejectReasonsGet()`

```php
enumsRejectReasonsGet(): \App\Module\RecruitisApi\Model\EnumsRejectReasonsGet200Response
```

Get Reject reasons

Vypíše všechny důvody zamítnutí.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->enumsRejectReasonsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsRejectReasonsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\EnumsRejectReasonsGet200Response**](../Model/EnumsRejectReasonsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsSourcesGet()`

```php
enumsSourcesGet(): \App\Module\RecruitisApi\Model\EnumsSourcesGet200Response
```

Get Company sources

Vrátí veškeré zdroje a jejich ID. Zdroje mohou být definovány jak samotným systémem, tak i přidány manuálně, firmou.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->enumsSourcesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsSourcesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\EnumsSourcesGet200Response**](../Model/EnumsSourcesGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `enumsWorkfieldsGet()`

```php
enumsWorkfieldsGet($channel_assignation, $lang): \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200Response
```

Get Workfields

Pokud je zadaný parametr `channel_assignation[]`, je vyžadována autorizace. V opačném případě není vyžadována žádná autorizace.  ### Bez parametru `channel_assignation[]`: * Získá všechny naše profese a obory včetně jejich ID.  #### Requirements * Není potřeba žádná autorizace  ---  ### S parametrem `channel_assignation[]`: * Získá všechny profese, které jsou obsaženy v inzerátech dané společnosti. Někdy nemusí sedět počet (`count`) oborů při  součtu `count` podřadných profesí. Je to tím, že mohou mít inzeráty návaznost pouze na obor, nikoliv i na profesi.  *Pro upřesnění: Profese jsou podmnožinou jednotlivých oborů.*  #### Requirements * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.enums.read`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\EnumerationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$channel_assignation = array(56); // int[]
$lang = cs; // string | Jazyk, ve kterém se mají obory vrátit (momentálně je podporována pouze čeština).

try {
    $result = $apiInstance->enumsWorkfieldsGet($channel_assignation, $lang);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EnumerationsApi->enumsWorkfieldsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **channel_assignation** | [**int[]**](../Model/int.md)|  | [optional] |
| **lang** | **string**| Jazyk, ve kterém se mají obory vrátit (momentálně je podporována pouze čeština). | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200Response**](../Model/EnumsWorkfieldsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
