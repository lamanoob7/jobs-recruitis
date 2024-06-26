# App\Module\RecruitisApi\CalendarApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**calendarInterviewsAnswerIdGet()**](CalendarApi.md#calendarInterviewsAnswerIdGet) | **GET** /calendar/interviews/{answer_id} | Get meetings |
| [**calendarReservationLinksGet()**](CalendarApi.md#calendarReservationLinksGet) | **GET** /calendar/reservation-links | Get reservation links |
| [**calendarReservationLinksIdDelete()**](CalendarApi.md#calendarReservationLinksIdDelete) | **DELETE** /calendar/reservation-links/{id} | Delete reservation link |
| [**calendarReservationLinksPost()**](CalendarApi.md#calendarReservationLinksPost) | **POST** /calendar/reservation-links | Share reservation link to candidate |


## `calendarInterviewsAnswerIdGet()`

```php
calendarInterviewsAnswerIdGet($answer_id): \App\Module\RecruitisApi\Model\CalendarInterviewsAnswerIdGet200Response
```

Get meetings

Tento dotaz vrací naplánované schůzky pro danou odpověď.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CalendarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int

try {
    $result = $apiInstance->calendarInterviewsAnswerIdGet($answer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CalendarApi->calendarInterviewsAnswerIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\CalendarInterviewsAnswerIdGet200Response**](../Model/CalendarInterviewsAnswerIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `calendarReservationLinksGet()`

```php
calendarReservationLinksGet(): \App\Module\RecruitisApi\Model\CalendarReservationLinksGet200Response
```

Get reservation links

Tento dotaz vrací všechny dostupné šablony rezervačních odkazů.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CalendarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->calendarReservationLinksGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CalendarApi->calendarReservationLinksGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\Module\RecruitisApi\Model\CalendarReservationLinksGet200Response**](../Model/CalendarReservationLinksGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `calendarReservationLinksIdDelete()`

```php
calendarReservationLinksIdDelete($id): \App\Module\RecruitisApi\Model\CalendarReservationLinksIdDelete200Response
```

Delete reservation link

Toto volání smaže rezervační odkaz pouze v případě, že dotaz `GET /calendar/interviews/{answer_id}` vrátí k požadovanému `id` (dílčí atribut `id` v atributu `reservation_link`) `\"event\": null`, v opačném případě server vrátí `409 Conflict`.  Rezervační odkaz lze smazat pouze v případě, že je přihlášený uživatel vlastníkem tohoto odkazu.  #### Requirements  * Volání musí být s autorizačním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CalendarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 101; // int

try {
    $result = $apiInstance->calendarReservationLinksIdDelete($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CalendarApi->calendarReservationLinksIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

### Return type

[**\App\Module\RecruitisApi\Model\CalendarReservationLinksIdDelete200Response**](../Model/CalendarReservationLinksIdDelete200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `calendarReservationLinksPost()`

```php
calendarReservationLinksPost($calendar_reservation_links_post_request): \App\Module\RecruitisApi\Model\CalendarReservationLinksPost201Response
```

Share reservation link to candidate

Toto volání sdílí kandidátovi rezervační odkaz na schůzku.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = App\Module\RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new App\Module\RecruitisApi\Api\CalendarApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$calendar_reservation_links_post_request = new \App\Module\RecruitisApi\Model\CalendarReservationLinksPostRequest(); // \App\Module\RecruitisApi\Model\CalendarReservationLinksPostRequest

try {
    $result = $apiInstance->calendarReservationLinksPost($calendar_reservation_links_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CalendarApi->calendarReservationLinksPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **calendar_reservation_links_post_request** | [**\App\Module\RecruitisApi\Model\CalendarReservationLinksPostRequest**](../Model/CalendarReservationLinksPostRequest.md)|  | [optional] |

### Return type

[**\App\Module\RecruitisApi\Model\CalendarReservationLinksPost201Response**](../Model/CalendarReservationLinksPost201Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
