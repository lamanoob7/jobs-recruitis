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
**fte** | [**\App\Module\RecruitisApi\Model\JobFte**](JobFte.md) |  | [optional]
**workfields** | [**\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]**](EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md) |  | [optional]
**filterlist** | [**\App\Module\RecruitisApi\Model\JobFilterlistInner[]**](JobFilterlistInner.md) |  | [optional]
**education** | [**\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]**](EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md) |  | [optional]
**disability** | **bool** |  | [optional]
**details** | [**\App\Module\RecruitisApi\Model\JobDetails**](JobDetails.md) |  | [optional]
**personalist** | [**\App\Module\RecruitisApi\Model\JobPersonalist**](JobPersonalist.md) |  | [optional]
**contact** | [**\App\Module\RecruitisApi\Model\Contact**](Contact.md) |  | [optional]
**sharing** | [**\App\Module\RecruitisApi\Model\Employee[]**](Employee.md) |  | [optional]
**addresses** | [**\App\Module\RecruitisApi\Model\Address[]**](Address.md) |  | [optional]
**employment** | [**\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]**](EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md) | Typ pracovního úvazku. | [optional]
**stats** | [**\App\Module\RecruitisApi\Model\JobStats**](JobStats.md) |  | [optional]
**salary** | [**\App\Module\RecruitisApi\Model\JobSalary**](JobSalary.md) |  | [optional]
**channels** | [**\App\Module\RecruitisApi\Model\JobChannels**](JobChannels.md) |  | [optional]
**edit_link** | **string** |  | [optional]
**public_link** | **string** |  | [optional]
**referrals** | [**\App\Module\RecruitisApi\Model\JobReferralsInner[]**](JobReferralsInner.md) |  | [optional]
**automations** | [**\App\Module\RecruitisApi\Model\Automation[]**](Automation.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
