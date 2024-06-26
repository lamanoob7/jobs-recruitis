# RecruitisApi\CustomFieldsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**customfieldsUserUserIdAnswerIdGet()**](CustomFieldsApi.md#customfieldsUserUserIdAnswerIdGet) | **GET** /customfields/user/{user_id}/{answer_id} | Get custom fields for user, relating to position |
| [**customfieldsUserUserIdGet()**](CustomFieldsApi.md#customfieldsUserUserIdGet) | **GET** /customfields/user/{user_id} | Get custom fields for user, not relating to position |


## `customfieldsUserUserIdAnswerIdGet()`

```php
customfieldsUserUserIdAnswerIdGet($user_id, $answer_id): \RecruitisApi\Model\CustomfieldsUserUserIdGet200Response
```

Get custom fields for user, relating to position

Volání vrací všechna vlastní pole kandidáta na konkrétní pozici  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CustomFieldsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int
$answer_id = 56; // int

try {
    $result = $apiInstance->customfieldsUserUserIdAnswerIdGet($user_id, $answer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CustomFieldsApi->customfieldsUserUserIdAnswerIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **int**|  | |
| **answer_id** | **int**|  | |

### Return type

[**\RecruitisApi\Model\CustomfieldsUserUserIdGet200Response**](../Model/CustomfieldsUserUserIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `customfieldsUserUserIdGet()`

```php
customfieldsUserUserIdGet($user_id): \RecruitisApi\Model\CustomfieldsUserUserIdGet200Response
```

Get custom fields for user, not relating to position

Volání vrací všechna vlastní pole kandidáta, tato vlastní pole se nevztahují k pozici  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CustomFieldsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 56; // int

try {
    $result = $apiInstance->customfieldsUserUserIdGet($user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CustomFieldsApi->customfieldsUserUserIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **int**|  | |

### Return type

[**\RecruitisApi\Model\CustomfieldsUserUserIdGet200Response**](../Model/CustomfieldsUserUserIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
