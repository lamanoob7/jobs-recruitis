# RecruitisApi\ReportApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**reportsGet()**](ReportApi.md#reportsGet) | **GET** /reports | Export data |


## `reportsGet()`

```php
reportsGet($version, $lists, $date_from, $date_to): \RecruitisApi\Model\ReportsGet200Response
```

Export data

Výpis dat ze systému, alternativa k exportu reportů do Excelu - data jsou ve stejném formátu. Tato API se hodí při využívání jiných reportovacích systému, například Keboola. Pozor: Při použití velkého datumového rozmezí může dotaz trvat velmi dlouho. **Doporučujeme pro urychlení reportu využít filtraci konkrétních listů.**  Popis jednotlivých listů, viz `lists` parametr:  - **answers**: Obsahuje všechny odpovědi vzniklé v daném časovém rozmezí.  - **jobs**: Obsahuje všechny otevřené inzeráty v daném časovém rozmezí. - **timeline**: Vrací chronologicky řazené záznamy podle jednotlivých uchazečů v daném časovém rozmezí. - **offices**: Vrátí seznam všech poboček. Na tuto sekci se nevztahuje parametr `date_from` a `date_to`. - **personalists**: Vrátí seznam všech personalistů. Na tuto sekci se nevztahuje parametr `date_from` a `date_to`. - **personalists-answers**: Tato sekce vypisuje všechny odpovědi a personalisty, kteří k nim mají přístup. - **custom-fields**: Tato sekce vypisuje všechna vlastní pole. V případě, že je `AnswerID: null`, se jedná o vlastní pole ke kandidátovi.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.reports.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\ReportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$version = 56; // int | Verze reportu, dle číselníku, aktuálně pouze '1'.
$lists = array('lists_example'); // string[] | Filtrace jednotlivých skupin exportů: answers, jobs, offices, personalists-answers, personalists, timeline, custom-fields. V případě, že není určeno, zvolí se všechny skupiny.
$date_from = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Datum, od kdy se mají exportovat data. Pokud nebude vyplněno, použije se aktuální den.
$date_to = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Datum, do kdy se mají exportovat data. Pokud nebude vyplněno, použije se aktuální den.

try {
    $result = $apiInstance->reportsGet($version, $lists, $date_from, $date_to);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReportApi->reportsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **version** | **int**| Verze reportu, dle číselníku, aktuálně pouze &#39;1&#39;. | |
| **lists** | [**string[]**](../Model/string.md)| Filtrace jednotlivých skupin exportů: answers, jobs, offices, personalists-answers, personalists, timeline, custom-fields. V případě, že není určeno, zvolí se všechny skupiny. | [optional] |
| **date_from** | **\DateTime**| Datum, od kdy se mají exportovat data. Pokud nebude vyplněno, použije se aktuální den. | [optional] |
| **date_to** | **\DateTime**| Datum, do kdy se mají exportovat data. Pokud nebude vyplněno, použije se aktuální den. | [optional] |

### Return type

[**\RecruitisApi\Model\ReportsGet200Response**](../Model/ReportsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
