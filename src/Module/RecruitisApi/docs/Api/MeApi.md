# App\Module\RecruitisApi\MeApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**meGet()**](MeApi.md#meGet) | **GET** /me | Get my information |


## `meGet()`

```php
meGet(): \App\Module\RecruitisApi\Model\MeGet200Response
```

Get my information

Získání informací o právě přihlášeném účtu.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.device.read`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\MeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->meGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MeApi->meGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\MeGet200Response**](../Model/MeGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
