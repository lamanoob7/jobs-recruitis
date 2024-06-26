# RecruitisApi\ChecklistsApi

All URIs are relative to https://app.recruitis.io/api2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**answersAnswerIdChecklistsFlowIdGet()**](ChecklistsApi.md#answersAnswerIdChecklistsFlowIdGet) | **GET** /answers/{answer_id}/checklists/{flow_id} | List answer checklist |
| [**checklistsAnswerIdItemItemIdStatePut()**](ChecklistsApi.md#checklistsAnswerIdItemItemIdStatePut) | **PUT** /checklists/{answer_id}/item/{item_id}/state | Update item state |


## `answersAnswerIdChecklistsFlowIdGet()`

```php
answersAnswerIdChecklistsFlowIdGet($answer_id, $flow_id): \RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response
```

List answer checklist

Výpis checklistů kandidáta. Vypíše položky checklistů vázané na danou odpověď v konkrétním flow.  #### Requirements  * Volání musí být s autorizačním tokenem. * Kompatibilní s firemním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\ChecklistsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int
$flow_id = 56; // int

try {
    $result = $apiInstance->answersAnswerIdChecklistsFlowIdGet($answer_id, $flow_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecklistsApi->answersAnswerIdChecklistsFlowIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |
| **flow_id** | **int**|  | |

### Return type

[**\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response**](../Model/AnswersAnswerIdChecklistsFlowIdGet200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `checklistsAnswerIdItemItemIdStatePut()`

```php
checklistsAnswerIdItemItemIdStatePut($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request): \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response
```

Update item state

Změna stavu konkrétní položky checklistu u dané odpovědi. Parametr `flowId` v těle volání říká, ve kterém flow se stav změní. Pokud není vyplněný, použije se aktuální flow, ve kterém se odpověď nachází.  #### Requirements  * Volání musí být s autorizačním tokenem. * Není kompatibilní s firemním tokenem.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: auth
$config = RecruitisApi\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new RecruitisApi\Api\ChecklistsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$answer_id = 56; // int
$item_id = 56; // int
$checklists_answer_id_item_item_id_state_put_request = new \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest(); // \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest

try {
    $result = $apiInstance->checklistsAnswerIdItemItemIdStatePut($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChecklistsApi->checklistsAnswerIdItemItemIdStatePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **answer_id** | **int**|  | |
| **item_id** | **int**|  | |
| **checklists_answer_id_item_item_id_state_put_request** | [**\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest**](../Model/ChecklistsAnswerIdItemItemIdStatePutRequest.md)|  | [optional] |

### Return type

[**\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response**](../Model/ChecklistsAnswerIdItemItemIdStatePut200Response.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
