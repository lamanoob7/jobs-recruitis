# # AnswersAnswerIdGet200ResponsePayload

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**candidate_id** | **int** | ID kandidáta, ke kterému se odpověď vztahuje. | [optional]
**answer_id** | **int** | ID odpovědi. | [optional]
**job_id** | **int** | ID inzerátu. | [optional]
**name** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerName**](AnswersGet200ResponseOneOf1PayloadInnerName.md) |  | [optional]
**title** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerTitle**](AnswersGet200ResponseOneOf1PayloadInnerTitle.md) |  | [optional]
**user_img** | **string** | Cesta k obrázku uchazeče. | [optional]
**rating** | **int** | Hodnocení uživatele, 0-5. | [optional]
**ratings** | **object[]** |  | [optional]
**sign_job** | [**\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadSignJob**](AnswersAnswerIdGet200ResponsePayloadSignJob.md) |  | [optional]
**source_site** | **string** |  | [optional]
**phone** | **string** |  | [optional]
**email** | **string** |  | [optional]
**flow_id** | **int** | ID flow, ve které se odpověď zrovna nachází. | [optional]
**share_status** | **int** | Pokud je odpověď zrecyklovaná (zkopírovaná z jiného inzerátu), čekáme na odpověď uchazeče. NULL - není odpověď, 1 - Uchazeč odpověď schválil, 0 - Uchazeč odpověd zamítl. | [optional]
**share_status_detail** | **string** | Důvod zamítnutí zrecyklované odpovědi. | [optional]
**rejected** | **bool** | Značí, jestli je odpověď zamítnutá. | [optional]
**reject_reason** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner[]**](AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner.md) |  | [optional]
**answer_created** | **\DateTime** | Datum vytvoření odpovědi, ve formátu YYYY-mm-dd HH:mm:ss | [optional]
**additional_details** | [**\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner[]**](AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner.md) |  | [optional]
**flow_history** | [**\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner[]**](AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner.md) | Toto pole se zobrazuje jen pokud je parametr view&#x3D;\&quot;extended\&quot; | [optional]
**interview_date** | **\DateTime** |  | [optional]
**date_response** | **\DateTime** |  | [optional]
**requirements** | [**\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadRequirements**](AnswersAnswerIdGet200ResponsePayloadRequirements.md) |  | [optional]
**job_details** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerJobDetails**](AnswersGet200ResponseOneOf1PayloadInnerJobDetails.md) |  | [optional]
**source** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSource**](AnswersGet200ResponseOneOf1PayloadInnerSource.md) |  | [optional]
**attachment_list** | [**\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner[]**](AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner.md) |  | [optional]
**cover_letter** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
