# # CandidatesIdCommunicationPostRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**employee_id** | **int** | ID uživatele, který zprávu posílá. |
**author_id** | **int** | ID uživatele, vyplňte, pokud je autor jiný uživatel, než ten, který zprávu posílá. Pokud nevyplněno, použije se &#x60;employee_id&#x60;. | [optional]
**sender** | **string** | Textová podoba odesílatele (jméno, email, telefonní číslo (SMS)), pokud nebude vyplněno, použijí se data vázaná na &#x60;author_id&#x60;. | [optional]
**sender_type** | **string** | Říká, od koho pochází daná komunikace. Přípustné hodnoty: candidate, employee, system, other |
**recipient** | **string** | viz. parametr &#x60;sender&#x60; | [optional]
**subject** | **string** | Předmět zprávy. |
**content** | **string** | Obsah zprávy. |
**direction** | **string** | Jedna z hodnot: in &#x3D; příchozí, out &#x3D; odchozí, váže se ke kandidátovi/odpovědi.     Tj. příchozí ke kandidátovi a odchozí od kandidáta. |
**date_action** | **\DateTime** | Datum vytvoření komunikace. | [optional]
**type** | **string** |  |
**strict** | **bool** | Určuje chování uploadu při chybě, pokud 1, tak se uloží vše, nebo nic. Pokud 0, v meta tagu budou informace o neuložených přílohách. | [optional] [default to true]
**attachments** | [**\App\Module\RecruitisApi\Model\AttachmentsInner[]**](AttachmentsInner.md) | Velikost souboru nesmí přesáhnout 4MB.  #### Všechny typy příloh naleznete v sekci [\&quot;Dodatečný popis API volání - Typy příloh\&quot;](#typy-příloh-attachment-type) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
