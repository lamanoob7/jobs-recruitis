# # Job

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**job_id** | **int** | ID inzerátu. | [optional]
**secured_id** | **string** |  | [optional]
**public_id** | **string** | Interní označení inzerátu. Nemusí být vyplněné | [optional]
**access_state** | **int** | Značení o jaký typ pozice se jedná. Viz. acces_state parametr | [optional]
**draft** | **bool** | Značí jestli je inzerát zveřejněný, nebo jen rozepsaný. | [optional]
**active** | **bool** | Atribut active ve výpisu inzerátů značí, jestli je daný inzerát aktivní, to jest, že je právě v tuto chvíli někde publikován a zároveň není pozastaven. | [optional]
**title** | **string** |  | [optional]
**description** | **string** |  | [optional]
**internal_note_** | **string** |  | [optional]
**date_end** | **\DateTime** | Nyní date_closed | [optional]
**date_closed** | **\DateTime** |  | [optional]
**closed_duration** | **int** | Počet sekund od uzavření. | [optional]
**last_update** | **\DateTime** | Datum, kdy byl inzerát naposledy upraven. Formát YYYY-mm-dd HH:mm:ss | [optional]
**date_created** | **\DateTime** | Formát YYYY-mm-dd HH:mm:ss | [optional]
**text_language** | **string** |  | [optional]
**fte** | [**\RecruitisApi\Model\JobFte**](JobFte.md) |  | [optional]
**workfields** | [**\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]**](EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md) |  | [optional]
**filterlist** | [**\RecruitisApi\Model\JobFilterlistInner[]**](JobFilterlistInner.md) |  | [optional]
**education** | [**\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner**](EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md) |  | [optional]
**disability** | **bool** |  | [optional]
**details** | [**\RecruitisApi\Model\JobDetails**](JobDetails.md) |  | [optional]
**personalist** | [**\RecruitisApi\Model\JobPersonalist**](JobPersonalist.md) |  | [optional]
**contact** | [**\RecruitisApi\Model\Contact**](Contact.md) |  | [optional]
**sharing** | [**\RecruitisApi\Model\Employee[]**](Employee.md) |  | [optional]
**addresses** | [**\RecruitisApi\Model\Address[]**](Address.md) |  | [optional]
**employment** | [**\RecruitisApi\Model\JobEmployment**](JobEmployment.md) |  | [optional]
**stats** | [**\RecruitisApi\Model\JobStats**](JobStats.md) |  | [optional]
**salary** | [**\RecruitisApi\Model\JobSalary**](JobSalary.md) |  | [optional]
**channels** | [**\RecruitisApi\Model\JobChannels**](JobChannels.md) |  | [optional]
**edit_link** | **string** |  | [optional]
**public_link** | **string** |  | [optional]
**referrals** | [**\RecruitisApi\Model\JobReferralsInner[]**](JobReferralsInner.md) |  | [optional]
**automations** | [**\RecruitisApi\Model\Automation[]**](Automation.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
