# OpenAPIClient-php

# API dokumentace pro systém Recruitis.io
Dokumentace je založena na autorizaci pomocí tokenu, který je vygenerován buď samotným systémem nebo uživatelem v systému Recruitis.

Postupem času budou přibývat jednotlivé funkcionality. Pokud by měla být narušena funkčnost jakéhokoli API volání,
bude založen nový branch (v2 atd.) nebo budete v dostatečném časovém odstupu o změně informováni.

### API url

Pro volání API využijte url: [https://app.recruitis.io/api2/](https://app.recruitis.io/api2/).

### Changelog

Všechny změny v dokumentaci jsou zaznamenány v [Changelogu](#tag/Changelog).

## Tokeny
Autorizační tokeny mají dvě skupiny po dvou úrovních

### Skupiny tokenů

#### Firemní tokeny

Tento typ tokenu má výhodu, že není limitován na konkrétní účet, tudíž nepřestane fungovat v případě smazání nebo deaktivování účtu.
Zároveň s ním ale nelze používat všechny API volání. (U každého API volání se dočtete, jestli podporuje firemní token.)
Nekteré volání potřebují znát přesného autora (Kvůli reportům například.) a ty bohužel nelze volat s tímto firemním tokenem.

#### Tokeny konkrétního účtu

Každý účet si může vytvořit v recruitisu vlastní token. Díky němu může používat všechna API volání, to jest i volání, 
která potřebují mít vazbu ke konkrétnímu účtu.

### Dále se tokeny rozlišují dle udělených práv:

+ `full_access`: Token, který má veškeré pravomoci a umožňuje upravovat data v systému dané firmy. Tento token nesmí být jakkoli zobrazen veřejnosti.
+ `public_access`: Token, který má převážně zobrazovací pravomoci. Tento token může být veřejnosti zobrazen. Například při použití Javascriptu.

Na oba druhy tokenů lze uplatnit doménový whitelist (toto nastavení doporučujeme použít).

Tokeny lze vytvořit po přihlášení v Recruitisu: [*nastavení* > *api propojení*](https://app.recruitis.io/zadavatel/nastaveni/obecne/view/api).

Samotná autorizace probíhá pomocí posláním headeru: `Authorization: Bearer <token>`

_Příklad:_ `Authorization: Bearer 30bcaf299e100318906fef2f442505216fa28af1.11196.99382ec77e2a79ac2af2671730817ec6`.

## Meta informace

Každá `response` má `meta` sekci, která dodává veškeré pomocné informace. Níže vypsané atributy **nemusí** vždy v meta sekci být a mohou být podmíněny 
okolnostmi volání (`entries_*` údaje se v meta sekci zobrazí jen při vrácení pole payloadu apod.).

| META parameter      | Note                                                                                    |
|---------------------|-----------------------------------------------------------------------------------------|
| `code`              | Kód výsledku. V případě chyby je to standardizované hlášení o chybě.                    |
| `message`           | Zpráva, která popisuje dané volání.                                                     |
| `duration`          | Uplynulá doba při zpracování požadavku.                                                 |
| `cached`            | Výsledek je cachován a nemusí být aktuální.                                             |
| `cached_from`       | Čas vygenerování vráceného výsledku.                                                    |
| `deprecated`        | Dané volání je označeno jako zastaralé a nemělo by se nadále používat.                  |
| `additional_output` | Viz samostatná sekce.                                                                   |
| `entries_from`      | Pokud se vrací pole, udává, od kterého elementu dané pole je (*určeno pro stránkovač*). |
| `entries_to`        | Pokud se vrací pole, udává, do kterého elementu dané pole je (*určeno pro stránkovač*). |
| `entries_total`     | Pokud se vrací pole, udává celkové množství elementů (*určeno pro stránkovač*).         |
| `entries_sum`       | Pokud se vrací pole, udává aktuální množství elementů (*určeno pro stránkovač*).        |

### Meta informace  - `additional_output`

Při nahrávání nových údajů (odpovědí, kandidátů) může nastat stav, kdy se daná entita nahraje s různými výjimkami 
(duplikace příloh, sjednocení uchazečů, gdpr zosobnění, vložení špatných příloh). V tom případě API zpětně informuje o všem, co se s danou 
entitou stalo, viz příklad níže. Zároveň se tento stav zaloguje u nás na serveru a je zpětně k dohledání.

```json
{
  \"additional_output\": [
    {
      \"message\": \"Candidate already exists. I'll use his user ID.\",
      \"status\": \"WARNING\",
      \"code\": \"candidate.put.exists.join\"
    },
    {
      \"message\": \"File cv.txt is already uploaded.\",
      \"status\": \"WARNING\",
      \"code\": \"candidate.put.attachment.duplicated\"
    },
    {
      \"message\": \"File logo.jpg is already uploaded.\",
      \"status\": \"WARNING\",
      \"code\": \"candidate.put.attachment.duplicated\"
    },
    {
      \"message\": \"File souhlas.pdf is already uploaded.\",
      \"status\": \"WARNING\",
      \"code\": \"candidate.put.attachment.duplicated\"
    }
  ]
}
```

## Popis response parametru code

Každá odpověď má parametr `code`. Zde je jejich výčet a jejich popis:

| CODE parameter                                   | Note
|:-------------------------------------------------|--------------------------------|
| `api.ok`                                         | Dotaz proběhl úspěšně. 
| `api.found`                                      | Dotaz našel výsledek a poslal zpět.
| `api.created`                                    | Dotaz vytvořil entitu.
| `api.deleted`                                    | Dotaz smazal entitu.
| `api.modified`                                   | Dotaz upravil entitu.
| `api.unmodified`                                 | Dotaz nic nového neprovedl, vrátil již existující entitu.
| `api.response.null`                              | Dotaz proběhl úspěšně, ale nebyl vrácen žádný výsledek. 
| `api.error.generic`                              | Obecná chyba. Nespecifikovatelná.
| `api.error.system.unavailable`                   | API systém je nedostupný.
| `api.error.request.wrong_format`                 | Špatný JSON formát requestu.
| `api.error.request.property.missing`             | V požadavku chybí vyžadovaná hodnota.
| `api.error.request.property.wrong_value`         | V požadavku nabývá proměnná špatnou hodnotu. 
| `api.error.request.property.wrong_text_length`   | Délka textu v konkrétním požadavku je větší než povolená hodnota.
| `api.error.request.property.maximum_array_items` | Počet prvků v poli je větší, než je povoleno.
| `api.error.not_found`                            | Dotaz směřuje na neexistující požadavek. 
| `api.error.unauthorized`                         | Dotaz vyžaduje přihlášení.
| `api.error.authorization.low_privileges`         | Dotaz vyžaduje přihlášení přes `full_access` token.
| `api.error.authorization.blocked`                | Přihlášení je na nějakou dobu zablokováno. Je možné, že se uživatel přihlašoval častěji špatnými údaji. 
| `api.error.authorization.wrong_token_format`     | Bearer token je špatného formátu.
| `api.error.authorization.token.doesnt_exists`    | Daný bearer token neexistuje. 
| `api.error.authorization.wrong_credentials`      | Vložené údaje jsou špatné, přihlášení se nezdařilo. 
| `api.error.authorization.bad_domain`             | API je voláno z nepovolené domény.
| `api.error.quota.exceeded`                       | Byl dosažen denní/minutový limit volání viz. samostatná sekce [Kvóty](#kvóty).
| `api.error.account.deleted`                      | Účet, na který se snažíte přihlásit, byl smazán. 
| `api.error.account.banned`                       | Účet, na který se snažíte přihlásit, byl zablokován (trvale). 
| `api.error.upload.generic`                       | Nastala chyba při uploadování přílohy. 
| `api.error.upload.size`                          | Příloha má více, než 3 MB.
| `api.error.upload.timeout`                       | Vypršela doba pro stáhnutí souboru z externího uložiště. Soubor není dostupný.
| `api.error.upload.bad_host`                      | Snažíte se uploadovat soubor, který neexistuje. 
| `api.error.upload.no_data`                       | Snažíte se uploadovat soubor, který neexistuje. 
| `api.error.user.already_answered`                | Daný uchazeč již na inzerát odpověděl.
| `api.error.response.too_big`                     | Odpověď je příliš velká.
| `api.error.export.bad_request`                   | Obecná chyba při exportu inzerátu do jiného systému.
| `api.error.referral.already_created`             | Daný referral byl již vytvořen.
| `api.error.job.disallowed_acess_type`            | Tento typ inzerátu nepřijímá žádné odpovědi, popř. nelze nijak upravovat.

## Dodatečný popis API volání

### Kvóty

Kvóty hlídají jednotlivé volání systému, monitorují jejich frekvenci a v případě jejich dosažení, je daný druh volání zakázán. 
V případě dosažení limitu se vrací hlavíčka `403 - forbidden` s `meta.code` `api.error.quota.exceeded`.

Kvóty se budou v průběhu času upravovat a optimalizovat. 

Zde je výčet jednotlivých kvót:


| Quota name                | Quota type | Max value | Note                                        |
|:--------------------------|------------|-----------|---------------------------------------------|
| `quota_candidates_delete` | daily      | 100       | Denní povolené množství smazaných uchazečů. |



### Parametry

Pokud je v dokumentaci označen parametr jako `array`, poté systém očekává, že se dostaví daný parametr v url adrese jako jedna hodnota (`foo=bar`)
nebo jako pole (`foo[]=bar&foo[]=baz`).

#### Query parametry

Query parametry se připojují na konec požadovaného volání ve formátu:

`?nazev_parametru1=hodnota1&nazev_parametru2=hodnota2`

například:

`?limit=25&page=2&job_id=30665&job_id=23982`

### Typy příloh (Attachment type)

Typy příloh se využívají při vytváření odpovědi, popřípadě kandidáta.

| Value  |  Note                             |
|:-------|-----------------------------------|
| `1`    | Příloha bez zaměření
| `2`    | CV příloha
| `3`    | Emailová korespondence (obsolete)
| `4`    | Fotografie
| `5`    | GDPR souhlas
| `6`    | Profilový obrázek

### Speciální typy tagů

Pokud místo svého znění tagu vložíte níže uvedený tag, má to hlubší vliv na fungování uchazeče, viz poznámka níže.

| Value        |  Note                             |
|:-------------|-----------------------------------|
| `tag.hot`    | Tento tag přidaný k uchazeči (přes přidání odpovědi / uchazeče) zaručí, že se kandidát zařadí do sekce \"žhavý kandidát\"  

### Vysvětlení hodnot jednotlivých parametrů

 **date** - Je string ve formátu YYYY-MM-DD (2018-01-30)

 **datetime** - Je string ve formátu YYYY-MM-DD HH:MM:SS (2018-01-30 12:59:59)



## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');




$apiInstance = new RecruitisApi\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login_put_request = new \RecruitisApi\Model\LoginPutRequest(); // \RecruitisApi\Model\LoginPutRequest

try {
    $result = $apiInstance->loginPut($login_put_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->loginPut: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://app.recruitis.io/api2*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AuthenticationApi* | [**loginPut**](docs/Api/AuthenticationApi.md#loginput) | **PUT** /login | Log in
*AuthenticationApi* | [**logoutPut**](docs/Api/AuthenticationApi.md#logoutput) | **PUT** /logout | Log out
*CalendarApi* | [**calendarInterviewsAnswerIdGet**](docs/Api/CalendarApi.md#calendarinterviewsansweridget) | **GET** /calendar/interviews/{answer_id} | Get meetings
*CalendarApi* | [**calendarReservationLinksGet**](docs/Api/CalendarApi.md#calendarreservationlinksget) | **GET** /calendar/reservation-links | Get reservation links
*CalendarApi* | [**calendarReservationLinksIdDelete**](docs/Api/CalendarApi.md#calendarreservationlinksiddelete) | **DELETE** /calendar/reservation-links/{id} | Delete reservation link
*CalendarApi* | [**calendarReservationLinksPost**](docs/Api/CalendarApi.md#calendarreservationlinkspost) | **POST** /calendar/reservation-links | Share reservation link to candidate
*CandidatesApi* | [**activityFeedGet**](docs/Api/CandidatesApi.md#activityfeedget) | **GET** /activity_feed | List candidate activity feed
*CandidatesApi* | [**answersAnswerIdExportPut**](docs/Api/CandidatesApi.md#answersansweridexportput) | **PUT** /answers/{answer_id}/export | Export answer
*CandidatesApi* | [**answersAnswerIdExtraGet**](docs/Api/CandidatesApi.md#answersansweridextraget) | **GET** /answers/{answer_id}/extra | Get candidate&#39;s answer tags
*CandidatesApi* | [**answersAnswerIdExtraPut**](docs/Api/CandidatesApi.md#answersansweridextraput) | **PUT** /answers/{answer_id}/extra | Update candidate&#39;s answer tags
*CandidatesApi* | [**answersAnswerIdGet**](docs/Api/CandidatesApi.md#answersansweridget) | **GET** /answers/{answer_id} | Get answer
*CandidatesApi* | [**answersAnswerIdInterviewsNotesGet**](docs/Api/CandidatesApi.md#answersansweridinterviewsnotesget) | **GET** /answers/{answer_id}/interviews/notes | Get all interviews, related to answer
*CandidatesApi* | [**answersGet**](docs/Api/CandidatesApi.md#answersget) | **GET** /answers | Get all answers
*CandidatesApi* | [**answersPost**](docs/Api/CandidatesApi.md#answerspost) | **POST** /answers | Create new answer
*CandidatesApi* | [**candidatesFormIdGet**](docs/Api/CandidatesApi.md#candidatesformidget) | **GET** /candidates/form/{id} | Load a landing page
*CandidatesApi* | [**candidatesIdAnswerIdCommunicationGet**](docs/Api/CandidatesApi.md#candidatesidansweridcommunicationget) | **GET** /candidates/{id}/{answer_id}/communication | List candidate communication
*CandidatesApi* | [**candidatesIdAnswerIdCommunicationPost**](docs/Api/CandidatesApi.md#candidatesidansweridcommunicationpost) | **POST** /candidates/{id}/{answer_id}/communication | Create new communication record
*CandidatesApi* | [**candidatesIdCommunicationGet**](docs/Api/CandidatesApi.md#candidatesidcommunicationget) | **GET** /candidates/{id}/communication | List candidate communication
*CandidatesApi* | [**candidatesIdCommunicationPost**](docs/Api/CandidatesApi.md#candidatesidcommunicationpost) | **POST** /candidates/{id}/communication | Create new communication record
*CandidatesApi* | [**candidatesIdDelete**](docs/Api/CandidatesApi.md#candidatesiddelete) | **DELETE** /candidates/{id} | Delete candidate
*CandidatesApi* | [**candidatesPost**](docs/Api/CandidatesApi.md#candidatespost) | **POST** /candidates | Create new candidate
*CandidatesApi* | [**candidatesUserIdExtraGet**](docs/Api/CandidatesApi.md#candidatesuseridextraget) | **GET** /candidates/{user_id}/extra | Get candidate tags
*CandidatesApi* | [**candidatesUserIdExtraPut**](docs/Api/CandidatesApi.md#candidatesuseridextraput) | **PUT** /candidates/{user_id}/extra | Update candidate tags
*ChecklistsApi* | [**answersAnswerIdChecklistsFlowIdGet**](docs/Api/ChecklistsApi.md#answersansweridchecklistsflowidget) | **GET** /answers/{answer_id}/checklists/{flow_id} | List answer checklist
*ChecklistsApi* | [**checklistsAnswerIdItemItemIdStatePut**](docs/Api/ChecklistsApi.md#checklistsansweriditemitemidstateput) | **PUT** /checklists/{answer_id}/item/{item_id}/state | Update item state
*CommentsApi* | [**commentsDelete**](docs/Api/CommentsApi.md#commentsdelete) | **DELETE** /comments | Delete comment
*CommentsApi* | [**commentsGet**](docs/Api/CommentsApi.md#commentsget) | **GET** /comments | Get comments
*CommentsApi* | [**commentsPost**](docs/Api/CommentsApi.md#commentspost) | **POST** /comments | Add comment
*CommentsApi* | [**commentsPut**](docs/Api/CommentsApi.md#commentsput) | **PUT** /comments | Edit comment
*CustomFieldsApi* | [**customfieldsUserUserIdAnswerIdGet**](docs/Api/CustomFieldsApi.md#customfieldsuseruseridansweridget) | **GET** /customfields/user/{user_id}/{answer_id} | Get custom fields for user, relating to position
*CustomFieldsApi* | [**customfieldsUserUserIdGet**](docs/Api/CustomFieldsApi.md#customfieldsuseruseridget) | **GET** /customfields/user/{user_id} | Get custom fields for user, not relating to position
*EnumerationsApi* | [**enumsChannelsGet**](docs/Api/EnumerationsApi.md#enumschannelsget) | **GET** /enums/channels | Get Company channels
*EnumerationsApi* | [**enumsEmploymentsGet**](docs/Api/EnumerationsApi.md#enumsemploymentsget) | **GET** /enums/employments | Get Employment list
*EnumerationsApi* | [**enumsFlowsGet**](docs/Api/EnumerationsApi.md#enumsflowsget) | **GET** /enums/flows | Get Flows
*EnumerationsApi* | [**enumsOfficesGet**](docs/Api/EnumerationsApi.md#enumsofficesget) | **GET** /enums/offices | Get Offices
*EnumerationsApi* | [**enumsRejectReasonsGet**](docs/Api/EnumerationsApi.md#enumsrejectreasonsget) | **GET** /enums/reject_reasons | Get Reject reasons
*EnumerationsApi* | [**enumsSourcesGet**](docs/Api/EnumerationsApi.md#enumssourcesget) | **GET** /enums/sources | Get Company sources
*EnumerationsApi* | [**enumsWorkfieldsGet**](docs/Api/EnumerationsApi.md#enumsworkfieldsget) | **GET** /enums/workfields | Get Workfields
*FilesApi* | [**filesHashGet**](docs/Api/FilesApi.md#fileshashget) | **GET** /files/{hash} | Download a file
*JobFiltersApi* | [**filtersGet**](docs/Api/JobFiltersApi.md#filtersget) | **GET** /filters | Get filters
*JobFiltersApi* | [**filtersIdDelete**](docs/Api/JobFiltersApi.md#filtersiddelete) | **DELETE** /filters/{id} | Delete existing filter
*JobFiltersApi* | [**filtersIdPut**](docs/Api/JobFiltersApi.md#filtersidput) | **PUT** /filters/{id} | Update existing filter
*JobFiltersApi* | [**filtersPost**](docs/Api/JobFiltersApi.md#filterspost) | **POST** /filters | Create new filter
*JobsApi* | [**jobsGet**](docs/Api/JobsApi.md#jobsget) | **GET** /jobs | Get all jobs
*JobsApi* | [**jobsIdAccessPut**](docs/Api/JobsApi.md#jobsidaccessput) | **PUT** /jobs/{id}/access | Add new visit count
*JobsApi* | [**jobsIdAccessStateStatePut**](docs/Api/JobsApi.md#jobsidaccessstatestateput) | **PUT** /jobs/{id}/access_state/{state} | Change job access state
*JobsApi* | [**jobsIdChannelChannelIdDelete**](docs/Api/JobsApi.md#jobsidchannelchanneliddelete) | **DELETE** /jobs/{id}/channel/{channel_id} | Unpublish job
*JobsApi* | [**jobsIdChannelChannelIdPut**](docs/Api/JobsApi.md#jobsidchannelchannelidput) | **PUT** /jobs/{id}/channel/{channel_id} | Publish job
*JobsApi* | [**jobsIdChannelsGet**](docs/Api/JobsApi.md#jobsidchannelsget) | **GET** /jobs/{id}/channels | Show list of channels
*JobsApi* | [**jobsIdCommunicationGet**](docs/Api/JobsApi.md#jobsidcommunicationget) | **GET** /jobs/{id}/communication | List communication with candidates
*JobsApi* | [**jobsIdFormGet**](docs/Api/JobsApi.md#jobsidformget) | **GET** /jobs/{id}/form | Load a job answer form
*JobsApi* | [**jobsIdFormValidatePost**](docs/Api/JobsApi.md#jobsidformvalidatepost) | **POST** /jobs/{id}/form/validate | Validate a job answer form
*JobsApi* | [**jobsIdGet**](docs/Api/JobsApi.md#jobsidget) | **GET** /jobs/{id} | Get job detail
*JobsApi* | [**jobsIdRecommendApplicantPost**](docs/Api/JobsApi.md#jobsidrecommendapplicantpost) | **POST** /jobs/{id}/recommend/applicant | Create candidate recommendation
*JobsApi* | [**jobsPost**](docs/Api/JobsApi.md#jobspost) | **POST** /jobs | Create new job
*MeApi* | [**meGet**](docs/Api/MeApi.md#meget) | **GET** /me | Get my information
*ReferralsApi* | [**referralsGet**](docs/Api/ReferralsApi.md#referralsget) | **GET** /referrals | Get referral list
*ReferralsApi* | [**referralsIdGet**](docs/Api/ReferralsApi.md#referralsidget) | **GET** /referrals/{id} | Get referral
*ReferralsApi* | [**referralsPost**](docs/Api/ReferralsApi.md#referralspost) | **POST** /referrals | Create new referal
*ReportApi* | [**reportsGet**](docs/Api/ReportApi.md#reportsget) | **GET** /reports | Export data
*TasksApi* | [**tasksGet**](docs/Api/TasksApi.md#tasksget) | **GET** /tasks | Get all tasks assigned to user

## Models

- [ActivityFeedGet200Response](docs/Model/ActivityFeedGet200Response.md)
- [ActivityFeedGet200ResponseMeta](docs/Model/ActivityFeedGet200ResponseMeta.md)
- [ActivityFeedGet200ResponsePayload](docs/Model/ActivityFeedGet200ResponsePayload.md)
- [ActivityFeedGet200ResponsePayloadFeedInner](docs/Model/ActivityFeedGet200ResponsePayloadFeedInner.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOf](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOf.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1ActionsInner](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1ActionsInner.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1Resolver](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOf1Resolver.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOf2](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOf2.md)
- [ActivityFeedGet200ResponsePayloadFeedInnerAnyOfResolver](docs/Model/ActivityFeedGet200ResponsePayloadFeedInnerAnyOfResolver.md)
- [ActivityFeedGet200ResponsePayloadTabsInner](docs/Model/ActivityFeedGet200ResponsePayloadTabsInner.md)
- [Address](docs/Model/Address.md)
- [AnswersAnswerIdChecklistsFlowIdGet200Response](docs/Model/AnswersAnswerIdChecklistsFlowIdGet200Response.md)
- [AnswersAnswerIdChecklistsFlowIdGet200ResponseMeta](docs/Model/AnswersAnswerIdChecklistsFlowIdGet200ResponseMeta.md)
- [AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInner](docs/Model/AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInner.md)
- [AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInnerFlowsInner](docs/Model/AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInnerFlowsInner.md)
- [AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInnerItemsInner](docs/Model/AnswersAnswerIdChecklistsFlowIdGet200ResponsePayloadInnerItemsInner.md)
- [AnswersAnswerIdExportPut200Response](docs/Model/AnswersAnswerIdExportPut200Response.md)
- [AnswersAnswerIdExportPut200ResponseMeta](docs/Model/AnswersAnswerIdExportPut200ResponseMeta.md)
- [AnswersAnswerIdExportPut200ResponsePayload](docs/Model/AnswersAnswerIdExportPut200ResponsePayload.md)
- [AnswersAnswerIdExportPutRequest](docs/Model/AnswersAnswerIdExportPutRequest.md)
- [AnswersAnswerIdExtraGet200Response](docs/Model/AnswersAnswerIdExtraGet200Response.md)
- [AnswersAnswerIdExtraGet200ResponseMeta](docs/Model/AnswersAnswerIdExtraGet200ResponseMeta.md)
- [AnswersAnswerIdExtraGet200ResponsePayload](docs/Model/AnswersAnswerIdExtraGet200ResponsePayload.md)
- [AnswersAnswerIdExtraPut200Response](docs/Model/AnswersAnswerIdExtraPut200Response.md)
- [AnswersAnswerIdExtraPut200ResponseMeta](docs/Model/AnswersAnswerIdExtraPut200ResponseMeta.md)
- [AnswersAnswerIdExtraPutRequest](docs/Model/AnswersAnswerIdExtraPutRequest.md)
- [AnswersAnswerIdGet200Response](docs/Model/AnswersAnswerIdGet200Response.md)
- [AnswersAnswerIdGet200ResponseMeta](docs/Model/AnswersAnswerIdGet200ResponseMeta.md)
- [AnswersAnswerIdGet200ResponsePayload](docs/Model/AnswersAnswerIdGet200ResponsePayload.md)
- [AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner](docs/Model/AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner.md)
- [AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner](docs/Model/AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner.md)
- [AnswersAnswerIdGet200ResponsePayloadRequirements](docs/Model/AnswersAnswerIdGet200ResponsePayloadRequirements.md)
- [AnswersAnswerIdGet200ResponsePayloadRequirementsSalary](docs/Model/AnswersAnswerIdGet200ResponsePayloadRequirementsSalary.md)
- [AnswersAnswerIdGet200ResponsePayloadSignJob](docs/Model/AnswersAnswerIdGet200ResponsePayloadSignJob.md)
- [AnswersAnswerIdInterviewsNotesGet200Response](docs/Model/AnswersAnswerIdInterviewsNotesGet200Response.md)
- [AnswersAnswerIdInterviewsNotesGet200ResponseMeta](docs/Model/AnswersAnswerIdInterviewsNotesGet200ResponseMeta.md)
- [AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInner](docs/Model/AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInner.md)
- [AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInnerCriteriaInner](docs/Model/AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInnerCriteriaInner.md)
- [AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInnerQuestionsInner](docs/Model/AnswersAnswerIdInterviewsNotesGet200ResponsePayloadInnerQuestionsInner.md)
- [AnswersGet200Response](docs/Model/AnswersGet200Response.md)
- [AnswersGet200ResponseOneOf](docs/Model/AnswersGet200ResponseOneOf.md)
- [AnswersGet200ResponseOneOf1](docs/Model/AnswersGet200ResponseOneOf1.md)
- [AnswersGet200ResponseOneOf1Meta](docs/Model/AnswersGet200ResponseOneOf1Meta.md)
- [AnswersGet200ResponseOneOf1PayloadInner](docs/Model/AnswersGet200ResponseOneOf1PayloadInner.md)
- [AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner.md)
- [AnswersGet200ResponseOneOf1PayloadInnerJobDetails](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerJobDetails.md)
- [AnswersGet200ResponseOneOf1PayloadInnerName](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerName.md)
- [AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner.md)
- [AnswersGet200ResponseOneOf1PayloadInnerSalutation](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerSalutation.md)
- [AnswersGet200ResponseOneOf1PayloadInnerSource](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerSource.md)
- [AnswersGet200ResponseOneOf1PayloadInnerTitle](docs/Model/AnswersGet200ResponseOneOf1PayloadInnerTitle.md)
- [AnswersGet200ResponseOneOfMeta](docs/Model/AnswersGet200ResponseOneOfMeta.md)
- [AnswersPost201Response](docs/Model/AnswersPost201Response.md)
- [AnswersPost201ResponsePayload](docs/Model/AnswersPost201ResponsePayload.md)
- [AnswersPostRequest](docs/Model/AnswersPostRequest.md)
- [AnswersPostRequestSalary](docs/Model/AnswersPostRequestSalary.md)
- [AttachmentsInner](docs/Model/AttachmentsInner.md)
- [AttachmentsInnerAnyOf](docs/Model/AttachmentsInnerAnyOf.md)
- [AttachmentsInnerAnyOf1](docs/Model/AttachmentsInnerAnyOf1.md)
- [Automation](docs/Model/Automation.md)
- [AutomationEventParams](docs/Model/AutomationEventParams.md)
- [AutomationPipelineInnerInner](docs/Model/AutomationPipelineInnerInner.md)
- [AutomationPipelineInnerInnerAnyOf](docs/Model/AutomationPipelineInnerInnerAnyOf.md)
- [AutomationPipelineInnerInnerAnyOf1](docs/Model/AutomationPipelineInnerInnerAnyOf1.md)
- [CalendarInterviewsAnswerIdGet200Response](docs/Model/CalendarInterviewsAnswerIdGet200Response.md)
- [CalendarInterviewsAnswerIdGet200ResponseMeta](docs/Model/CalendarInterviewsAnswerIdGet200ResponseMeta.md)
- [CalendarInterviewsAnswerIdGet200ResponsePayloadInner](docs/Model/CalendarInterviewsAnswerIdGet200ResponsePayloadInner.md)
- [CalendarInterviewsAnswerIdGet200ResponsePayloadInnerEvent](docs/Model/CalendarInterviewsAnswerIdGet200ResponsePayloadInnerEvent.md)
- [CalendarInterviewsAnswerIdGet200ResponsePayloadInnerReservationLink](docs/Model/CalendarInterviewsAnswerIdGet200ResponsePayloadInnerReservationLink.md)
- [CalendarReservationLinksGet200Response](docs/Model/CalendarReservationLinksGet200Response.md)
- [CalendarReservationLinksGet200ResponseMeta](docs/Model/CalendarReservationLinksGet200ResponseMeta.md)
- [CalendarReservationLinksGet200ResponsePayloadInner](docs/Model/CalendarReservationLinksGet200ResponsePayloadInner.md)
- [CalendarReservationLinksGet200ResponsePayloadInnerAddress](docs/Model/CalendarReservationLinksGet200ResponsePayloadInnerAddress.md)
- [CalendarReservationLinksGet200ResponsePayloadInnerAuthor](docs/Model/CalendarReservationLinksGet200ResponsePayloadInnerAuthor.md)
- [CalendarReservationLinksIdDelete200Response](docs/Model/CalendarReservationLinksIdDelete200Response.md)
- [CalendarReservationLinksIdDelete200ResponseMeta](docs/Model/CalendarReservationLinksIdDelete200ResponseMeta.md)
- [CalendarReservationLinksIdDelete409Response](docs/Model/CalendarReservationLinksIdDelete409Response.md)
- [CalendarReservationLinksIdDelete409ResponseMeta](docs/Model/CalendarReservationLinksIdDelete409ResponseMeta.md)
- [CalendarReservationLinksPost201Response](docs/Model/CalendarReservationLinksPost201Response.md)
- [CalendarReservationLinksPost201ResponseMeta](docs/Model/CalendarReservationLinksPost201ResponseMeta.md)
- [CalendarReservationLinksPost201ResponsePayload](docs/Model/CalendarReservationLinksPost201ResponsePayload.md)
- [CalendarReservationLinksPost201ResponsePayloadReservationLink](docs/Model/CalendarReservationLinksPost201ResponsePayloadReservationLink.md)
- [CalendarReservationLinksPostRequest](docs/Model/CalendarReservationLinksPostRequest.md)
- [CandidatesFormIdGet200Response](docs/Model/CandidatesFormIdGet200Response.md)
- [CandidatesFormIdGet200ResponsePayload](docs/Model/CandidatesFormIdGet200ResponsePayload.md)
- [CandidatesFormIdGet200ResponsePayloadLandingPage](docs/Model/CandidatesFormIdGet200ResponsePayloadLandingPage.md)
- [CandidatesIdAnswerIdCommunicationGet200Response](docs/Model/CandidatesIdAnswerIdCommunicationGet200Response.md)
- [CandidatesIdAnswerIdCommunicationGet200ResponseMeta](docs/Model/CandidatesIdAnswerIdCommunicationGet200ResponseMeta.md)
- [CandidatesIdAnswerIdCommunicationPost201Response](docs/Model/CandidatesIdAnswerIdCommunicationPost201Response.md)
- [CandidatesIdAnswerIdCommunicationPost201ResponseMeta](docs/Model/CandidatesIdAnswerIdCommunicationPost201ResponseMeta.md)
- [CandidatesIdAnswerIdCommunicationPost201ResponsePayload](docs/Model/CandidatesIdAnswerIdCommunicationPost201ResponsePayload.md)
- [CandidatesIdAnswerIdCommunicationPostRequest](docs/Model/CandidatesIdAnswerIdCommunicationPostRequest.md)
- [CandidatesIdCommunicationPostRequest](docs/Model/CandidatesIdCommunicationPostRequest.md)
- [CandidatesIdDelete200Response](docs/Model/CandidatesIdDelete200Response.md)
- [CandidatesIdDelete200ResponseMeta](docs/Model/CandidatesIdDelete200ResponseMeta.md)
- [CandidatesIdDelete403Response](docs/Model/CandidatesIdDelete403Response.md)
- [CandidatesIdDelete403ResponseMeta](docs/Model/CandidatesIdDelete403ResponseMeta.md)
- [CandidatesPost201Response](docs/Model/CandidatesPost201Response.md)
- [CandidatesPost201ResponseMeta](docs/Model/CandidatesPost201ResponseMeta.md)
- [CandidatesPost201ResponsePayload](docs/Model/CandidatesPost201ResponsePayload.md)
- [CandidatesPostRequest](docs/Model/CandidatesPostRequest.md)
- [ChecklistsAnswerIdItemItemIdStatePut200Response](docs/Model/ChecklistsAnswerIdItemItemIdStatePut200Response.md)
- [ChecklistsAnswerIdItemItemIdStatePut200ResponseMeta](docs/Model/ChecklistsAnswerIdItemItemIdStatePut200ResponseMeta.md)
- [ChecklistsAnswerIdItemItemIdStatePut200ResponsePayload](docs/Model/ChecklistsAnswerIdItemItemIdStatePut200ResponsePayload.md)
- [ChecklistsAnswerIdItemItemIdStatePutRequest](docs/Model/ChecklistsAnswerIdItemItemIdStatePutRequest.md)
- [CommentsDelete200Response](docs/Model/CommentsDelete200Response.md)
- [CommentsDelete200ResponseMeta](docs/Model/CommentsDelete200ResponseMeta.md)
- [CommentsGet200Response](docs/Model/CommentsGet200Response.md)
- [CommentsGet200ResponseMeta](docs/Model/CommentsGet200ResponseMeta.md)
- [CommentsGet200ResponsePayloadInner](docs/Model/CommentsGet200ResponsePayloadInner.md)
- [CommentsGet200ResponsePayloadInnerCandidate](docs/Model/CommentsGet200ResponsePayloadInnerCandidate.md)
- [CommentsGet200ResponsePayloadInnerTagsInner](docs/Model/CommentsGet200ResponsePayloadInnerTagsInner.md)
- [CommentsPost201Response](docs/Model/CommentsPost201Response.md)
- [CommentsPost201ResponseMeta](docs/Model/CommentsPost201ResponseMeta.md)
- [CommentsPostRequest](docs/Model/CommentsPostRequest.md)
- [CommentsPut200Response](docs/Model/CommentsPut200Response.md)
- [CommentsPut200ResponseMeta](docs/Model/CommentsPut200ResponseMeta.md)
- [CommentsPutRequest](docs/Model/CommentsPutRequest.md)
- [Communication](docs/Model/Communication.md)
- [CommunicationAttachmentsInner](docs/Model/CommunicationAttachmentsInner.md)
- [Contact](docs/Model/Contact.md)
- [CustomfieldsUserUserIdGet200Response](docs/Model/CustomfieldsUserUserIdGet200Response.md)
- [CustomfieldsUserUserIdGet200ResponseMeta](docs/Model/CustomfieldsUserUserIdGet200ResponseMeta.md)
- [CustomfieldsUserUserIdGet200ResponsePayloadInner](docs/Model/CustomfieldsUserUserIdGet200ResponsePayloadInner.md)
- [CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf](docs/Model/CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf.md)
- [CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf1](docs/Model/CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf1.md)
- [CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf2](docs/Model/CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf2.md)
- [CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf3](docs/Model/CustomfieldsUserUserIdGet200ResponsePayloadInnerAnyOf3.md)
- [Employee](docs/Model/Employee.md)
- [EnumsChannelsGet200Response](docs/Model/EnumsChannelsGet200Response.md)
- [EnumsChannelsGet200ResponseMeta](docs/Model/EnumsChannelsGet200ResponseMeta.md)
- [EnumsChannelsGet200ResponsePayloadInner](docs/Model/EnumsChannelsGet200ResponsePayloadInner.md)
- [EnumsChannelsGet200ResponsePayloadInnerOneOf](docs/Model/EnumsChannelsGet200ResponsePayloadInnerOneOf.md)
- [EnumsEmploymentsGet200Response](docs/Model/EnumsEmploymentsGet200Response.md)
- [EnumsEmploymentsGet200ResponseMeta](docs/Model/EnumsEmploymentsGet200ResponseMeta.md)
- [EnumsFlowsGet200Response](docs/Model/EnumsFlowsGet200Response.md)
- [EnumsFlowsGet200ResponseMeta](docs/Model/EnumsFlowsGet200ResponseMeta.md)
- [EnumsFlowsGet200ResponsePayloadInner](docs/Model/EnumsFlowsGet200ResponsePayloadInner.md)
- [EnumsOfficesGet200Response](docs/Model/EnumsOfficesGet200Response.md)
- [EnumsOfficesGet200ResponseMeta](docs/Model/EnumsOfficesGet200ResponseMeta.md)
- [EnumsOfficesGet200ResponsePayloadInner](docs/Model/EnumsOfficesGet200ResponsePayloadInner.md)
- [EnumsRejectReasonsGet200Response](docs/Model/EnumsRejectReasonsGet200Response.md)
- [EnumsRejectReasonsGet200ResponseMeta](docs/Model/EnumsRejectReasonsGet200ResponseMeta.md)
- [EnumsRejectReasonsGet200ResponsePayload](docs/Model/EnumsRejectReasonsGet200ResponsePayload.md)
- [EnumsRejectReasonsGet200ResponsePayloadCandidateInner](docs/Model/EnumsRejectReasonsGet200ResponsePayloadCandidateInner.md)
- [EnumsSourcesGet200Response](docs/Model/EnumsSourcesGet200Response.md)
- [EnumsSourcesGet200ResponseMeta](docs/Model/EnumsSourcesGet200ResponseMeta.md)
- [EnumsSourcesGet200ResponsePayloadInner](docs/Model/EnumsSourcesGet200ResponsePayloadInner.md)
- [EnumsWorkfieldsGet200Response](docs/Model/EnumsWorkfieldsGet200Response.md)
- [EnumsWorkfieldsGet200ResponseOneOf](docs/Model/EnumsWorkfieldsGet200ResponseOneOf.md)
- [EnumsWorkfieldsGet200ResponseOneOf1](docs/Model/EnumsWorkfieldsGet200ResponseOneOf1.md)
- [EnumsWorkfieldsGet200ResponseOneOf1Meta](docs/Model/EnumsWorkfieldsGet200ResponseOneOf1Meta.md)
- [EnumsWorkfieldsGet200ResponseOneOf1PayloadInner](docs/Model/EnumsWorkfieldsGet200ResponseOneOf1PayloadInner.md)
- [EnumsWorkfieldsGet200ResponseOneOf1PayloadInnerProfessionsInner](docs/Model/EnumsWorkfieldsGet200ResponseOneOf1PayloadInnerProfessionsInner.md)
- [EnumsWorkfieldsGet200ResponseOneOfMeta](docs/Model/EnumsWorkfieldsGet200ResponseOneOfMeta.md)
- [EnumsWorkfieldsGet200ResponseOneOfPayloadInner](docs/Model/EnumsWorkfieldsGet200ResponseOneOfPayloadInner.md)
- [EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner](docs/Model/EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner.md)
- [ExtraInner](docs/Model/ExtraInner.md)
- [ExtraInnerAnyOf](docs/Model/ExtraInnerAnyOf.md)
- [ExtraInnerAnyOf1](docs/Model/ExtraInnerAnyOf1.md)
- [ExtraInnerAnyOf2](docs/Model/ExtraInnerAnyOf2.md)
- [FilesHashGet200Response](docs/Model/FilesHashGet200Response.md)
- [FilesHashGet200ResponseMeta](docs/Model/FilesHashGet200ResponseMeta.md)
- [FilesHashGet200ResponsePayload](docs/Model/FilesHashGet200ResponsePayload.md)
- [FilesHashGet200ResponsePayloadOneOf](docs/Model/FilesHashGet200ResponsePayloadOneOf.md)
- [FilesHashGet200ResponsePayloadOneOfInner](docs/Model/FilesHashGet200ResponsePayloadOneOfInner.md)
- [FilesHashGet413Response](docs/Model/FilesHashGet413Response.md)
- [FilesHashGet413ResponseMeta](docs/Model/FilesHashGet413ResponseMeta.md)
- [FiltersGet200Response](docs/Model/FiltersGet200Response.md)
- [FiltersGet200ResponseMeta](docs/Model/FiltersGet200ResponseMeta.md)
- [FiltersGet200ResponsePayloadInner](docs/Model/FiltersGet200ResponsePayloadInner.md)
- [FiltersGet200ResponsePayloadInnerGroupSettings](docs/Model/FiltersGet200ResponsePayloadInnerGroupSettings.md)
- [FiltersIdDelete200Response](docs/Model/FiltersIdDelete200Response.md)
- [FiltersIdDelete200ResponseMeta](docs/Model/FiltersIdDelete200ResponseMeta.md)
- [FiltersIdDelete200ResponsePayload](docs/Model/FiltersIdDelete200ResponsePayload.md)
- [FiltersIdPut201Response](docs/Model/FiltersIdPut201Response.md)
- [FiltersIdPut201ResponseMeta](docs/Model/FiltersIdPut201ResponseMeta.md)
- [FiltersPost201Response](docs/Model/FiltersPost201Response.md)
- [FiltersPost201ResponseMeta](docs/Model/FiltersPost201ResponseMeta.md)
- [FiltersPost201ResponsePayload](docs/Model/FiltersPost201ResponsePayload.md)
- [FiltersPostRequest](docs/Model/FiltersPostRequest.md)
- [GDPR](docs/Model/GDPR.md)
- [GDPROneOf](docs/Model/GDPROneOf.md)
- [Job](docs/Model/Job.md)
- [JobChannels](docs/Model/JobChannels.md)
- [JobChannelsPortal](docs/Model/JobChannelsPortal.md)
- [JobChannelsPortalDateAssigned](docs/Model/JobChannelsPortalDateAssigned.md)
- [JobDetails](docs/Model/JobDetails.md)
- [JobEmployment](docs/Model/JobEmployment.md)
- [JobFilterlistInner](docs/Model/JobFilterlistInner.md)
- [JobFte](docs/Model/JobFte.md)
- [JobPersonalist](docs/Model/JobPersonalist.md)
- [JobReferralsInner](docs/Model/JobReferralsInner.md)
- [JobReferralsInnerReward](docs/Model/JobReferralsInnerReward.md)
- [JobSalary](docs/Model/JobSalary.md)
- [JobStats](docs/Model/JobStats.md)
- [JobStatsFlowAnswersInner](docs/Model/JobStatsFlowAnswersInner.md)
- [JobsGet200Response](docs/Model/JobsGet200Response.md)
- [JobsGet200ResponseOneOf](docs/Model/JobsGet200ResponseOneOf.md)
- [JobsGet200ResponseOneOf1](docs/Model/JobsGet200ResponseOneOf1.md)
- [JobsGet200ResponseOneOf1Meta](docs/Model/JobsGet200ResponseOneOf1Meta.md)
- [JobsGet200ResponseOneOfMeta](docs/Model/JobsGet200ResponseOneOfMeta.md)
- [JobsIdAccessPut200Response](docs/Model/JobsIdAccessPut200Response.md)
- [JobsIdAccessPut200ResponseMeta](docs/Model/JobsIdAccessPut200ResponseMeta.md)
- [JobsIdAccessPutRequest](docs/Model/JobsIdAccessPutRequest.md)
- [JobsIdAccessStateStatePut200Response](docs/Model/JobsIdAccessStateStatePut200Response.md)
- [JobsIdAccessStateStatePut200ResponseMeta](docs/Model/JobsIdAccessStateStatePut200ResponseMeta.md)
- [JobsIdAccessStateStatePut200ResponsePayload](docs/Model/JobsIdAccessStateStatePut200ResponsePayload.md)
- [JobsIdChannelChannelIdDelete202Response](docs/Model/JobsIdChannelChannelIdDelete202Response.md)
- [JobsIdChannelChannelIdDelete202ResponseMeta](docs/Model/JobsIdChannelChannelIdDelete202ResponseMeta.md)
- [JobsIdChannelChannelIdPut202Response](docs/Model/JobsIdChannelChannelIdPut202Response.md)
- [JobsIdChannelChannelIdPut202ResponseMeta](docs/Model/JobsIdChannelChannelIdPut202ResponseMeta.md)
- [JobsIdChannelChannelIdPut202ResponsePayloadInner](docs/Model/JobsIdChannelChannelIdPut202ResponsePayloadInner.md)
- [JobsIdChannelChannelIdPut202ResponsePayloadInnerId](docs/Model/JobsIdChannelChannelIdPut202ResponsePayloadInnerId.md)
- [JobsIdChannelChannelIdPutChannelIdParameter](docs/Model/JobsIdChannelChannelIdPutChannelIdParameter.md)
- [JobsIdChannelChannelIdPutRequest](docs/Model/JobsIdChannelChannelIdPutRequest.md)
- [JobsIdChannelsGet200Response](docs/Model/JobsIdChannelsGet200Response.md)
- [JobsIdChannelsGet200ResponseMeta](docs/Model/JobsIdChannelsGet200ResponseMeta.md)
- [JobsIdChannelsGet200ResponsePayloadInner](docs/Model/JobsIdChannelsGet200ResponsePayloadInner.md)
- [JobsIdCommunicationGet200Response](docs/Model/JobsIdCommunicationGet200Response.md)
- [JobsIdCommunicationGet200ResponseMeta](docs/Model/JobsIdCommunicationGet200ResponseMeta.md)
- [JobsIdFormGet200Response](docs/Model/JobsIdFormGet200Response.md)
- [JobsIdFormGet200ResponseMeta](docs/Model/JobsIdFormGet200ResponseMeta.md)
- [JobsIdFormGet200ResponsePayload](docs/Model/JobsIdFormGet200ResponsePayload.md)
- [JobsIdFormGet200ResponsePayloadAttributesInner](docs/Model/JobsIdFormGet200ResponsePayloadAttributesInner.md)
- [JobsIdFormGet200ResponsePayloadFieldsInner](docs/Model/JobsIdFormGet200ResponsePayloadFieldsInner.md)
- [JobsIdFormGet200ResponsePayloadGdprInner](docs/Model/JobsIdFormGet200ResponsePayloadGdprInner.md)
- [JobsIdFormValidatePost200Response](docs/Model/JobsIdFormValidatePost200Response.md)
- [JobsIdFormValidatePost200ResponseMeta](docs/Model/JobsIdFormValidatePost200ResponseMeta.md)
- [JobsIdFormValidatePost200ResponsePayload](docs/Model/JobsIdFormValidatePost200ResponsePayload.md)
- [JobsIdFormValidatePost200ResponsePayloadExtraAgreementsInner](docs/Model/JobsIdFormValidatePost200ResponsePayloadExtraAgreementsInner.md)
- [JobsIdFormValidatePost400Response](docs/Model/JobsIdFormValidatePost400Response.md)
- [JobsIdFormValidatePost400ResponseMeta](docs/Model/JobsIdFormValidatePost400ResponseMeta.md)
- [JobsIdFormValidatePost400ResponseMetaAdditionalOutputInner](docs/Model/JobsIdFormValidatePost400ResponseMetaAdditionalOutputInner.md)
- [JobsIdFormValidatePost404Response](docs/Model/JobsIdFormValidatePost404Response.md)
- [JobsIdFormValidatePost404ResponseMeta](docs/Model/JobsIdFormValidatePost404ResponseMeta.md)
- [JobsIdFormValidatePostRequest](docs/Model/JobsIdFormValidatePostRequest.md)
- [JobsIdFormValidatePostRequestCvInner](docs/Model/JobsIdFormValidatePostRequestCvInner.md)
- [JobsIdGet200Response](docs/Model/JobsIdGet200Response.md)
- [JobsIdGet200ResponseMeta](docs/Model/JobsIdGet200ResponseMeta.md)
- [JobsIdGet404Response](docs/Model/JobsIdGet404Response.md)
- [JobsIdGet404ResponseMeta](docs/Model/JobsIdGet404ResponseMeta.md)
- [JobsIdRecommendApplicantPost201Response](docs/Model/JobsIdRecommendApplicantPost201Response.md)
- [JobsIdRecommendApplicantPost201ResponseMeta](docs/Model/JobsIdRecommendApplicantPost201ResponseMeta.md)
- [JobsIdRecommendApplicantPost201ResponsePayload](docs/Model/JobsIdRecommendApplicantPost201ResponsePayload.md)
- [JobsIdRecommendApplicantPostRequest](docs/Model/JobsIdRecommendApplicantPostRequest.md)
- [JobsPost201Response](docs/Model/JobsPost201Response.md)
- [JobsPost201ResponseMeta](docs/Model/JobsPost201ResponseMeta.md)
- [JobsPost201ResponsePayload](docs/Model/JobsPost201ResponsePayload.md)
- [JobsPost400Response](docs/Model/JobsPost400Response.md)
- [JobsPost400ResponseMeta](docs/Model/JobsPost400ResponseMeta.md)
- [JobsPostRequest](docs/Model/JobsPostRequest.md)
- [LoginPut200Response](docs/Model/LoginPut200Response.md)
- [LoginPut200ResponseMeta](docs/Model/LoginPut200ResponseMeta.md)
- [LoginPut200ResponsePayload](docs/Model/LoginPut200ResponsePayload.md)
- [LoginPut401Response](docs/Model/LoginPut401Response.md)
- [LoginPut401ResponseMeta](docs/Model/LoginPut401ResponseMeta.md)
- [LoginPutRequest](docs/Model/LoginPutRequest.md)
- [LogoutPut200Response](docs/Model/LogoutPut200Response.md)
- [LogoutPut200ResponseMeta](docs/Model/LogoutPut200ResponseMeta.md)
- [MeGet200Response](docs/Model/MeGet200Response.md)
- [MeGet200ResponseMeta](docs/Model/MeGet200ResponseMeta.md)
- [MeGet200ResponsePayload](docs/Model/MeGet200ResponsePayload.md)
- [MeGet200ResponsePayloadQuotas](docs/Model/MeGet200ResponsePayloadQuotas.md)
- [Referral](docs/Model/Referral.md)
- [ReferralsGet200Response](docs/Model/ReferralsGet200Response.md)
- [ReferralsGet200ResponseOneOf](docs/Model/ReferralsGet200ResponseOneOf.md)
- [ReferralsGet200ResponseOneOf1](docs/Model/ReferralsGet200ResponseOneOf1.md)
- [ReferralsGet200ResponseOneOf1Meta](docs/Model/ReferralsGet200ResponseOneOf1Meta.md)
- [ReferralsGet200ResponseOneOfMeta](docs/Model/ReferralsGet200ResponseOneOfMeta.md)
- [ReferralsIdGet200Response](docs/Model/ReferralsIdGet200Response.md)
- [ReferralsIdGet200ResponseMeta](docs/Model/ReferralsIdGet200ResponseMeta.md)
- [ReferralsPost201Response](docs/Model/ReferralsPost201Response.md)
- [ReferralsPost201ResponseMeta](docs/Model/ReferralsPost201ResponseMeta.md)
- [ReferralsPost201ResponsePayload](docs/Model/ReferralsPost201ResponsePayload.md)
- [ReferralsPost409Response](docs/Model/ReferralsPost409Response.md)
- [ReferralsPost409ResponseMeta](docs/Model/ReferralsPost409ResponseMeta.md)
- [ReferralsPostRequest](docs/Model/ReferralsPostRequest.md)
- [ReportsGet200Response](docs/Model/ReportsGet200Response.md)
- [ReportsGet200ResponseMeta](docs/Model/ReportsGet200ResponseMeta.md)
- [ReportsGet200ResponsePayload](docs/Model/ReportsGet200ResponsePayload.md)
- [ReportsGet200ResponsePayloadAnswersInner](docs/Model/ReportsGet200ResponsePayloadAnswersInner.md)
- [ReportsGet200ResponsePayloadAnswersInnerInterviewsInner](docs/Model/ReportsGet200ResponsePayloadAnswersInnerInterviewsInner.md)
- [ReportsGet200ResponsePayloadAnswersInnerSalary](docs/Model/ReportsGet200ResponsePayloadAnswersInnerSalary.md)
- [ReportsGet200ResponsePayloadCustomFieldsInner](docs/Model/ReportsGet200ResponsePayloadCustomFieldsInner.md)
- [ReportsGet200ResponsePayloadJobsInner](docs/Model/ReportsGet200ResponsePayloadJobsInner.md)
- [ReportsGet200ResponsePayloadOfficesInner](docs/Model/ReportsGet200ResponsePayloadOfficesInner.md)
- [ReportsGet200ResponsePayloadPersonalistsAnswersInner](docs/Model/ReportsGet200ResponsePayloadPersonalistsAnswersInner.md)
- [ReportsGet200ResponsePayloadPersonalistsInner](docs/Model/ReportsGet200ResponsePayloadPersonalistsInner.md)
- [ReportsGet200ResponsePayloadPersonalistsTimelineInner](docs/Model/ReportsGet200ResponsePayloadPersonalistsTimelineInner.md)
- [ReportsGet200ResponsePayloadTimelineInner](docs/Model/ReportsGet200ResponsePayloadTimelineInner.md)
- [ReportsGet400Response](docs/Model/ReportsGet400Response.md)
- [ReportsGet400ResponseMeta](docs/Model/ReportsGet400ResponseMeta.md)
- [TasksGet200Response](docs/Model/TasksGet200Response.md)
- [TasksGet200ResponseMeta](docs/Model/TasksGet200ResponseMeta.md)
- [TasksGet200ResponsePayloadInner](docs/Model/TasksGet200ResponsePayloadInner.md)
- [TasksGet200ResponsePayloadInnerApplicant](docs/Model/TasksGet200ResponsePayloadInnerApplicant.md)
- [TasksGet200ResponsePayloadInnerAssigneesInner](docs/Model/TasksGet200ResponsePayloadInnerAssigneesInner.md)
- [TasksGet200ResponsePayloadInnerAuthor](docs/Model/TasksGet200ResponsePayloadInnerAuthor.md)
- [TasksGet200ResponsePayloadInnerExtra](docs/Model/TasksGet200ResponsePayloadInnerExtra.md)
- [TasksGet200ResponsePayloadInnerJob](docs/Model/TasksGet200ResponsePayloadInnerJob.md)
- [Webhook](docs/Model/Webhook.md)
- [WebhookHeader](docs/Model/WebhookHeader.md)

## Authorization

Authentication schemes defined for the API:
### auth

- **Type**: Bearer authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.13.0`
    - Generator version: `7.6.0-SNAPSHOT`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
