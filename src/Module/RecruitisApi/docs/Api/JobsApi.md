# App\Module\RecruitisApi\JobsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**jobsGet()**](JobsApi.md#jobsGet) | **GET** /jobs | Get all jobs |
| [**jobsIdAccessPut()**](JobsApi.md#jobsIdAccessPut) | **PUT** /jobs/{id}/access | Add new visit count |
| [**jobsIdAccessStateStatePut()**](JobsApi.md#jobsIdAccessStateStatePut) | **PUT** /jobs/{id}/access_state/{state} | Change job access state |
| [**jobsIdChannelChannelIdDelete()**](JobsApi.md#jobsIdChannelChannelIdDelete) | **DELETE** /jobs/{id}/channel/{channel_id} | Unpublish job |
| [**jobsIdChannelChannelIdPut()**](JobsApi.md#jobsIdChannelChannelIdPut) | **PUT** /jobs/{id}/channel/{channel_id} | Publish job |
| [**jobsIdChannelsGet()**](JobsApi.md#jobsIdChannelsGet) | **GET** /jobs/{id}/channels | Show list of channels |
| [**jobsIdCommunicationGet()**](JobsApi.md#jobsIdCommunicationGet) | **GET** /jobs/{id}/communication | List communication with candidates |
| [**jobsIdFormGet()**](JobsApi.md#jobsIdFormGet) | **GET** /jobs/{id}/form | Load a job answer form |
| [**jobsIdFormValidatePost()**](JobsApi.md#jobsIdFormValidatePost) | **POST** /jobs/{id}/form/validate | Validate a job answer form |
| [**jobsIdGet()**](JobsApi.md#jobsIdGet) | **GET** /jobs/{id} | Get job detail |
| [**jobsIdRecommendApplicantPost()**](JobsApi.md#jobsIdRecommendApplicantPost) | **POST** /jobs/{id}/recommend/applicant | Create candidate recommendation |
| [**jobsPost()**](JobsApi.md#jobsPost) | **POST** /jobs | Create new job |


## `jobsGet()`

```php
jobsGet($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to): \App\Module\RecruitisApi\Model\JobsGet200Response
```

Get all jobs

Získání všech inzerátů. Ty se dají filtrovat podle oborů (profesí), filtrů a distribučních kanálů.   Pokud se nevrátí žádné inzeráty, vrátí se http status `200` s meta code `api.response.null`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.read`. * Starý typ tokenů:     * Token typ: `public_access`: pokud se jedná o veřejný inzerát (vystavený na firemních stránkách, xml nebo na pracovních portálech) - (určení dle channel_id).     * Token typ: `full_access`: pokud se jedná o interní inzerát. (určení dle channel_id).  Tip: Pokud chcete filtrovat podle adres, můžete inzeráty v Recruitisu přiřadit ke konkrétním pobočkám a pak filtrovat podle nich (u poboček vracíme adresy, pod jednou adresou můžete uvést i více poboček).  #### Parametr activity_state  Parametr filtruje pozice podle toho, jestli jsou aktivní nebo neaktivní. Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.).  | Parameter        | Value | Note                                                          | |------------------|-------|---------------------------------------------------------------| | Aktivní pozice   | 1     | Pozice, která se nachází alespoň v jednom publikačním kanále. | | Neaktivní pozice | 2     | Pozice, která se nenchází v žádném publikačním kanále.        |   #### Parametr access_state  Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state **nelze** jednotlivé hodnoty kombinovat.  | Parameter          | Value | Note                                                                                                                                                                                                                                                | |--------------------|-------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------| | Otevřená pozice    | 1     | Otevřená pozice se nachází alespoň v jednom publikačním kanálu. Lze do ní přidávat odpovědi a jako jediná nepotřebuje `full_access` token.                                                                                                          | | Uzavřená pozice    | 2     | Uzavřená pozice se nenachází v žádném publikačním kanálu a lze do ní přidávat odpovědi.                                                                                                                                                             | | Archivovaná pozice | 3     | Archivovaná pozice (dříve smazaná) je pozice určená ke znovu otevření, popř. úplnému smazání. Nepřijímá nové odpovědi a neumožňuje editaci svávajících. Při Archivaci dochází k odosobnění uchazečů bez GDPR souhlasu. Vrací pouze seznam ID pozic. | | Draft              | 4     | Rozepsaná pozice právě přihlášeného personalisty.                                                                                                                                                                                                   | | Šablona            | 5     | Pozice určená jako šablona. Může být buď právě přihlášeného personalisty nebo celé firmy.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 10; // int | Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek.
$page = 1; // int | Aktuální stránka.
$with_automation = 56; // int | V případě with_automation=1 se vypíše ve výsledku volání také nové pole automations
$text_language = 'text_language_example'; // string | Parametr filtruje pozice podle jazyku.
$workfield_id = array(56); // int[] | Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get).
$office_id = array(56); // int[] | Filtrace podle ID poboček.
$filter_id = array(56); // int[] | Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get).
$channel_id = array(56); // int[] | Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu).
$order_by = 'date_created'; // string | Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned).
$include_inactive = false; // bool | Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1.
$only_deleted = false; // bool | Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]).
$status = 1; // int | Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 = aktivní, 2 = neaktivní, 4 = draft, 8 = smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně.
$activity_state = 1; // int | Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.).
$access_state = 56; // int | Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat.
$with_rewards = 56; // int | Zobrazí inzeráty, na které se váže refferal odměna.
$updated_from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss
$updated_to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss

try {
    $result = $apiInstance->jobsGet($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. | [optional] [default to 10] |
| **page** | **int**| Aktuální stránka. | [optional] [default to 1] |
| **with_automation** | **int**| V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations | [optional] |
| **text_language** | **string**| Parametr filtruje pozice podle jazyku. | [optional] |
| **workfield_id** | [**int[]**](../Model/int.md)| Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). | [optional] |
| **office_id** | [**int[]**](../Model/int.md)| Filtrace podle ID poboček. | [optional] |
| **filter_id** | [**int[]**](../Model/int.md)| Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). | [optional] |
| **channel_id** | [**int[]**](../Model/int.md)| Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). | [optional] |
| **order_by** | **string**| Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). | [optional] [default to &#39;date_created&#39;] |
| **include_inactive** | **bool**| Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. | [optional] [default to false] |
| **only_deleted** | **bool**| Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). | [optional] [default to false] |
| **status** | **int**| Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. | [optional] [default to 1] |
| **activity_state** | **int**| Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). | [optional] [default to 1] |
| **access_state** | **int**| Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. | [optional] |
| **with_rewards** | **int**| Zobrazí inzeráty, na které se váže refferal odměna. | [optional] |
| **updated_from** | **\DateTime**| Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss | [optional] |
| **updated_to** | **\DateTime**| Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsGet200Response**](../Model/JobsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdAccessPut()`

```php
jobsIdAccessPut($id, $jobs_id_access_put_request): \App\Module\RecruitisApi\Model\JobsIdAccessPut200Response
```

Add new visit count

Endpoint připočítá nové zobrazení inzerátu. Díky tomu Recruitis může vědět, kolikrát se zobrazil inzerát například na vašich intranetových stránkách.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:     * Token typ: `public_access`, `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$jobs_id_access_put_request = new \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest(); // \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest

try {
    $result = $apiInstance->jobsIdAccessPut($id, $jobs_id_access_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdAccessPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **jobs_id_access_put_request** | [**\App\Module\RecruitisApi\Model\JobsIdAccessPutRequest**](../Model/JobsIdAccessPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response**](../Model/JobsIdAccessPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdAccessStateStatePut()`

```php
jobsIdAccessStateStatePut($id, $state): \App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response
```

Change job access state

Změna přístupu k pozici. Jedná se o uzavírání, otevírání a archivaci pozic. Více je popsáno v parametru [access_state](#parametr-access_state).  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:   * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:   * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 363098; // int
$state = 56; // int

try {
    $result = $apiInstance->jobsIdAccessStateStatePut($id, $state);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdAccessStateStatePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **state** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response**](../Model/JobsIdAccessStateStatePut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdChannelChannelIdDelete()`

```php
jobsIdChannelChannelIdDelete($id, $channel_id): \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response
```

Unpublish job

Stažení inzerátu z prezentačního kanálu.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:   * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:   * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 363098; // int
$channel_id = new \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutChannelIdParameter(); // JobsIdChannelChannelIdPutChannelIdParameter

try {
    $result = $apiInstance->jobsIdChannelChannelIdDelete($id, $channel_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdChannelChannelIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **channel_id** | [**JobsIdChannelChannelIdPutChannelIdParameter**](../Model/.md)|  | |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response**](../Model/JobsIdChannelChannelIdDelete202Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdChannelChannelIdPut()`

```php
jobsIdChannelChannelIdPut($id, $channel_id, $jobs_id_channel_channel_id_put_request): \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response
```

Publish job

Vystavení aktivního inzerátu na nějakém z prezentačních kanálů. V případě, že je inzerát na daném kanálu již vystaven, bude nastavení aktualizováno.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:   * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:   * Token typ: `full_access`: pro publikaci inzerátu je potřeba full access

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 363098; // int
$channel_id = new \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutChannelIdParameter(); // JobsIdChannelChannelIdPutChannelIdParameter
$jobs_id_channel_channel_id_put_request = new \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest(); // \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest

try {
    $result = $apiInstance->jobsIdChannelChannelIdPut($id, $channel_id, $jobs_id_channel_channel_id_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdChannelChannelIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **channel_id** | [**JobsIdChannelChannelIdPutChannelIdParameter**](../Model/.md)|  | |
| **jobs_id_channel_channel_id_put_request** | [**\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest**](../Model/JobsIdChannelChannelIdPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response**](../Model/JobsIdChannelChannelIdPut202Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdChannelsGet()`

```php
jobsIdChannelsGet($id): \App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response
```

Show list of channels

Zobrazení všech kanálů, kde je inzerát publikován.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $result = $apiInstance->jobsIdChannelsGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdChannelsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response**](../Model/JobsIdChannelsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdCommunicationGet()`

```php
jobsIdCommunicationGet($id): \App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response
```

List communication with candidates

Výpis komunikace s kandidáty na konkrétní pozici.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:     * Token typ:  `public_access`,`full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $result = $apiInstance->jobsIdCommunicationGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdCommunicationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response**](../Model/JobsIdCommunicationGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdFormGet()`

```php
jobsIdFormGet($id): \App\Module\RecruitisApi\Model\JobsIdFormGet200Response
```

Load a job answer form

Načtení odpovědního formuláře pro inzerát.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $result = $apiInstance->jobsIdFormGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdFormGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdFormGet200Response**](../Model/JobsIdFormGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdFormValidatePost()`

```php
jobsIdFormValidatePost($id, $accept_language, $jobs_id_form_validate_post_request): \App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response
```

Validate a job answer form

Validace odpovědního formuláře.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$accept_language = 'accept_language_example'; // string
$jobs_id_form_validate_post_request = new \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest(); // \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest | Hodnoty z odpovědního formuláře ve formátu pole => hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu.

try {
    $result = $apiInstance->jobsIdFormValidatePost($id, $accept_language, $jobs_id_form_validate_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdFormValidatePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **accept_language** | **string**|  | [optional] |
| **jobs_id_form_validate_post_request** | [**\App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest**](../Model/JobsIdFormValidatePostRequest.md)| Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response**](../Model/JobsIdFormValidatePost200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdGet()`

```php
jobsIdGet($id, $with_automation, $activity_state, $access_state): \App\Module\RecruitisApi\Model\JobsIdGet200Response
```

Get job detail

Vrátí detail jednoho inzerátu. Parametry v odpovědi jsou stejné, jako když se vrací více inzerátů najednou. Je nutné počítat s tím, že se jednotlivé argumenty mohou vrátit i jako null namísto stringu, objektu.  Pokud daný inzerát neexistuje, vrátí se http status `404` s meta code `api.error.not_found`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.read`. * Starý typ tokenů:     * Token typ: `public_access`: pokud se jedná o veřejný inzerát (vystavený na firemních stránkách, xml nebo na pracovních portálech).     * Token typ: `full_access`: pokud se jedná o interní inzerát.  #### Atribut active  Atribut `active` ve výpisu inzerátů značí, jestli je daný inzerát aktivní, to jest, že je právě v tuto chvíli někde publikován a zároveň není pozastaven.    * V případě, že je určen filtrační parametr `channel_id`, pak atribut `active` říká, jestli je inzerát aktivní v daném publikačním kanálu. * Pokud je ve filtračním parametru `channel_id` více kanálů, pak je atribut `active` = true ve chvíli, kdy je alespoň v jednom z daných publikačních kanálů aktivní. * Pokud filtrační parametr `channel_id` *není* určen, poté atribut `active` říká, jestli je inzerát aktivní alespoň v jednom ze všech publikáčních kanálů (tzn: je *kdekoli* právě vystaven.).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$with_automation = 56; // int | V případě with_automation=1 se vypíše ve výsledku volání také nové pole automations
$activity_state = 56; // int
$access_state = 56; // int

try {
    $result = $apiInstance->jobsIdGet($id, $with_automation, $activity_state, $access_state);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **with_automation** | **int**| V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations | [optional] |
| **activity_state** | **int**|  | [optional] |
| **access_state** | **int**|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdGet200Response**](../Model/JobsIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsIdRecommendApplicantPost()`

```php
jobsIdRecommendApplicantPost($id, $jobs_id_recommend_applicant_post_request): \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response
```

Create candidate recommendation

Tento endpoint vytvoří doporučení kandidáta na danou pozici. Kandidátovi poté přijde email s potvrzením, zda má o pozici opravdu zájem.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.write`. * Starý typ tokenů:     * Token typ: `public_access`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$jobs_id_recommend_applicant_post_request = new \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest(); // \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest

try {
    $result = $apiInstance->jobsIdRecommendApplicantPost($id, $jobs_id_recommend_applicant_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsIdRecommendApplicantPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **jobs_id_recommend_applicant_post_request** | [**\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest**](../Model/JobsIdRecommendApplicantPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response**](../Model/JobsIdRecommendApplicantPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `jobsPost()`

```php
jobsPost($jobs_post_request): \App\Module\RecruitisApi\Model\JobsPost201Response
```

Create new job

Procedura vytvoří nový inzerát a dá ho do rozepsaných. Následně je možné inzerát dokončit přímo v systému Recruitis. Při správném vytvoření se vrátí i odkaz na jeho dokončení.  #### Důležitá informace:  **Při testování POST požadavku na produkčním serveru: Základní token míří na testovací účet, ke kterému mají přístup i ostatní uživatelé.  Neposílejte tedy své osobní údaje přes tento token, popřípadě si token změňte na svůj vlastní.**  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.position.write`. * Starý typ tokenů:     * Token typ: `full_access`: pro vytvoření inzerátu potřebujeme vždy full access.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\JobsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$jobs_post_request = new \App\Module\RecruitisApi\Model\JobsPostRequest(); // \App\Module\RecruitisApi\Model\JobsPostRequest

try {
    $result = $apiInstance->jobsPost($jobs_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobsApi->jobsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **jobs_post_request** | [**\App\Module\RecruitisApi\Model\JobsPostRequest**](../Model/JobsPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\JobsPost201Response**](../Model/JobsPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
