# # JobsIdFormGet200ResponsePayload

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**label** | **string** |  | [optional]
**attributes** | [**\RecruitisApi\Model\JobsIdFormGet200ResponsePayloadAttributesInner[]**](JobsIdFormGet200ResponsePayloadAttributesInner.md) | Pole HTML atributů, zatím vždy prázdné. | [optional]
**fields** | [**\RecruitisApi\Model\JobsIdFormGet200ResponsePayloadFieldsInner[]**](JobsIdFormGet200ResponsePayloadFieldsInner.md) | Pole HTML inputů pro formulář. | [optional]
**gdpr** | [**\RecruitisApi\Model\JobsIdFormGet200ResponsePayloadGdprInner[]**](JobsIdFormGet200ResponsePayloadGdprInner.md) | Pole GDPR souhlasů.  Type &#x3D; 1 je informační povinnost, takový souhlas je nutné uchazeči vykreslit, ideálně na začátku formuláře. Type &#x3D; 2 musí být vykresleny jako checkboxy a odesílány k validaci. Atribut \&quot;text_short\&quot; doporučujeme vykreslit jako label checkboxu, \&quot;text_long\&quot; můžete sbalovat/rozbalovat. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
