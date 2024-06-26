# App\Module\RecruitisApi\AuthenticationApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**loginPut()**](AuthenticationApi.md#loginPut) | **PUT** /login | Log in |
| [**logoutPut()**](AuthenticationApi.md#logoutPut) | **PUT** /logout | Log out |


## `loginPut()`

```php
loginPut($login_put_request): \App\Module\RecruitisApi\Model\LoginPut200Response
```

Log in

Endpoint pro vygenerování Bearer tokenu uživateli. Defaultní odpověď je 200.  - `device_id` je ID vygenerováno firebase službou od Google inc. Pokud systém obdrží tento parametr, umožní přes tento login posílat SMS zprávy a systém počítá s tím, že se jedná o mobilní aplikaci. - `device_name` je pouze označení daného api spojení. Pod tímto názvem ho pak uživatel uvidí v Recruitisu. Jednou, jak se device_name zapíše, nelze přes API volání změnit.  Tato funkce není třeba volat, pokud již máte Token vygenerovaný. **Tato funkce vrací token s vlastností `full_access`.**  #### Requirements  * Není potřeba žádná autorizace.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new App\Module\RecruitisApi\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login_put_request = new \App\Module\RecruitisApi\Model\LoginPutRequest(); // \App\Module\RecruitisApi\Model\LoginPutRequest

try {
    $result = $apiInstance->loginPut($login_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->loginPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **login_put_request** | [**\App\Module\RecruitisApi\Model\LoginPutRequest**](../Model/LoginPutRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\LoginPut200Response**](../Model/LoginPut200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `logoutPut()`

```php
logoutPut(): \App\Module\RecruitisApi\Model\LogoutPut200Response
```

Log out

Toto volání pošle aktuálně používaný token a uvede ho do stavu `disabled=1`. Další volání s tímto tokenem budou vracet chybu, až do opětovného přihlášení.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access`, `public_access` * Nepodporuje nový typ tokenu.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->logoutPut();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->logoutPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\LogoutPut200Response**](../Model/LogoutPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
