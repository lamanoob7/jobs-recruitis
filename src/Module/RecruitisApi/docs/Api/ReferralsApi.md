# App\Module\RecruitisApi\ReferralsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**referralsGet()**](ReferralsApi.md#referralsGet) | **GET** /referrals | Get referral list |
| [**referralsIdGet()**](ReferralsApi.md#referralsIdGet) | **GET** /referrals/{id} | Get referral |
| [**referralsPost()**](ReferralsApi.md#referralsPost) | **POST** /referrals | Create new referal |


## `referralsGet()`

```php
referralsGet($id, $limit, $page, $search): \App\Module\RecruitisApi\Model\ReferralsGet200Response
```

Get referral list

Zavolání vrátí veškeré referraly přidružené k dané firmě. Na výpis se vztahuje stránkovač, kde maximum entit na jednu stránku je 100. V případě, že neodpovídá filtru žádný referral (nebo firma žádného referrala nemá), systém vrací header status `200` s `meta.code` `api.response.null`.  Momentálně je možné i přímo explicitně určit, v jakém parametru chcete vyhledávat. Pro tento způsob můžete mít search v JSON formátu, kde název parametru je totožný s referral parametrem.  Možné varianty: * {\"external_id\" : \"9D96W3-66D2\"} * {\"external_id\" : \"9D96W3-66D2\",\"name\":\"Pepa\",\"email\":\"xx@xxx.com} (external_id = 9D96W3-66D2 OR name = Pepa OR email = xx....) * {\"phone\" : \"+420773631234\"} * \"pavel novak\" - vyhledává všude.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.referral.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\ReferralsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = array('id_example'); // string[] | ID referrala, popř. `access_id` referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral `access_id`.
$limit = 10; // int | Maximální počet entit, které má server vrátit. Maximální limit je 100.
$page = 1; // int | Strana s entitami.
$search = new \App\Module\RecruitisApi\Model\OneOfStringObject(); // OneOfStringObject | Vrátí referraly s daným jménem, popř. emailem.

try {
    $result = $apiInstance->referralsGet($id, $limit, $page, $search);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReferralsApi->referralsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**string[]**](../Model/string.md)| ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. | [optional] |
| **limit** | **int**| Maximální počet entit, které má server vrátit. Maximální limit je 100. | [optional] [default to 10] |
| **page** | **int**| Strana s entitami. | [optional] [default to 1] |
| **search** | [**OneOfStringObject**](../Model/.md)| Vrátí referraly s daným jménem, popř. emailem. | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\ReferralsGet200Response**](../Model/ReferralsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `referralsIdGet()`

```php
referralsIdGet($id): \App\Module\RecruitisApi\Model\ReferralsIdGet200Response
```

Get referral

Vrátí konkrétního referrala. Pokud je zadáno jedno ID a není zadáno jako pole v GET parametrech, poté se vrátí jako jedna entita, tzn. payload nebude obsahovat pole. V případě, že daný referral neexistuje, vrací se `404` odpověď.   #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.referral.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\ReferralsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string

try {
    $result = $apiInstance->referralsIdGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReferralsApi->referralsIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\ReferralsIdGet200Response**](../Model/ReferralsIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `referralsPost()`

```php
referralsPost($referrals_post_request): \App\Module\RecruitisApi\Model\ReferralsPost201Response
```

Create new referal

Procedura na uložení nového referrala. Jako odpověď se vrátí ID referrala.  V případě, že daný referral již existuje, server vrací header status `409`.  #### Důležitá informace: **Při testování POST požadavku na produkčním serveru: Základní token míří na testovací účet, ke kterému mají přístup i ostatní uživatelé.  Neposílejte tedy své osobní údaje přes tento token, popřípadě si token změňte na svůj vlastní.**  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.referral.write`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\ReferralsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$referrals_post_request = new \App\Module\RecruitisApi\Model\ReferralsPostRequest(); // \App\Module\RecruitisApi\Model\ReferralsPostRequest

try {
    $result = $apiInstance->referralsPost($referrals_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReferralsApi->referralsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **referrals_post_request** | [**\App\Module\RecruitisApi\Model\ReferralsPostRequest**](../Model/ReferralsPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\ReferralsPost201Response**](../Model/ReferralsPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
