# RecruitisApi\TasksApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**tasksGet()**](TasksApi.md#tasksGet) | **GET** /tasks | Get all tasks assigned to user |


## `tasksGet()`

```php
tasksGet(): \RecruitisApi\Model\TasksGet200Response
```

Get all tasks assigned to user

Slouží k vypsání všech zpětných vazeb a pracovních nabídek k vyřízení, vázaných na zaměstnance. (Feedbacky a hiring_proposal úkoly.)  #### Requirements  * Volání musí být s autorizačním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->tasksGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\RecruitisApi\Model\TasksGet200Response**](../Model/TasksGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
