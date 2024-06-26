# RecruitisApi\JobFiltersApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**filtersGet()**](JobFiltersApi.md#filtersGet) | **GET** /filters | Get filters |
| [**filtersIdDelete()**](JobFiltersApi.md#filtersIdDelete) | **DELETE** /filters/{id} | Delete existing filter |
| [**filtersIdPut()**](JobFiltersApi.md#filtersIdPut) | **PUT** /filters/{id} | Update existing filter |
| [**filtersPost()**](JobFiltersApi.md#filtersPost) | **POST** /filters | Create new filter |


## `filtersGet()`

```php
filtersGet($group): \RecruitisApi\Model\FiltersGet200Response
```

Get filters

Získá všechny naše profese a obory včetně jejich ID.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.filters.read`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\JobFiltersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$group = array('group_example'); // string[] | Vyfiltruje pouze seznam filtrů k dané skupině.

try {
    $result = $apiInstance->filtersGet($group);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobFiltersApi->filtersGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **group** | [**string[]**](../Model/string.md)| Vyfiltruje pouze seznam filtrů k dané skupině. | [optional] |

### Return type

[**\RecruitisApi\Model\FiltersGet200Response**](../Model/FiltersGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `filtersIdDelete()`

```php
filtersIdDelete($id): \RecruitisApi\Model\FiltersIdDelete200Response
```

Delete existing filter

Smaže filtr dle ID.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.filters.write`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\JobFiltersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $result = $apiInstance->filtersIdDelete($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobFiltersApi->filtersIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\RecruitisApi\Model\FiltersIdDelete200Response**](../Model/FiltersIdDelete200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `filtersIdPut()`

```php
filtersIdPut($id, $filters_post_request): \RecruitisApi\Model\FiltersIdPut201Response
```

Update existing filter

Editace filtru dle ID v parametru URI.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.filters.write`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\JobFiltersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$filters_post_request = new \RecruitisApi\Model\FiltersPostRequest(); // \RecruitisApi\Model\FiltersPostRequest

try {
    $result = $apiInstance->filtersIdPut($id, $filters_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobFiltersApi->filtersIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **filters_post_request** | [**\RecruitisApi\Model\FiltersPostRequest**](../Model/FiltersPostRequest.md)|  | [optional] |

### Return type

[**\RecruitisApi\Model\FiltersIdPut201Response**](../Model/FiltersIdPut201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `filtersPost()`

```php
filtersPost($filters_post_request): \RecruitisApi\Model\FiltersPost201Response
```

Create new filter

Vytvoření nového filtru.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem. * Nový typ tokenů:     * Token musí mít oprávnění `api.filters.write`. * Starý typ tokenů:     * Token typ: `public_access`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\JobFiltersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$filters_post_request = new \RecruitisApi\Model\FiltersPostRequest(); // \RecruitisApi\Model\FiltersPostRequest

try {
    $result = $apiInstance->filtersPost($filters_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling JobFiltersApi->filtersPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **filters_post_request** | [**\RecruitisApi\Model\FiltersPostRequest**](../Model/FiltersPostRequest.md)|  | [optional] |

### Return type

[**\RecruitisApi\Model\FiltersPost201Response**](../Model/FiltersPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
