# App\Module\RecruitisApi\CandidatesApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**activityFeedGet()**](CandidatesApi.md#activityFeedGet) | **GET** /activity_feed | List candidate activity feed |
| [**answersAnswerIdExportPut()**](CandidatesApi.md#answersAnswerIdExportPut) | **PUT** /answers/{answer_id}/export | Export answer |
| [**answersAnswerIdExtraGet()**](CandidatesApi.md#answersAnswerIdExtraGet) | **GET** /answers/{answer_id}/extra | Get candidate&#39;s answer tags |
| [**answersAnswerIdExtraPut()**](CandidatesApi.md#answersAnswerIdExtraPut) | **PUT** /answers/{answer_id}/extra | Update candidate&#39;s answer tags |
| [**answersAnswerIdGet()**](CandidatesApi.md#answersAnswerIdGet) | **GET** /answers/{answer_id} | Get answer |
| [**answersAnswerIdInterviewsNotesGet()**](CandidatesApi.md#answersAnswerIdInterviewsNotesGet) | **GET** /answers/{answer_id}/interviews/notes | Get all interviews, related to answer |
| [**answersGet()**](CandidatesApi.md#answersGet) | **GET** /answers | Get all answers |
| [**answersPost()**](CandidatesApi.md#answersPost) | **POST** /answers | Create new answer |
| [**candidatesFormIdGet()**](CandidatesApi.md#candidatesFormIdGet) | **GET** /candidates/form/{id} | Load a landing page |
| [**candidatesIdAnswerIdCommunicationGet()**](CandidatesApi.md#candidatesIdAnswerIdCommunicationGet) | **GET** /candidates/{id}/{answer_id}/communication | List candidate communication |
| [**candidatesIdAnswerIdCommunicationPost()**](CandidatesApi.md#candidatesIdAnswerIdCommunicationPost) | **POST** /candidates/{id}/{answer_id}/communication | Create new communication record |
| [**candidatesIdCommunicationGet()**](CandidatesApi.md#candidatesIdCommunicationGet) | **GET** /candidates/{id}/communication | List candidate communication |
| [**candidatesIdCommunicationPost()**](CandidatesApi.md#candidatesIdCommunicationPost) | **POST** /candidates/{id}/communication | Create new communication record |
| [**candidatesIdDelete()**](CandidatesApi.md#candidatesIdDelete) | **DELETE** /candidates/{id} | Delete candidate |
| [**candidatesPost()**](CandidatesApi.md#candidatesPost) | **POST** /candidates | Create new candidate |
| [**candidatesUserIdExtraGet()**](CandidatesApi.md#candidatesUserIdExtraGet) | **GET** /candidates/{user_id}/extra | Get candidate tags |
| [**candidatesUserIdExtraPut()**](CandidatesApi.md#candidatesUserIdExtraPut) | **PUT** /candidates/{user_id}/extra | Update candidate tags |


## `activityFeedGet()`

```php
activityFeedGet($user_id, $filter, $lang): \App\Module\RecruitisApi\Model\ActivityFeedGet200Response
```

List candidate activity feed

Výpis historie akcí kandidáta.  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int | Jedná se o ID kandidáta.
$filter = all; // string
$lang = cs; // string

try {
    $result = $apiInstance->activityFeedGet($user_id, $filter, $lang);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->activityFeedGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **int**| Jedná se o ID kandidáta. | |
| **filter** | **string**|  | [optional] |
| **lang** | **string**|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\ActivityFeedGet200Response**](../Model/ActivityFeedGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersAnswerIdExportPut()`

```php
answersAnswerIdExportPut($answer_id, $answers_answer_id_export_put_request): \App\Module\RecruitisApi\Model\AnswersAnswerIdExportPut200Response
```

Export answer

Označí odpověď v Recruitisu jako exportovanou. Nemá pevně daný číselník. Tato funkcionalita není určená pro normální použití. Pro detailnější popis nás kontaktujte.  #### Důležitá informace: Hodnota `status` nemá pevně daný číselník, každá společnost si jej definuje sama na své straně.  Pro definici hodnot pooužijte bitmasku.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.write`. * Původní typ tokenů:     * Token typ: `full_access`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int
$answers_answer_id_export_put_request = new \App\Module\RecruitisApi\Model\AnswersAnswerIdExportPutRequest(); // \App\Module\RecruitisApi\Model\AnswersAnswerIdExportPutRequest

try {
    $result = $apiInstance->answersAnswerIdExportPut($answer_id, $answers_answer_id_export_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersAnswerIdExportPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |
| **answers_answer_id_export_put_request** | [**\App\Module\RecruitisApi\Model\AnswersAnswerIdExportPutRequest**](../Model/AnswersAnswerIdExportPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdExportPut200Response**](../Model/AnswersAnswerIdExportPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersAnswerIdExtraGet()`

```php
answersAnswerIdExtraGet($answer_id): \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response
```

Get candidate's answer tags

Výpis štítků, které jsou vázané na odpověď.  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int

try {
    $result = $apiInstance->answersAnswerIdExtraGet($answer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersAnswerIdExtraGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response**](../Model/AnswersAnswerIdExtraGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersAnswerIdExtraPut()`

```php
answersAnswerIdExtraPut($answer_id, $answers_answer_id_extra_put_request): \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response
```

Update candidate's answer tags

Aktualizace štítků, které jsou vázané na odpověď.  ### Pozor!  Všechny doposud uložené štítky jsou zavoláním tohoto endpointu přemazány!  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem. * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int
$answers_answer_id_extra_put_request = new \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest(); // \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest

try {
    $result = $apiInstance->answersAnswerIdExtraPut($answer_id, $answers_answer_id_extra_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersAnswerIdExtraPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |
| **answers_answer_id_extra_put_request** | [**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest**](../Model/AnswersAnswerIdExtraPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response**](../Model/AnswersAnswerIdExtraPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersAnswerIdGet()`

```php
answersAnswerIdGet($answer_id, $view): \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200Response
```

Get answer

Tento dotaz vrací konkrétní odpověď. Oproti seznamu odpovědí není payload pole, ale rovnou kokrétní objekt odpovědi s nepatrně jinou strukturou (detailnější). Pokud dotaz nenajde konkrétní odpověď, vrací se http status `404` s meta code `api.error.not_found`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Původní typ tokenů:     * Token typ: `full_access`: Práce s výpisem odpovědí vyžaduje `full_access` token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int
$view = 'basic'; // string

try {
    $result = $apiInstance->answersAnswerIdGet($answer_id, $view);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersAnswerIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |
| **view** | **string**|  | [optional] [default to &#39;basic&#39;] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdGet200Response**](../Model/AnswersAnswerIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersAnswerIdInterviewsNotesGet()`

```php
answersAnswerIdInterviewsNotesGet($answer_id): \App\Module\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response
```

Get all interviews, related to answer

Toto volání vrátí všechny pohovory k odpovědi  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Původní typ tokenů:     * Token typ: `public_access`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int

try {
    $result = $apiInstance->answersAnswerIdInterviewsNotesGet($answer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersAnswerIdInterviewsNotesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response**](../Model/AnswersAnswerIdInterviewsNotesGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersGet()`

```php
answersGet($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported): \App\Module\RecruitisApi\Model\AnswersGet200Response
```

Get all answers

Tento dotaz vrací seznam všech **NEZAMÍTNUTÝCH** odpovědí. Dají se filtrovat dle konkrétních inzerátů, flow, a nebo aplikovat vyhledávání dle jména uchazeče.  Pokud dotaz nenajde žádné odpovídající odpovědi, vrací se http status `200` s meta code `api.response.null`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Původní typ tokenů:     * Token typ: `full_access`: Práce s výpisem odpovědí vyžaduje `full_access` token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 10; // int | Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek.
$page = 1; // int | Aktuální stránka.
$job_id = 56; // int | Filtrování odpovědí dle ID inzerátů.
$flow_id = 56; // int | Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je `flow_id = -1`.
$search = 56; // int | Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get).
$date_from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Datum ve formátu \"YYYY-MM-DD\". Omezení, od jakého data (včetně) se odpovědi vypíšou.
$date_to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Datum ve formátu \"YYYY-MM-DD\". Omezení, do jakého data (včetně) se odpovědi vypíšou.
$order = 'date_created'; // string
$exported = 56; // int

try {
    $result = $apiInstance->answersGet($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. | [optional] [default to 10] |
| **page** | **int**| Aktuální stránka. | [optional] [default to 1] |
| **job_id** | **int**| Filtrování odpovědí dle ID inzerátů. | [optional] |
| **flow_id** | **int**| Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. | [optional] |
| **search** | **int**| Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). | [optional] |
| **date_from** | **\DateTime**| Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. | [optional] |
| **date_to** | **\DateTime**| Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. | [optional] |
| **order** | **string**|  | [optional] [default to &#39;date_created&#39;] |
| **exported** | **int**|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersGet200Response**](../Model/AnswersGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `answersPost()`

```php
answersPost($answers_post_request): \App\Module\RecruitisApi\Model\AnswersPost201Response
```

Create new answer

Procedura na uložení nové odpovědi. Jako odpověď se vrátí ID odpovědi. Při vytváření odpovědi se vytvoří i nový uchazeč, pokud již s danými kontakty (email, telefon) neexistuje. V druhém případě se přiřadí k již existujícímu.  Poznámka: Souhlas se zpracováním osobních údajů dostává takto vytvořená odpověď automaticky. Její platnost je v základním nastavení 1 rok. Pokud byste si přáli toto nastavení změnit, kontaktujte nás.   #### Důležitá informace: **Při testování POST požadavku na produkčním serveru: Základní token míří na testovací účet, ke kterému mají přístup i ostatní uživatelé.  Neposílejte tedy své osobní údaje přes tento token, popřípadě si token změňte na svůj vlastní.**  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.write`. * Původní typ tokenů:     * Token typ: `public_access`: pokud se jedná o veřejný inzerát (vystaven na firemních stránkách, xml nebo na pracovních portálech).     * Token typ: `full_access`: pokud se jedná o interní inzerát. * Kompatibilní s firemním tokenem.  **GDPR a souhlas se zpracováním osobních údajů k dané pozici:** Pokud není určen GDPR souhlas, tak souhlas se zpracováním os. údajů dostává uchazeč k dané pozici vždy automaticky na rok, popř. do skončení pozice. Jako zdroj souhlasu se uvádí \"api\".  Pokud GDPR souhlas určen je, tak souhlas se zpracováním os. údajů dědí jeho zdroj a také datum expirace (maximálně ale na rok).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answers_post_request = new \App\Module\RecruitisApi\Model\AnswersPostRequest(); // \App\Module\RecruitisApi\Model\AnswersPostRequest

try {
    $result = $apiInstance->answersPost($answers_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->answersPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answers_post_request** | [**\App\Module\RecruitisApi\Model\AnswersPostRequest**](../Model/AnswersPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersPost201Response**](../Model/AnswersPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesFormIdGet()`

```php
candidatesFormIdGet($id): \App\Module\RecruitisApi\Model\CandidatesFormIdGet200Response
```

Load a landing page

Načtení landing page. Landing page slouží pro sběr kandidátů do talentpoolu.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = c4ca4238a0b923820dcc509a6f75849c; // int | 32 znaků dlouhý hash

try {
    $result = $apiInstance->candidatesFormIdGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesFormIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**| 32 znaků dlouhý hash | |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesFormIdGet200Response**](../Model/CandidatesFormIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesIdAnswerIdCommunicationGet()`

```php
candidatesIdAnswerIdCommunicationGet($id, $answer_id, $type, $sender_type, $limit, $page, $author_id): \App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response
```

List candidate communication

Výpis komunikace s kandidátem. Vypíše komunikaci vázanou na danou odpověď.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$answer_id = 56; // int
$type = 'type_example'; // string
$sender_type = 'sender_type_example'; // string
$limit = 10; // int
$page = 1; // int
$author_id = 56; // int

try {
    $result = $apiInstance->candidatesIdAnswerIdCommunicationGet($id, $answer_id, $type, $sender_type, $limit, $page, $author_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesIdAnswerIdCommunicationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **answer_id** | **int**|  | |
| **type** | **string**|  | [optional] |
| **sender_type** | **string**|  | [optional] |
| **limit** | **int**|  | [optional] |
| **page** | **int**|  | [optional] |
| **author_id** | **int**|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response**](../Model/CandidatesIdAnswerIdCommunicationGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesIdAnswerIdCommunicationPost()`

```php
candidatesIdAnswerIdCommunicationPost($id, $answer_id, $candidates_id_answer_id_communication_post_request): \App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response
```

Create new communication record

Založení nového záznamu komunikace (zprávy) s klientem.   #### Requirements  * Volání musí být s autorizačním tokenem. * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$answer_id = 56; // int
$candidates_id_answer_id_communication_post_request = new \App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest(); // \App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest

try {
    $result = $apiInstance->candidatesIdAnswerIdCommunicationPost($id, $answer_id, $candidates_id_answer_id_communication_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesIdAnswerIdCommunicationPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **answer_id** | **int**|  | |
| **candidates_id_answer_id_communication_post_request** | [**\App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest**](../Model/CandidatesIdAnswerIdCommunicationPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response**](../Model/CandidatesIdAnswerIdCommunicationPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesIdCommunicationGet()`

```php
candidatesIdCommunicationGet($id, $type, $sender_type, $limit, $page, $author_id): \App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response
```

List candidate communication

Výpis komunikace s kandidátem. Vypíše komunikaci vázanou přímo na kandidáta.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$type = 'type_example'; // string
$sender_type = 'sender_type_example'; // string
$limit = 10; // int
$page = 1; // int
$author_id = 56; // int

try {
    $result = $apiInstance->candidatesIdCommunicationGet($id, $type, $sender_type, $limit, $page, $author_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesIdCommunicationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **type** | **string**|  | [optional] |
| **sender_type** | **string**|  | [optional] |
| **limit** | **int**|  | [optional] |
| **page** | **int**|  | [optional] |
| **author_id** | **int**|  | [optional] |

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

## `candidatesIdCommunicationPost()`

```php
candidatesIdCommunicationPost($id, $candidates_id_communication_post_request): \App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response
```

Create new communication record

Založení nového záznamu komunikace (zprávy) s klientem. Parametr `answer_id` funguje stejně jako u GET volání.  #### Requirements  * Volání musí být s autorizačním tokenem. * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$candidates_id_communication_post_request = new \App\Module\RecruitisApi\Model\CandidatesIdCommunicationPostRequest(); // \App\Module\RecruitisApi\Model\CandidatesIdCommunicationPostRequest

try {
    $result = $apiInstance->candidatesIdCommunicationPost($id, $candidates_id_communication_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesIdCommunicationPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **candidates_id_communication_post_request** | [**\App\Module\RecruitisApi\Model\CandidatesIdCommunicationPostRequest**](../Model/CandidatesIdCommunicationPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response**](../Model/CandidatesIdAnswerIdCommunicationPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesIdDelete()`

```php
candidatesIdDelete($id): \App\Module\RecruitisApi\Model\CandidatesIdDelete200Response
```

Delete candidate

Toto volání smaže kompletně daného uchazeče a všechny informace, které jsou k němu přidruženy.  Všechny jeho odpovědi, pohovory, poznámky, přílohy, GDPR souhlasy atd. **Takto smazaný uchazeč se již nedá jakkoli obnovit.**  Na toto volání se vztahuje denní kvóta. V případě překročení denní kvóty se vrátí odpověď `403 - forbidden` s `meta.code` `api.error.quota.exceeded`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.write`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $result = $apiInstance->candidatesIdDelete($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesIdDelete200Response**](../Model/CandidatesIdDelete200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesPost()`

```php
candidatesPost($candidates_post_request): \App\Module\RecruitisApi\Model\CandidatesPost201Response
```

Create new candidate

Procedura na uložení nového uchazeče. Jako odpověď se vrátí ID kandidáta.  Vytvoření kandidáta bez odpovědi se hodí například, pokud chcete nabídnout uchazeči možnost vás kontaktovat, ale nemáte pro něj momentálně vhodný inzerát.   Pokud se vkládá uchazeč, který dle emailu nebo telefonního čísla v systému již existuje, provede se aktualizace informací a vrátí se dané user ID. O všem jste informovaní přes meta položku `additional_output`.  #### Důležitá informace: **Při testování POST požadavku na produkčním serveru: Základní token míří na testovací účet, ke kterému mají přístup i ostatní uživatelé.  Neposílejte tedy své osobní údaje přes tento token, popřípadě si token změňte na svůj vlastní.**  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů: * Token musí mít oprávnění `api.candidates.write`. * Starý typ tokenů: * Token typ: `public_access`  #### GDPR u přidání uchazeče Při vytvoření uchazeče bez odpovědi (To jest například získání uchazeče přes sběrný formulář k uložení do databáze uchazečů.)  velmi doporučujeme přikládat GDPR souhlas. Recruitis Vám v opačném případě nedovolí s uchazečem pracovat, dokud souhlas nezískáte.  Jako parametr můžete vložit pouhý boolean, který při \"true\" vloží souhlas automaticky, popřípadě můžete vložit objekt, viz tabulka výše.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$candidates_post_request = new \App\Module\RecruitisApi\Model\CandidatesPostRequest(); // \App\Module\RecruitisApi\Model\CandidatesPostRequest

try {
    $result = $apiInstance->candidatesPost($candidates_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **candidates_post_request** | [**\App\Module\RecruitisApi\Model\CandidatesPostRequest**](../Model/CandidatesPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\CandidatesPost201Response**](../Model/CandidatesPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesUserIdExtraGet()`

```php
candidatesUserIdExtraGet($user_id): \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response
```

Get candidate tags

Výpis štítků, které jsou vázané na kandidáta.  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int

try {
    $result = $apiInstance->candidatesUserIdExtraGet($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesUserIdExtraGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response**](../Model/AnswersAnswerIdExtraGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `candidatesUserIdExtraPut()`

```php
candidatesUserIdExtraPut($user_id, $answers_answer_id_extra_put_request): \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response
```

Update candidate tags

Aktualizace štítků, které jsou vázané na kandidáta.  ### Pozor!  Všechny doposud uložené štítky jsou zavoláním tohoto endpointu přemazány!  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem. * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CandidatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int
$answers_answer_id_extra_put_request = new \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest(); // \App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest

try {
    $result = $apiInstance->candidatesUserIdExtraPut($user_id, $answers_answer_id_extra_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CandidatesApi->candidatesUserIdExtraPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **int**|  | |
| **answers_answer_id_extra_put_request** | [**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPutRequest**](../Model/AnswersAnswerIdExtraPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response**](../Model/AnswersAnswerIdExtraPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
