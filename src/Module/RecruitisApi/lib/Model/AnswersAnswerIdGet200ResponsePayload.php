<?php
/**
 * AnswersAnswerIdGet200ResponsePayload
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Recruitis.io
 *
 * # API dokumentace pro systém Recruitis.io Dokumentace je založena na autorizaci pomocí tokenu, který je vygenerován buď samotným systémem nebo uživatelem v systému Recruitis.  Postupem času budou přibývat jednotlivé funkcionality. Pokud by měla být narušena funkčnost jakéhokoli API volání, bude založen nový branch (v2 atd.) nebo budete v dostatečném časovém odstupu o změně informováni.  ### API url  Pro volání API využijte url: [https://app.recruitis.io/api2/](https://app.recruitis.io/api2/).  ### Changelog  Všechny změny v dokumentaci jsou zaznamenány v [Changelogu](#tag/Changelog).  ## Tokeny Autorizační tokeny mají dvě skupiny po dvou úrovních  ### Skupiny tokenů  #### Firemní tokeny  Tento typ tokenu má výhodu, že není limitován na konkrétní účet, tudíž nepřestane fungovat v případě smazání nebo deaktivování účtu. Zároveň s ním ale nelze používat všechny API volání. (U každého API volání se dočtete, jestli podporuje firemní token.) Nekteré volání potřebují znát přesného autora (Kvůli reportům například.) a ty bohužel nelze volat s tímto firemním tokenem.  #### Tokeny konkrétního účtu  Každý účet si může vytvořit v recruitisu vlastní token. Díky němu může používat všechna API volání, to jest i volání,  která potřebují mít vazbu ke konkrétnímu účtu.  ### Dále se tokeny rozlišují dle udělených práv:  + `full_access`: Token, který má veškeré pravomoci a umožňuje upravovat data v systému dané firmy. Tento token nesmí být jakkoli zobrazen veřejnosti. + `public_access`: Token, který má převážně zobrazovací pravomoci. Tento token může být veřejnosti zobrazen. Například při použití Javascriptu.  Na oba druhy tokenů lze uplatnit doménový whitelist (toto nastavení doporučujeme použít).  Tokeny lze vytvořit po přihlášení v Recruitisu: [*nastavení* > *api propojení*](https://app.recruitis.io/zadavatel/nastaveni/obecne/view/api).  Samotná autorizace probíhá pomocí posláním headeru: `Authorization: Bearer <token>`  _Příklad:_ `Authorization: Bearer 30bcaf299e100318906fef2f442505216fa28af1.11196.99382ec77e2a79ac2af2671730817ec6`.  ## Meta informace  Každá `response` má `meta` sekci, která dodává veškeré pomocné informace. Níže vypsané atributy **nemusí** vždy v meta sekci být a mohou být podmíněny  okolnostmi volání (`entries_*` údaje se v meta sekci zobrazí jen při vrácení pole payloadu apod.).  | META parameter      | Note                                                                                    | |---------------------|-----------------------------------------------------------------------------------------| | `code`              | Kód výsledku. V případě chyby je to standardizované hlášení o chybě.                    | | `message`           | Zpráva, která popisuje dané volání.                                                     | | `duration`          | Uplynulá doba při zpracování požadavku.                                                 | | `cached`            | Výsledek je cachován a nemusí být aktuální.                                             | | `cached_from`       | Čas vygenerování vráceného výsledku.                                                    | | `deprecated`        | Dané volání je označeno jako zastaralé a nemělo by se nadále používat.                  | | `additional_output` | Viz samostatná sekce.                                                                   | | `entries_from`      | Pokud se vrací pole, udává, od kterého elementu dané pole je (*určeno pro stránkovač*). | | `entries_to`        | Pokud se vrací pole, udává, do kterého elementu dané pole je (*určeno pro stránkovač*). | | `entries_total`     | Pokud se vrací pole, udává celkové množství elementů (*určeno pro stránkovač*).         | | `entries_sum`       | Pokud se vrací pole, udává aktuální množství elementů (*určeno pro stránkovač*).        |  ### Meta informace  - `additional_output`  Při nahrávání nových údajů (odpovědí, kandidátů) může nastat stav, kdy se daná entita nahraje s různými výjimkami  (duplikace příloh, sjednocení uchazečů, gdpr zosobnění, vložení špatných příloh). V tom případě API zpětně informuje o všem, co se s danou  entitou stalo, viz příklad níže. Zároveň se tento stav zaloguje u nás na serveru a je zpětně k dohledání.  ```json {   \"additional_output\": [     {       \"message\": \"Candidate already exists. I'll use his user ID.\",       \"status\": \"WARNING\",       \"code\": \"candidate.put.exists.join\"     },     {       \"message\": \"File cv.txt is already uploaded.\",       \"status\": \"WARNING\",       \"code\": \"candidate.put.attachment.duplicated\"     },     {       \"message\": \"File logo.jpg is already uploaded.\",       \"status\": \"WARNING\",       \"code\": \"candidate.put.attachment.duplicated\"     },     {       \"message\": \"File souhlas.pdf is already uploaded.\",       \"status\": \"WARNING\",       \"code\": \"candidate.put.attachment.duplicated\"     }   ] } ```  ## Popis response parametru code  Každá odpověď má parametr `code`. Zde je jejich výčet a jejich popis:  | CODE parameter                                   | Note |:-------------------------------------------------|--------------------------------| | `api.ok`                                         | Dotaz proběhl úspěšně.  | `api.found`                                      | Dotaz našel výsledek a poslal zpět. | `api.created`                                    | Dotaz vytvořil entitu. | `api.deleted`                                    | Dotaz smazal entitu. | `api.modified`                                   | Dotaz upravil entitu. | `api.unmodified`                                 | Dotaz nic nového neprovedl, vrátil již existující entitu. | `api.response.null`                              | Dotaz proběhl úspěšně, ale nebyl vrácen žádný výsledek.  | `api.error.generic`                              | Obecná chyba. Nespecifikovatelná. | `api.error.system.unavailable`                   | API systém je nedostupný. | `api.error.request.wrong_format`                 | Špatný JSON formát requestu. | `api.error.request.property.missing`             | V požadavku chybí vyžadovaná hodnota. | `api.error.request.property.wrong_value`         | V požadavku nabývá proměnná špatnou hodnotu.  | `api.error.request.property.wrong_text_length`   | Délka textu v konkrétním požadavku je větší než povolená hodnota. | `api.error.request.property.maximum_array_items` | Počet prvků v poli je větší, než je povoleno. | `api.error.not_found`                            | Dotaz směřuje na neexistující požadavek.  | `api.error.unauthorized`                         | Dotaz vyžaduje přihlášení. | `api.error.authorization.low_privileges`         | Dotaz vyžaduje přihlášení přes `full_access` token. | `api.error.authorization.blocked`                | Přihlášení je na nějakou dobu zablokováno. Je možné, že se uživatel přihlašoval častěji špatnými údaji.  | `api.error.authorization.wrong_token_format`     | Bearer token je špatného formátu. | `api.error.authorization.token.doesnt_exists`    | Daný bearer token neexistuje.  | `api.error.authorization.wrong_credentials`      | Vložené údaje jsou špatné, přihlášení se nezdařilo.  | `api.error.authorization.bad_domain`             | API je voláno z nepovolené domény. | `api.error.quota.exceeded`                       | Byl dosažen denní/minutový limit volání viz. samostatná sekce [Kvóty](#kvóty). | `api.error.account.deleted`                      | Účet, na který se snažíte přihlásit, byl smazán.  | `api.error.account.banned`                       | Účet, na který se snažíte přihlásit, byl zablokován (trvale).  | `api.error.upload.generic`                       | Nastala chyba při uploadování přílohy.  | `api.error.upload.size`                          | Příloha má více, než 3 MB. | `api.error.upload.timeout`                       | Vypršela doba pro stáhnutí souboru z externího uložiště. Soubor není dostupný. | `api.error.upload.bad_host`                      | Snažíte se uploadovat soubor, který neexistuje.  | `api.error.upload.no_data`                       | Snažíte se uploadovat soubor, který neexistuje.  | `api.error.user.already_answered`                | Daný uchazeč již na inzerát odpověděl. | `api.error.response.too_big`                     | Odpověď je příliš velká. | `api.error.export.bad_request`                   | Obecná chyba při exportu inzerátu do jiného systému. | `api.error.referral.already_created`             | Daný referral byl již vytvořen. | `api.error.job.disallowed_acess_type`            | Tento typ inzerátu nepřijímá žádné odpovědi, popř. nelze nijak upravovat.  ## Dodatečný popis API volání  ### Kvóty  Kvóty hlídají jednotlivé volání systému, monitorují jejich frekvenci a v případě jejich dosažení, je daný druh volání zakázán.  V případě dosažení limitu se vrací hlavíčka `403 - forbidden` s `meta.code` `api.error.quota.exceeded`.  Kvóty se budou v průběhu času upravovat a optimalizovat.   Zde je výčet jednotlivých kvót:   | Quota name                | Quota type | Max value | Note                                        | |:--------------------------|------------|-----------|---------------------------------------------| | `quota_candidates_delete` | daily      | 100       | Denní povolené množství smazaných uchazečů. |    ### Parametry  Pokud je v dokumentaci označen parametr jako `array`, poté systém očekává, že se dostaví daný parametr v url adrese jako jedna hodnota (`foo=bar`) nebo jako pole (`foo[]=bar&foo[]=baz`).  #### Query parametry  Query parametry se připojují na konec požadovaného volání ve formátu:  `?nazev_parametru1=hodnota1&nazev_parametru2=hodnota2`  například:  `?limit=25&page=2&job_id=30665&job_id=23982`  ### Typy příloh (Attachment type)  Typy příloh se využívají při vytváření odpovědi, popřípadě kandidáta.  | Value  |  Note                             | |:-------|-----------------------------------| | `1`    | Příloha bez zaměření | `2`    | CV příloha | `3`    | Emailová korespondence (obsolete) | `4`    | Fotografie | `5`    | GDPR souhlas | `6`    | Profilový obrázek  ### Speciální typy tagů  Pokud místo svého znění tagu vložíte níže uvedený tag, má to hlubší vliv na fungování uchazeče, viz poznámka níže.  | Value        |  Note                             | |:-------------|-----------------------------------| | `tag.hot`    | Tento tag přidaný k uchazeči (přes přidání odpovědi / uchazeče) zaručí, že se kandidát zařadí do sekce \"žhavý kandidát\"    ### Vysvětlení hodnot jednotlivých parametrů   **date** - Je string ve formátu YYYY-MM-DD (2018-01-30)   **datetime** - Je string ve formátu YYYY-MM-DD HH:MM:SS (2018-01-30 12:59:59)
 *
 * The version of the OpenAPI document: 1.13.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.6.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace App\Module\RecruitisApi\Model;

use \ArrayAccess;
use \App\Module\RecruitisApi\ObjectSerializer;

/**
 * AnswersAnswerIdGet200ResponsePayload Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AnswersAnswerIdGet200ResponsePayload implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = '_answers__answer_id__get_200_response_payload';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'candidate_id' => 'int',
        'answer_id' => 'int',
        'job_id' => 'int',
        'name' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerName',
        'title' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerTitle',
        'user_img' => 'string',
        'rating' => 'int',
        'ratings' => 'object[]',
        'sign_job' => '\App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadSignJob',
        'source_site' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'flow_id' => 'int',
        'share_status' => 'int',
        'share_status_detail' => 'string',
        'rejected' => 'bool',
        'reject_reason' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner[]',
        'answer_created' => '\DateTime',
        'additional_details' => '\App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner[]',
        'flow_history' => '\App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner[]',
        'interview_date' => '\DateTime',
        'date_response' => '\DateTime',
        'requirements' => '\App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadRequirements',
        'job_details' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerJobDetails',
        'source' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSource',
        'attachment_list' => '\App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner[]',
        'cover_letter' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'candidate_id' => null,
        'answer_id' => null,
        'job_id' => null,
        'name' => null,
        'title' => null,
        'user_img' => null,
        'rating' => null,
        'ratings' => null,
        'sign_job' => null,
        'source_site' => null,
        'phone' => null,
        'email' => 'email',
        'flow_id' => null,
        'share_status' => null,
        'share_status_detail' => null,
        'rejected' => null,
        'reject_reason' => null,
        'answer_created' => 'date-time',
        'additional_details' => null,
        'flow_history' => null,
        'interview_date' => 'date-time',
        'date_response' => 'date-time',
        'requirements' => null,
        'job_details' => null,
        'source' => null,
        'attachment_list' => null,
        'cover_letter' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'candidate_id' => false,
        'answer_id' => false,
        'job_id' => false,
        'name' => false,
        'title' => false,
        'user_img' => false,
        'rating' => false,
        'ratings' => false,
        'sign_job' => false,
        'source_site' => false,
        'phone' => false,
        'email' => false,
        'flow_id' => false,
        'share_status' => true,
        'share_status_detail' => false,
        'rejected' => true,
        'reject_reason' => false,
        'answer_created' => false,
        'additional_details' => false,
        'flow_history' => false,
        'interview_date' => false,
        'date_response' => false,
        'requirements' => false,
        'job_details' => false,
        'source' => false,
        'attachment_list' => false,
        'cover_letter' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'candidate_id' => 'candidate_id',
        'answer_id' => 'answer_id',
        'job_id' => 'job_id',
        'name' => 'name',
        'title' => 'title',
        'user_img' => 'user_img',
        'rating' => 'rating',
        'ratings' => 'ratings',
        'sign_job' => 'sign_job',
        'source_site' => 'source_site',
        'phone' => 'phone',
        'email' => 'email',
        'flow_id' => 'flow_id',
        'share_status' => 'share_status',
        'share_status_detail' => 'share_status_detail',
        'rejected' => 'rejected',
        'reject_reason' => 'reject_reason',
        'answer_created' => 'answer_created',
        'additional_details' => 'additional_details',
        'flow_history' => 'flow_history',
        'interview_date' => 'interview_date',
        'date_response' => 'date_response',
        'requirements' => 'requirements',
        'job_details' => 'job_details',
        'source' => 'source',
        'attachment_list' => 'attachment_list',
        'cover_letter' => 'cover_letter'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'candidate_id' => 'setCandidateId',
        'answer_id' => 'setAnswerId',
        'job_id' => 'setJobId',
        'name' => 'setName',
        'title' => 'setTitle',
        'user_img' => 'setUserImg',
        'rating' => 'setRating',
        'ratings' => 'setRatings',
        'sign_job' => 'setSignJob',
        'source_site' => 'setSourceSite',
        'phone' => 'setPhone',
        'email' => 'setEmail',
        'flow_id' => 'setFlowId',
        'share_status' => 'setShareStatus',
        'share_status_detail' => 'setShareStatusDetail',
        'rejected' => 'setRejected',
        'reject_reason' => 'setRejectReason',
        'answer_created' => 'setAnswerCreated',
        'additional_details' => 'setAdditionalDetails',
        'flow_history' => 'setFlowHistory',
        'interview_date' => 'setInterviewDate',
        'date_response' => 'setDateResponse',
        'requirements' => 'setRequirements',
        'job_details' => 'setJobDetails',
        'source' => 'setSource',
        'attachment_list' => 'setAttachmentList',
        'cover_letter' => 'setCoverLetter'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'candidate_id' => 'getCandidateId',
        'answer_id' => 'getAnswerId',
        'job_id' => 'getJobId',
        'name' => 'getName',
        'title' => 'getTitle',
        'user_img' => 'getUserImg',
        'rating' => 'getRating',
        'ratings' => 'getRatings',
        'sign_job' => 'getSignJob',
        'source_site' => 'getSourceSite',
        'phone' => 'getPhone',
        'email' => 'getEmail',
        'flow_id' => 'getFlowId',
        'share_status' => 'getShareStatus',
        'share_status_detail' => 'getShareStatusDetail',
        'rejected' => 'getRejected',
        'reject_reason' => 'getRejectReason',
        'answer_created' => 'getAnswerCreated',
        'additional_details' => 'getAdditionalDetails',
        'flow_history' => 'getFlowHistory',
        'interview_date' => 'getInterviewDate',
        'date_response' => 'getDateResponse',
        'requirements' => 'getRequirements',
        'job_details' => 'getJobDetails',
        'source' => 'getSource',
        'attachment_list' => 'getAttachmentList',
        'cover_letter' => 'getCoverLetter'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const RATING_0 = 0;
    public const RATING_1 = 1;
    public const RATING_2 = 2;
    public const RATING_3 = 3;
    public const RATING_4 = 4;
    public const RATING_5 = 5;

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRatingAllowableValues()
    {
        return [
            self::RATING_0,
            self::RATING_1,
            self::RATING_2,
            self::RATING_3,
            self::RATING_4,
            self::RATING_5,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('candidate_id', $data ?? [], null);
        $this->setIfExists('answer_id', $data ?? [], null);
        $this->setIfExists('job_id', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('user_img', $data ?? [], null);
        $this->setIfExists('rating', $data ?? [], null);
        $this->setIfExists('ratings', $data ?? [], null);
        $this->setIfExists('sign_job', $data ?? [], null);
        $this->setIfExists('source_site', $data ?? [], null);
        $this->setIfExists('phone', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('flow_id', $data ?? [], null);
        $this->setIfExists('share_status', $data ?? [], null);
        $this->setIfExists('share_status_detail', $data ?? [], null);
        $this->setIfExists('rejected', $data ?? [], null);
        $this->setIfExists('reject_reason', $data ?? [], null);
        $this->setIfExists('answer_created', $data ?? [], null);
        $this->setIfExists('additional_details', $data ?? [], null);
        $this->setIfExists('flow_history', $data ?? [], null);
        $this->setIfExists('interview_date', $data ?? [], null);
        $this->setIfExists('date_response', $data ?? [], null);
        $this->setIfExists('requirements', $data ?? [], null);
        $this->setIfExists('job_details', $data ?? [], null);
        $this->setIfExists('source', $data ?? [], null);
        $this->setIfExists('attachment_list', $data ?? [], null);
        $this->setIfExists('cover_letter', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getRatingAllowableValues();
        if (!is_null($this->container['rating']) && !in_array($this->container['rating'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'rating', must be one of '%s'",
                $this->container['rating'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets candidate_id
     *
     * @return int|null
     */
    public function getCandidateId()
    {
        return $this->container['candidate_id'];
    }

    /**
     * Sets candidate_id
     *
     * @param int|null $candidate_id ID kandidáta, ke kterému se odpověď vztahuje.
     *
     * @return self
     */
    public function setCandidateId($candidate_id)
    {
        if (is_null($candidate_id)) {
            throw new \InvalidArgumentException('non-nullable candidate_id cannot be null');
        }
        $this->container['candidate_id'] = $candidate_id;

        return $this;
    }

    /**
     * Gets answer_id
     *
     * @return int|null
     */
    public function getAnswerId()
    {
        return $this->container['answer_id'];
    }

    /**
     * Sets answer_id
     *
     * @param int|null $answer_id ID odpovědi.
     *
     * @return self
     */
    public function setAnswerId($answer_id)
    {
        if (is_null($answer_id)) {
            throw new \InvalidArgumentException('non-nullable answer_id cannot be null');
        }
        $this->container['answer_id'] = $answer_id;

        return $this;
    }

    /**
     * Gets job_id
     *
     * @return int|null
     */
    public function getJobId()
    {
        return $this->container['job_id'];
    }

    /**
     * Sets job_id
     *
     * @param int|null $job_id ID inzerátu.
     *
     * @return self
     */
    public function setJobId($job_id)
    {
        if (is_null($job_id)) {
            throw new \InvalidArgumentException('non-nullable job_id cannot be null');
        }
        $this->container['job_id'] = $job_id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerName|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerName|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets title
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerTitle|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerTitle|null $title title
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets user_img
     *
     * @return string|null
     */
    public function getUserImg()
    {
        return $this->container['user_img'];
    }

    /**
     * Sets user_img
     *
     * @param string|null $user_img Cesta k obrázku uchazeče.
     *
     * @return self
     */
    public function setUserImg($user_img)
    {
        if (is_null($user_img)) {
            throw new \InvalidArgumentException('non-nullable user_img cannot be null');
        }
        $this->container['user_img'] = $user_img;

        return $this;
    }

    /**
     * Gets rating
     *
     * @return int|null
     */
    public function getRating()
    {
        return $this->container['rating'];
    }

    /**
     * Sets rating
     *
     * @param int|null $rating Hodnocení uživatele, 0-5.
     *
     * @return self
     */
    public function setRating($rating)
    {
        if (is_null($rating)) {
            throw new \InvalidArgumentException('non-nullable rating cannot be null');
        }
        $allowedValues = $this->getRatingAllowableValues();
        if (!in_array($rating, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'rating', must be one of '%s'",
                    $rating,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['rating'] = $rating;

        return $this;
    }

    /**
     * Gets ratings
     *
     * @return object[]|null
     */
    public function getRatings()
    {
        return $this->container['ratings'];
    }

    /**
     * Sets ratings
     *
     * @param object[]|null $ratings ratings
     *
     * @return self
     */
    public function setRatings($ratings)
    {
        if (is_null($ratings)) {
            throw new \InvalidArgumentException('non-nullable ratings cannot be null');
        }
        $this->container['ratings'] = $ratings;

        return $this;
    }

    /**
     * Gets sign_job
     *
     * @return \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadSignJob|null
     */
    public function getSignJob()
    {
        return $this->container['sign_job'];
    }

    /**
     * Sets sign_job
     *
     * @param \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadSignJob|null $sign_job sign_job
     *
     * @return self
     */
    public function setSignJob($sign_job)
    {
        if (is_null($sign_job)) {
            throw new \InvalidArgumentException('non-nullable sign_job cannot be null');
        }
        $this->container['sign_job'] = $sign_job;

        return $this;
    }

    /**
     * Gets source_site
     *
     * @return string|null
     */
    public function getSourceSite()
    {
        return $this->container['source_site'];
    }

    /**
     * Sets source_site
     *
     * @param string|null $source_site source_site
     *
     * @return self
     */
    public function setSourceSite($source_site)
    {
        if (is_null($source_site)) {
            throw new \InvalidArgumentException('non-nullable source_site cannot be null');
        }
        $this->container['source_site'] = $source_site;

        return $this;
    }

    /**
     * Gets phone
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param string|null $phone phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        if (is_null($phone)) {
            throw new \InvalidArgumentException('non-nullable phone cannot be null');
        }
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets flow_id
     *
     * @return int|null
     */
    public function getFlowId()
    {
        return $this->container['flow_id'];
    }

    /**
     * Sets flow_id
     *
     * @param int|null $flow_id ID flow, ve které se odpověď zrovna nachází.
     *
     * @return self
     */
    public function setFlowId($flow_id)
    {
        if (is_null($flow_id)) {
            throw new \InvalidArgumentException('non-nullable flow_id cannot be null');
        }
        $this->container['flow_id'] = $flow_id;

        return $this;
    }

    /**
     * Gets share_status
     *
     * @return int|null
     */
    public function getShareStatus()
    {
        return $this->container['share_status'];
    }

    /**
     * Sets share_status
     *
     * @param int|null $share_status Pokud je odpověď zrecyklovaná (zkopírovaná z jiného inzerátu), čekáme na odpověď uchazeče. NULL - není odpověď, 1 - Uchazeč odpověď schválil, 0 - Uchazeč odpověd zamítl.
     *
     * @return self
     */
    public function setShareStatus($share_status)
    {
        if (is_null($share_status)) {
            array_push($this->openAPINullablesSetToNull, 'share_status');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('share_status', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['share_status'] = $share_status;

        return $this;
    }

    /**
     * Gets share_status_detail
     *
     * @return string|null
     */
    public function getShareStatusDetail()
    {
        return $this->container['share_status_detail'];
    }

    /**
     * Sets share_status_detail
     *
     * @param string|null $share_status_detail Důvod zamítnutí zrecyklované odpovědi.
     *
     * @return self
     */
    public function setShareStatusDetail($share_status_detail)
    {
        if (is_null($share_status_detail)) {
            throw new \InvalidArgumentException('non-nullable share_status_detail cannot be null');
        }
        $this->container['share_status_detail'] = $share_status_detail;

        return $this;
    }

    /**
     * Gets rejected
     *
     * @return bool|null
     */
    public function getRejected()
    {
        return $this->container['rejected'];
    }

    /**
     * Sets rejected
     *
     * @param bool|null $rejected Značí, jestli je odpověď zamítnutá.
     *
     * @return self
     */
    public function setRejected($rejected)
    {
        if (is_null($rejected)) {
            array_push($this->openAPINullablesSetToNull, 'rejected');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('rejected', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['rejected'] = $rejected;

        return $this;
    }

    /**
     * Gets reject_reason
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner[]|null
     */
    public function getRejectReason()
    {
        return $this->container['reject_reason'];
    }

    /**
     * Sets reject_reason
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerRejectReasonInner[]|null $reject_reason reject_reason
     *
     * @return self
     */
    public function setRejectReason($reject_reason)
    {
        if (is_null($reject_reason)) {
            throw new \InvalidArgumentException('non-nullable reject_reason cannot be null');
        }
        $this->container['reject_reason'] = $reject_reason;

        return $this;
    }

    /**
     * Gets answer_created
     *
     * @return \DateTime|null
     */
    public function getAnswerCreated()
    {
        return $this->container['answer_created'];
    }

    /**
     * Sets answer_created
     *
     * @param \DateTime|null $answer_created Datum vytvoření odpovědi, ve formátu YYYY-mm-dd HH:mm:ss
     *
     * @return self
     */
    public function setAnswerCreated($answer_created)
    {
        if (is_null($answer_created)) {
            throw new \InvalidArgumentException('non-nullable answer_created cannot be null');
        }
        $this->container['answer_created'] = $answer_created;

        return $this;
    }

    /**
     * Gets additional_details
     *
     * @return \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner[]|null
     */
    public function getAdditionalDetails()
    {
        return $this->container['additional_details'];
    }

    /**
     * Sets additional_details
     *
     * @param \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadAdditionalDetailsInner[]|null $additional_details additional_details
     *
     * @return self
     */
    public function setAdditionalDetails($additional_details)
    {
        if (is_null($additional_details)) {
            throw new \InvalidArgumentException('non-nullable additional_details cannot be null');
        }
        $this->container['additional_details'] = $additional_details;

        return $this;
    }

    /**
     * Gets flow_history
     *
     * @return \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner[]|null
     */
    public function getFlowHistory()
    {
        return $this->container['flow_history'];
    }

    /**
     * Sets flow_history
     *
     * @param \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadFlowHistoryInner[]|null $flow_history Toto pole se zobrazuje jen pokud je parametr view=\"extended\"
     *
     * @return self
     */
    public function setFlowHistory($flow_history)
    {
        if (is_null($flow_history)) {
            throw new \InvalidArgumentException('non-nullable flow_history cannot be null');
        }
        $this->container['flow_history'] = $flow_history;

        return $this;
    }

    /**
     * Gets interview_date
     *
     * @return \DateTime|null
     */
    public function getInterviewDate()
    {
        return $this->container['interview_date'];
    }

    /**
     * Sets interview_date
     *
     * @param \DateTime|null $interview_date interview_date
     *
     * @return self
     */
    public function setInterviewDate($interview_date)
    {
        if (is_null($interview_date)) {
            throw new \InvalidArgumentException('non-nullable interview_date cannot be null');
        }
        $this->container['interview_date'] = $interview_date;

        return $this;
    }

    /**
     * Gets date_response
     *
     * @return \DateTime|null
     */
    public function getDateResponse()
    {
        return $this->container['date_response'];
    }

    /**
     * Sets date_response
     *
     * @param \DateTime|null $date_response date_response
     *
     * @return self
     */
    public function setDateResponse($date_response)
    {
        if (is_null($date_response)) {
            throw new \InvalidArgumentException('non-nullable date_response cannot be null');
        }
        $this->container['date_response'] = $date_response;

        return $this;
    }

    /**
     * Gets requirements
     *
     * @return \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadRequirements|null
     */
    public function getRequirements()
    {
        return $this->container['requirements'];
    }

    /**
     * Sets requirements
     *
     * @param \App\Module\RecruitisApi\Model\AnswersAnswerIdGet200ResponsePayloadRequirements|null $requirements requirements
     *
     * @return self
     */
    public function setRequirements($requirements)
    {
        if (is_null($requirements)) {
            throw new \InvalidArgumentException('non-nullable requirements cannot be null');
        }
        $this->container['requirements'] = $requirements;

        return $this;
    }

    /**
     * Gets job_details
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerJobDetails|null
     */
    public function getJobDetails()
    {
        return $this->container['job_details'];
    }

    /**
     * Sets job_details
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerJobDetails|null $job_details job_details
     *
     * @return self
     */
    public function setJobDetails($job_details)
    {
        if (is_null($job_details)) {
            throw new \InvalidArgumentException('non-nullable job_details cannot be null');
        }
        $this->container['job_details'] = $job_details;

        return $this;
    }

    /**
     * Gets source
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSource|null
     */
    public function getSource()
    {
        return $this->container['source'];
    }

    /**
     * Sets source
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerSource|null $source source
     *
     * @return self
     */
    public function setSource($source)
    {
        if (is_null($source)) {
            throw new \InvalidArgumentException('non-nullable source cannot be null');
        }
        $this->container['source'] = $source;

        return $this;
    }

    /**
     * Gets attachment_list
     *
     * @return \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner[]|null
     */
    public function getAttachmentList()
    {
        return $this->container['attachment_list'];
    }

    /**
     * Sets attachment_list
     *
     * @param \App\Module\RecruitisApi\Model\AnswersGet200ResponseOneOf1PayloadInnerAttachmentListInner[]|null $attachment_list attachment_list
     *
     * @return self
     */
    public function setAttachmentList($attachment_list)
    {
        if (is_null($attachment_list)) {
            throw new \InvalidArgumentException('non-nullable attachment_list cannot be null');
        }
        $this->container['attachment_list'] = $attachment_list;

        return $this;
    }

    /**
     * Gets cover_letter
     *
     * @return string|null
     */
    public function getCoverLetter()
    {
        return $this->container['cover_letter'];
    }

    /**
     * Sets cover_letter
     *
     * @param string|null $cover_letter cover_letter
     *
     * @return self
     */
    public function setCoverLetter($cover_letter)
    {
        if (is_null($cover_letter)) {
            throw new \InvalidArgumentException('non-nullable cover_letter cannot be null');
        }
        $this->container['cover_letter'] = $cover_letter;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


