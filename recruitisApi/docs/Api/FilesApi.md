# RecruitisApi\FilesApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**filesHashGet()**](FilesApi.md#filesHashGet) | **GET** /files/{hash} | Download a file |


## `filesHashGet()`

```php
filesHashGet($hash): \RecruitisApi\Model\FilesHashGet200Response
```

Download a file

### Upozornění! **Z bezpečnostních důvodů při volání této funkce VŽDY kontrolujte, že daná URL adresa obsahuje doménu https://api.recruitis.io/api2/_**  Stahování souboru probíhá tak, že Vám API vrátí payload s base64 stringem, který si následně můžete překonvertovat do daného souboru. Daný hash nyní vrací funkce `GET /answers`, který vrací celou url adresu i s daným hashem (např.: \"https://api.recruitis.io/api2/files/YXdQMmRtWWprNXBTY042M1hFOTdvZz09\")   Pokud soubor neexistuje, nebo nepatří Vaší firmě, vrací se http status `404` s meta code `api.error.not_found`.  #### Requirements  * Volání musí být s autorizačním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.files.read`. * Starý typ tokenů:     * Token typ: `full_access`  **V případě dotázání více příloh, je potřeba, aby součet velikostí všech příloh byl menší než 30MB. Pokud je součet příloh větší, API vrátí http stav `413` s meta kódem `api.error.response.too_big`**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$hash = YXdQMmRtWWprNXBTY042M1hFOTdvZz09; // string[] | Hash je rozpoznávací string, díky kterému systém ví, jaký soubor vrátit.  Pokud je parametr `hash` zadán jako jednoparametrové pole, vrací se payload jako objekt. Jinak se payload vrací jako pole.

try {
    $result = $apiInstance->filesHashGet($hash);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->filesHashGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | [**string[]**](../Model/string.md)| Hash je rozpoznávací string, díky kterému systém ví, jaký soubor vrátit.  Pokud je parametr &#x60;hash&#x60; zadán jako jednoparametrové pole, vrací se payload jako objekt. Jinak se payload vrací jako pole. | |

### Return type

[**\RecruitisApi\Model\FilesHashGet200Response**](../Model/FilesHashGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
