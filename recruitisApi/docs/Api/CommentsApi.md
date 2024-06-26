# RecruitisApi\CommentsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**commentsDelete()**](CommentsApi.md#commentsDelete) | **DELETE** /comments | Delete comment |
| [**commentsGet()**](CommentsApi.md#commentsGet) | **GET** /comments | Get comments |
| [**commentsPost()**](CommentsApi.md#commentsPost) | **POST** /comments | Add comment |
| [**commentsPut()**](CommentsApi.md#commentsPut) | **PUT** /comments | Edit comment |


## `commentsDelete()`

```php
commentsDelete($id): \RecruitisApi\Model\CommentsDelete200Response
```

Delete comment

Volání vymaže poznámku.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CommentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | ID poznámky

try {
    $result = $apiInstance->commentsDelete($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommentsApi->commentsDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**| ID poznámky | |

### Return type

[**\RecruitisApi\Model\CommentsDelete200Response**](../Model/CommentsDelete200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `commentsGet()`

```php
commentsGet($field): \RecruitisApi\Model\CommentsGet200Response
```

Get comments

Volání vrací všechny poznámky.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CommentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$field = 'field_example'; // string

try {
    $result = $apiInstance->commentsGet($field);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommentsApi->commentsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **field** | **string**|  | |

### Return type

[**\RecruitisApi\Model\CommentsGet200Response**](../Model/CommentsGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `commentsPost()`

```php
commentsPost($comments_post_request): \RecruitisApi\Model\CommentsPost201Response
```

Add comment

Volání přidá poznámku.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CommentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$comments_post_request = new \RecruitisApi\Model\CommentsPostRequest(); // \RecruitisApi\Model\CommentsPostRequest

try {
    $result = $apiInstance->commentsPost($comments_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommentsApi->commentsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **comments_post_request** | [**\RecruitisApi\Model\CommentsPostRequest**](../Model/CommentsPostRequest.md)|  | [optional] |

### Return type

[**\RecruitisApi\Model\CommentsPost201Response**](../Model/CommentsPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `commentsPut()`

```php
commentsPut($comments_put_request): \RecruitisApi\Model\CommentsPut200Response
```

Edit comment

Volání přepíše již existující poznámku.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Token typ: `full_access` * Nový typ tokenů:     * Token musí mít oprávnění `api.candidates.read`. * Starý typ tokenů:     * Token typ: `full_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\CommentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$comments_put_request = new \RecruitisApi\Model\CommentsPutRequest(); // \RecruitisApi\Model\CommentsPutRequest

try {
    $result = $apiInstance->commentsPut($comments_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CommentsApi->commentsPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **comments_put_request** | [**\RecruitisApi\Model\CommentsPutRequest**](../Model/CommentsPutRequest.md)|  | [optional] |

### Return type

[**\RecruitisApi\Model\CommentsPut200Response**](../Model/CommentsPut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
