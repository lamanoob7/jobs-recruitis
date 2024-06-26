# # AnswersGet200ResponseOneOf1PayloadInner

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**candidate_id** | **int** | ID kandidáta, ke kterému se odpověď vztahuje. | [optional]
**answer_id** | **int** | ID odpovědi. | [optional]
**name** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerName**](AnswersGet200ResponseOneOf1PayloadInnerName.md) |  | [optional]
**salutation** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSalutation**](AnswersGet200ResponseOneOf1PayloadInnerSalutation.md) |  | [optional]
**title** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerTitle**](AnswersGet200ResponseOneOf1PayloadInnerTitle.md) |  | [optional]
**gender** | **string** | Pohlaví kandidáta - M / F. | [optional]
**user_img** | **string** | Cesta k obrázku uchazeče. | [optional]
**rating** | **int** | Hodnocení uživatele, 0-5. | [optional]
**ratings** | **object[]** |  | [optional]
**phone** | **string** |  | [optional]
**email** | **string** |  | [optional]
**flow_id** | **int** | ID flow, ve které se odpověď zrovna nachází. | [optional]
**share_status** | **int** | Pokud je odpověď zrecyklovaná (zkopírovaná z jiného inzerátu), čekáme na odpověď uchazeče. NULL - není odpověď, 1 - Uchazeč odpověď schválil, 0 - Uchazeč odpověd zamítl. | [optional]
**share_status_detail** | **string** | Důvod zamítnutí zrecyklované odpovědi. | [optional]
**rejected** | **bool** | Značí, jestli je odpověď zamítnutá. | [optional]
**reject_reason** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner[]**](AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner.md) |  | [optional]
**job_details** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerJobDetails**](AnswersGet200ResponseOneOf1PayloadInnerJobDetails.md) |  | [optional]
**answer_created** | **\DateTime** | Datum vytvoření odpovědi, ve formátu YYYY-mm-dd HH:mm:ss | [optional]
**source** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSource**](AnswersGet200ResponseOneOf1PayloadInnerSource.md) |  | [optional]
**attachment_list** | [**\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner[]**](AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
