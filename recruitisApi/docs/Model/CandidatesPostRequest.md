# # CandidatesPostRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** |  |
**email** | **string** | Uchazeči se dle emailu slučují. | [optional]
**skype** | **string** |  | [optional]
**linkedin** | **string** |  | [optional]
**facebook** | **string** |  | [optional]
**twitter** | **string** |  | [optional]
**phone** | **string** | Uchazeči se dle telefonu slučují. | [optional]
**strict** | **bool** | Pokud je uvedena hodnotou &#39;1&#39;, poté se při nezdaru nahrávání přílohy zastaví celý proces a vrátí se chyba.     V opačném případě se uchazeč nahraje s informací,     že ne všechno se nahrálo správně (viz [Meta - additional output](#meta-informace----additional_output)). | [optional] [default to false]
**im_author** | **bool** | Pokud je true, potom je daný personalista určen jako autor odpovědi, včetně poznámek. V opačném případě nebudou mít poznámky žádného autora a budou tzv. systémové. | [optional] [default to false]
**gdpr_agreement** | [**\RecruitisApi\Model\GDPR**](GDPR.md) |  |
**extra** | [**\RecruitisApi\Model\ExtraInner[]**](ExtraInner.md) | Pole objektů, které přiřadí k odpovědi poznámku nebo tag. | [optional]
**attachments** | [**\RecruitisApi\Model\AttachmentsInner[]**](AttachmentsInner.md) | Velikost souboru nesmí přesáhnout 4MB.  #### Všechny typy příloh naleznete v sekci [\&quot;Dodatečný popis API volání - Typy příloh\&quot;](#typy-příloh-attachment-type) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
