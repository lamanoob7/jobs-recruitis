# # AnswersPostRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**job_id** | **int** |  |
**name** | **string** |  |
**email** | **string** | Uchazeči se dle emailu slučují. | [optional]
**skype** | **string** | Odkaz na Skype uchazeče. | [optional]
**linkedin** | **string** | Odkaz na LinkedIn uchazeče. | [optional]
**facebook** | **string** | Odkaz na Facebook uchazeče. | [optional]
**twitter** | **string** | Odkaz na Twitter uchazeče. | [optional]
**phone** | **string** | Uchazeči se dle telefonu slučují. | [optional]
**source_id** | **int** | Zdroj, odkud odpověď přišla. Více v [Enumerations - Company sources](#tag/Enumerations/paths/~1enums~1sources/get). | [optional] [default to -1]
**source** | **string** | String. Zdroj odpovědi, který se automaticky vytvoří (tudíž není potřeba znát jeho ID.) Pokud zdroj již existuje, přiřadí se k existujícímu. Tato položka je ignorována, pokud je udána hodnota &#x60;source_id&#x60;. | [optional]
**refferal_id** | **int** | ID referrala (ID získané z Recruitis referral stránky, API pro referraly je v plánu). | [optional]
**cover_letter** | **string** | Průvodní dopis. | [optional]
**salary** | [**\RecruitisApi\Model\AnswersPostRequestSalary**](AnswersPostRequestSalary.md) |  | [optional]
**gdpr_agreement** | [**\RecruitisApi\Model\GDPR**](GDPR.md) |  | [optional]
**extra** | [**\RecruitisApi\Model\ExtraInner[]**](ExtraInner.md) | Pole objektů, které přiřadí k odpovědi poznámku nebo tag. | [optional]
**attachments** | [**\RecruitisApi\Model\AttachmentsInner[]**](AttachmentsInner.md) | Velikost souboru nesmí přesáhnout 4MB.  #### Všechny typy příloh naleznete v sekci [\&quot;Dodatečný popis API volání - Typy příloh\&quot;](#typy-příloh-attachment-type) | [optional]
**send_notification** | **bool** | Pokud je zapnuto, při přidání nové odpovědi se pošle zpráva o novém kandidátovi na všechny přidružené emailové adresy. | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
