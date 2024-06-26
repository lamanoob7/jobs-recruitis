<?php
/**
 * Job
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
 * Job Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Job implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Job';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'job_id' => 'int',
        'secured_id' => 'string',
        'public_id' => 'string',
        'access_state' => 'int',
        'draft' => 'bool',
        'active' => 'bool',
        'title' => 'string',
        'description' => 'string',
        'internal_note_' => 'string',
        'date_end' => '\DateTime',
        'date_closed' => '\DateTime',
        'closed_duration' => 'int',
        'last_update' => '\DateTime',
        'date_created' => '\DateTime',
        'text_language' => 'string',
        'fte' => '\App\Module\RecruitisApi\Model\JobFte',
        'workfields' => '\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]',
        'filterlist' => '\App\Module\RecruitisApi\Model\JobFilterlistInner[]',
        'education' => '\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]',
        'disability' => 'bool',
        'details' => '\App\Module\RecruitisApi\Model\JobDetails',
        'personalist' => '\App\Module\RecruitisApi\Model\JobPersonalist',
        'contact' => '\App\Module\RecruitisApi\Model\Contact',
        'sharing' => '\App\Module\RecruitisApi\Model\Employee[]',
        'addresses' => '\App\Module\RecruitisApi\Model\Address[]',
        'employment' => '\App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]',
        'stats' => '\App\Module\RecruitisApi\Model\JobStats',
        'salary' => '\App\Module\RecruitisApi\Model\JobSalary',
        'channels' => '\App\Module\RecruitisApi\Model\JobChannels',
        'edit_link' => 'string',
        'public_link' => 'string',
        'referrals' => '\App\Module\RecruitisApi\Model\JobReferralsInner[]',
        'automations' => '\App\Module\RecruitisApi\Model\Automation[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'job_id' => null,
        'secured_id' => null,
        'public_id' => null,
        'access_state' => null,
        'draft' => null,
        'active' => null,
        'title' => null,
        'description' => null,
        'internal_note_' => null,
        'date_end' => 'date',
        'date_closed' => 'date',
        'closed_duration' => null,
        'last_update' => 'date-time',
        'date_created' => 'date-time',
        'text_language' => null,
        'fte' => null,
        'workfields' => null,
        'filterlist' => null,
        'education' => null,
        'disability' => null,
        'details' => null,
        'personalist' => null,
        'contact' => null,
        'sharing' => null,
        'addresses' => null,
        'employment' => null,
        'stats' => null,
        'salary' => null,
        'channels' => null,
        'edit_link' => null,
        'public_link' => null,
        'referrals' => null,
        'automations' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'job_id' => false,
        'secured_id' => false,
        'public_id' => true,
        'access_state' => false,
        'draft' => false,
        'active' => false,
        'title' => false,
        'description' => false,
        'internal_note_' => false,
        'date_end' => true,
        'date_closed' => true,
        'closed_duration' => false,
        'last_update' => false,
        'date_created' => false,
        'text_language' => false,
        'fte' => true,
        'workfields' => false,
        'filterlist' => true,
        'education' => false,
        'disability' => true,
        'details' => true,
        'personalist' => false,
        'contact' => false,
        'sharing' => false,
        'addresses' => false,
        'employment' => false,
        'stats' => false,
        'salary' => false,
        'channels' => false,
        'edit_link' => false,
        'public_link' => false,
        'referrals' => false,
        'automations' => false
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
        'job_id' => 'job_id',
        'secured_id' => 'secured_id',
        'public_id' => 'public_id',
        'access_state' => 'access_state',
        'draft' => 'draft',
        'active' => 'active',
        'title' => 'title',
        'description' => 'description',
        'internal_note_' => 'internal_note|',
        'date_end' => 'date_end',
        'date_closed' => 'date_closed',
        'closed_duration' => 'closed_duration',
        'last_update' => 'last_update',
        'date_created' => 'date_created',
        'text_language' => 'text_language',
        'fte' => 'fte',
        'workfields' => 'workfields',
        'filterlist' => 'filterlist',
        'education' => 'education',
        'disability' => 'disability',
        'details' => 'details',
        'personalist' => 'personalist',
        'contact' => 'contact',
        'sharing' => 'sharing',
        'addresses' => 'addresses',
        'employment' => 'employment',
        'stats' => 'stats',
        'salary' => 'salary',
        'channels' => 'channels',
        'edit_link' => 'edit_link',
        'public_link' => 'public_link',
        'referrals' => 'referrals',
        'automations' => 'automations'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'job_id' => 'setJobId',
        'secured_id' => 'setSecuredId',
        'public_id' => 'setPublicId',
        'access_state' => 'setAccessState',
        'draft' => 'setDraft',
        'active' => 'setActive',
        'title' => 'setTitle',
        'description' => 'setDescription',
        'internal_note_' => 'setInternalNote',
        'date_end' => 'setDateEnd',
        'date_closed' => 'setDateClosed',
        'closed_duration' => 'setClosedDuration',
        'last_update' => 'setLastUpdate',
        'date_created' => 'setDateCreated',
        'text_language' => 'setTextLanguage',
        'fte' => 'setFte',
        'workfields' => 'setWorkfields',
        'filterlist' => 'setFilterlist',
        'education' => 'setEducation',
        'disability' => 'setDisability',
        'details' => 'setDetails',
        'personalist' => 'setPersonalist',
        'contact' => 'setContact',
        'sharing' => 'setSharing',
        'addresses' => 'setAddresses',
        'employment' => 'setEmployment',
        'stats' => 'setStats',
        'salary' => 'setSalary',
        'channels' => 'setChannels',
        'edit_link' => 'setEditLink',
        'public_link' => 'setPublicLink',
        'referrals' => 'setReferrals',
        'automations' => 'setAutomations'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'job_id' => 'getJobId',
        'secured_id' => 'getSecuredId',
        'public_id' => 'getPublicId',
        'access_state' => 'getAccessState',
        'draft' => 'getDraft',
        'active' => 'getActive',
        'title' => 'getTitle',
        'description' => 'getDescription',
        'internal_note_' => 'getInternalNote',
        'date_end' => 'getDateEnd',
        'date_closed' => 'getDateClosed',
        'closed_duration' => 'getClosedDuration',
        'last_update' => 'getLastUpdate',
        'date_created' => 'getDateCreated',
        'text_language' => 'getTextLanguage',
        'fte' => 'getFte',
        'workfields' => 'getWorkfields',
        'filterlist' => 'getFilterlist',
        'education' => 'getEducation',
        'disability' => 'getDisability',
        'details' => 'getDetails',
        'personalist' => 'getPersonalist',
        'contact' => 'getContact',
        'sharing' => 'getSharing',
        'addresses' => 'getAddresses',
        'employment' => 'getEmployment',
        'stats' => 'getStats',
        'salary' => 'getSalary',
        'channels' => 'getChannels',
        'edit_link' => 'getEditLink',
        'public_link' => 'getPublicLink',
        'referrals' => 'getReferrals',
        'automations' => 'getAutomations'
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

    public const ACCESS_STATE_1 = 1;
    public const ACCESS_STATE_2 = 2;
    public const ACCESS_STATE_3 = 3;
    public const ACCESS_STATE_4 = 4;
    public const ACCESS_STATE_5 = 5;
    public const TEXT_LANGUAGE_CS = 'cs';
    public const TEXT_LANGUAGE_SK = 'sk';
    public const TEXT_LANGUAGE_EN = 'en';
    public const TEXT_LANGUAGE_DE = 'de';
    public const TEXT_LANGUAGE_RO = 'ro';
    public const TEXT_LANGUAGE_BG = 'bg';
    public const TEXT_LANGUAGE_HU = 'hu';
    public const TEXT_LANGUAGE_PL = 'pl';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccessStateAllowableValues()
    {
        return [
            self::ACCESS_STATE_1,
            self::ACCESS_STATE_2,
            self::ACCESS_STATE_3,
            self::ACCESS_STATE_4,
            self::ACCESS_STATE_5,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTextLanguageAllowableValues()
    {
        return [
            self::TEXT_LANGUAGE_CS,
            self::TEXT_LANGUAGE_SK,
            self::TEXT_LANGUAGE_EN,
            self::TEXT_LANGUAGE_DE,
            self::TEXT_LANGUAGE_RO,
            self::TEXT_LANGUAGE_BG,
            self::TEXT_LANGUAGE_HU,
            self::TEXT_LANGUAGE_PL,
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
        $this->setIfExists('job_id', $data ?? [], null);
        $this->setIfExists('secured_id', $data ?? [], null);
        $this->setIfExists('public_id', $data ?? [], null);
        $this->setIfExists('access_state', $data ?? [], null);
        $this->setIfExists('draft', $data ?? [], null);
        $this->setIfExists('active', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('internal_note_', $data ?? [], null);
        $this->setIfExists('date_end', $data ?? [], null);
        $this->setIfExists('date_closed', $data ?? [], null);
        $this->setIfExists('closed_duration', $data ?? [], null);
        $this->setIfExists('last_update', $data ?? [], null);
        $this->setIfExists('date_created', $data ?? [], null);
        $this->setIfExists('text_language', $data ?? [], null);
        $this->setIfExists('fte', $data ?? [], null);
        $this->setIfExists('workfields', $data ?? [], null);
        $this->setIfExists('filterlist', $data ?? [], null);
        $this->setIfExists('education', $data ?? [], null);
        $this->setIfExists('disability', $data ?? [], null);
        $this->setIfExists('details', $data ?? [], null);
        $this->setIfExists('personalist', $data ?? [], null);
        $this->setIfExists('contact', $data ?? [], null);
        $this->setIfExists('sharing', $data ?? [], null);
        $this->setIfExists('addresses', $data ?? [], null);
        $this->setIfExists('employment', $data ?? [], null);
        $this->setIfExists('stats', $data ?? [], null);
        $this->setIfExists('salary', $data ?? [], null);
        $this->setIfExists('channels', $data ?? [], null);
        $this->setIfExists('edit_link', $data ?? [], null);
        $this->setIfExists('public_link', $data ?? [], null);
        $this->setIfExists('referrals', $data ?? [], null);
        $this->setIfExists('automations', $data ?? [], null);
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

        $allowedValues = $this->getAccessStateAllowableValues();
        if (!is_null($this->container['access_state']) && !in_array($this->container['access_state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'access_state', must be one of '%s'",
                $this->container['access_state'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTextLanguageAllowableValues();
        if (!is_null($this->container['text_language']) && !in_array($this->container['text_language'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'text_language', must be one of '%s'",
                $this->container['text_language'],
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
     * Gets secured_id
     *
     * @return string|null
     */
    public function getSecuredId()
    {
        return $this->container['secured_id'];
    }

    /**
     * Sets secured_id
     *
     * @param string|null $secured_id secured_id
     *
     * @return self
     */
    public function setSecuredId($secured_id)
    {
        if (is_null($secured_id)) {
            throw new \InvalidArgumentException('non-nullable secured_id cannot be null');
        }
        $this->container['secured_id'] = $secured_id;

        return $this;
    }

    /**
     * Gets public_id
     *
     * @return string|null
     */
    public function getPublicId()
    {
        return $this->container['public_id'];
    }

    /**
     * Sets public_id
     *
     * @param string|null $public_id Interní označení inzerátu. Nemusí být vyplněné
     *
     * @return self
     */
    public function setPublicId($public_id)
    {
        if (is_null($public_id)) {
            array_push($this->openAPINullablesSetToNull, 'public_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('public_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['public_id'] = $public_id;

        return $this;
    }

    /**
     * Gets access_state
     *
     * @return int|null
     */
    public function getAccessState()
    {
        return $this->container['access_state'];
    }

    /**
     * Sets access_state
     *
     * @param int|null $access_state Značení o jaký typ pozice se jedná. Viz. acces_state parametr
     *
     * @return self
     */
    public function setAccessState($access_state)
    {
        if (is_null($access_state)) {
            throw new \InvalidArgumentException('non-nullable access_state cannot be null');
        }
        $allowedValues = $this->getAccessStateAllowableValues();
        if (!in_array($access_state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'access_state', must be one of '%s'",
                    $access_state,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['access_state'] = $access_state;

        return $this;
    }

    /**
     * Gets draft
     *
     * @return bool|null
     */
    public function getDraft()
    {
        return $this->container['draft'];
    }

    /**
     * Sets draft
     *
     * @param bool|null $draft Značí jestli je inzerát zveřejněný, nebo jen rozepsaný.
     *
     * @return self
     */
    public function setDraft($draft)
    {
        if (is_null($draft)) {
            throw new \InvalidArgumentException('non-nullable draft cannot be null');
        }
        $this->container['draft'] = $draft;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active Atribut active ve výpisu inzerátů značí, jestli je daný inzerát aktivní, to jest, že je právě v tuto chvíli někde publikován a zároveň není pozastaven.
     *
     * @return self
     */
    public function setActive($active)
    {
        if (is_null($active)) {
            throw new \InvalidArgumentException('non-nullable active cannot be null');
        }
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title title
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
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets internal_note_
     *
     * @return string|null
     */
    public function getInternalNote()
    {
        return $this->container['internal_note_'];
    }

    /**
     * Sets internal_note_
     *
     * @param string|null $internal_note_ internal_note_
     *
     * @return self
     */
    public function setInternalNote($internal_note_)
    {
        if (is_null($internal_note_)) {
            throw new \InvalidArgumentException('non-nullable internal_note_ cannot be null');
        }
        $this->container['internal_note_'] = $internal_note_;

        return $this;
    }

    /**
     * Gets date_end
     *
     * @return \DateTime|null
     */
    public function getDateEnd()
    {
        return $this->container['date_end'];
    }

    /**
     * Sets date_end
     *
     * @param \DateTime|null $date_end Nyní date_closed
     *
     * @return self
     */
    public function setDateEnd($date_end)
    {
        if (is_null($date_end)) {
            array_push($this->openAPINullablesSetToNull, 'date_end');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_end', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_end'] = $date_end;

        return $this;
    }

    /**
     * Gets date_closed
     *
     * @return \DateTime|null
     */
    public function getDateClosed()
    {
        return $this->container['date_closed'];
    }

    /**
     * Sets date_closed
     *
     * @param \DateTime|null $date_closed date_closed
     *
     * @return self
     */
    public function setDateClosed($date_closed)
    {
        if (is_null($date_closed)) {
            array_push($this->openAPINullablesSetToNull, 'date_closed');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_closed', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_closed'] = $date_closed;

        return $this;
    }

    /**
     * Gets closed_duration
     *
     * @return int|null
     */
    public function getClosedDuration()
    {
        return $this->container['closed_duration'];
    }

    /**
     * Sets closed_duration
     *
     * @param int|null $closed_duration Počet sekund od uzavření.
     *
     * @return self
     */
    public function setClosedDuration($closed_duration)
    {
        if (is_null($closed_duration)) {
            throw new \InvalidArgumentException('non-nullable closed_duration cannot be null');
        }
        $this->container['closed_duration'] = $closed_duration;

        return $this;
    }

    /**
     * Gets last_update
     *
     * @return \DateTime|null
     */
    public function getLastUpdate()
    {
        return $this->container['last_update'];
    }

    /**
     * Sets last_update
     *
     * @param \DateTime|null $last_update Datum, kdy byl inzerát naposledy upraven. Formát YYYY-mm-dd HH:mm:ss
     *
     * @return self
     */
    public function setLastUpdate($last_update)
    {
        if (is_null($last_update)) {
            throw new \InvalidArgumentException('non-nullable last_update cannot be null');
        }
        $this->container['last_update'] = $last_update;

        return $this;
    }

    /**
     * Gets date_created
     *
     * @return \DateTime|null
     */
    public function getDateCreated()
    {
        return $this->container['date_created'];
    }

    /**
     * Sets date_created
     *
     * @param \DateTime|null $date_created Formát YYYY-mm-dd HH:mm:ss
     *
     * @return self
     */
    public function setDateCreated($date_created)
    {
        if (is_null($date_created)) {
            throw new \InvalidArgumentException('non-nullable date_created cannot be null');
        }
        $this->container['date_created'] = $date_created;

        return $this;
    }

    /**
     * Gets text_language
     *
     * @return string|null
     */
    public function getTextLanguage()
    {
        return $this->container['text_language'];
    }

    /**
     * Sets text_language
     *
     * @param string|null $text_language text_language
     *
     * @return self
     */
    public function setTextLanguage($text_language)
    {
        if (is_null($text_language)) {
            throw new \InvalidArgumentException('non-nullable text_language cannot be null');
        }
        $allowedValues = $this->getTextLanguageAllowableValues();
        if (!in_array($text_language, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'text_language', must be one of '%s'",
                    $text_language,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['text_language'] = $text_language;

        return $this;
    }

    /**
     * Gets fte
     *
     * @return \App\Module\RecruitisApi\Model\JobFte|null
     */
    public function getFte()
    {
        return $this->container['fte'];
    }

    /**
     * Sets fte
     *
     * @param \App\Module\RecruitisApi\Model\JobFte|null $fte fte
     *
     * @return self
     */
    public function setFte($fte)
    {
        if (is_null($fte)) {
            array_push($this->openAPINullablesSetToNull, 'fte');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('fte', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['fte'] = $fte;

        return $this;
    }

    /**
     * Gets workfields
     *
     * @return \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null
     */
    public function getWorkfields()
    {
        return $this->container['workfields'];
    }

    /**
     * Sets workfields
     *
     * @param \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null $workfields workfields
     *
     * @return self
     */
    public function setWorkfields($workfields)
    {
        if (is_null($workfields)) {
            throw new \InvalidArgumentException('non-nullable workfields cannot be null');
        }
        $this->container['workfields'] = $workfields;

        return $this;
    }

    /**
     * Gets filterlist
     *
     * @return \App\Module\RecruitisApi\Model\JobFilterlistInner[]|null
     */
    public function getFilterlist()
    {
        return $this->container['filterlist'];
    }

    /**
     * Sets filterlist
     *
     * @param \App\Module\RecruitisApi\Model\JobFilterlistInner[]|null $filterlist filterlist
     *
     * @return self
     */
    public function setFilterlist($filterlist)
    {
        if (is_null($filterlist)) {
            array_push($this->openAPINullablesSetToNull, 'filterlist');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('filterlist', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['filterlist'] = $filterlist;

        return $this;
    }

    /**
     * Gets education
     *
     * @return \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null
     */
    public function getEducation()
    {
        return $this->container['education'];
    }

    /**
     * Sets education
     *
     * @param \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null $education education
     *
     * @return self
     */
    public function setEducation($education)
    {
        if (is_null($education)) {
            throw new \InvalidArgumentException('non-nullable education cannot be null');
        }
        $this->container['education'] = $education;

        return $this;
    }

    /**
     * Gets disability
     *
     * @return bool|null
     */
    public function getDisability()
    {
        return $this->container['disability'];
    }

    /**
     * Sets disability
     *
     * @param bool|null $disability disability
     *
     * @return self
     */
    public function setDisability($disability)
    {
        if (is_null($disability)) {
            array_push($this->openAPINullablesSetToNull, 'disability');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('disability', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['disability'] = $disability;

        return $this;
    }

    /**
     * Gets details
     *
     * @return \App\Module\RecruitisApi\Model\JobDetails|null
     */
    public function getDetails()
    {
        return $this->container['details'];
    }

    /**
     * Sets details
     *
     * @param \App\Module\RecruitisApi\Model\JobDetails|null $details details
     *
     * @return self
     */
    public function setDetails($details)
    {
        if (is_null($details)) {
            array_push($this->openAPINullablesSetToNull, 'details');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('details', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['details'] = $details;

        return $this;
    }

    /**
     * Gets personalist
     *
     * @return \App\Module\RecruitisApi\Model\JobPersonalist|null
     */
    public function getPersonalist()
    {
        return $this->container['personalist'];
    }

    /**
     * Sets personalist
     *
     * @param \App\Module\RecruitisApi\Model\JobPersonalist|null $personalist personalist
     *
     * @return self
     */
    public function setPersonalist($personalist)
    {
        if (is_null($personalist)) {
            throw new \InvalidArgumentException('non-nullable personalist cannot be null');
        }
        $this->container['personalist'] = $personalist;

        return $this;
    }

    /**
     * Gets contact
     *
     * @return \App\Module\RecruitisApi\Model\Contact|null
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \App\Module\RecruitisApi\Model\Contact|null $contact contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        if (is_null($contact)) {
            throw new \InvalidArgumentException('non-nullable contact cannot be null');
        }
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets sharing
     *
     * @return \App\Module\RecruitisApi\Model\Employee[]|null
     */
    public function getSharing()
    {
        return $this->container['sharing'];
    }

    /**
     * Sets sharing
     *
     * @param \App\Module\RecruitisApi\Model\Employee[]|null $sharing sharing
     *
     * @return self
     */
    public function setSharing($sharing)
    {
        if (is_null($sharing)) {
            throw new \InvalidArgumentException('non-nullable sharing cannot be null');
        }
        $this->container['sharing'] = $sharing;

        return $this;
    }

    /**
     * Gets addresses
     *
     * @return \App\Module\RecruitisApi\Model\Address[]|null
     */
    public function getAddresses()
    {
        return $this->container['addresses'];
    }

    /**
     * Sets addresses
     *
     * @param \App\Module\RecruitisApi\Model\Address[]|null $addresses addresses
     *
     * @return self
     */
    public function setAddresses($addresses)
    {
        if (is_null($addresses)) {
            throw new \InvalidArgumentException('non-nullable addresses cannot be null');
        }
        $this->container['addresses'] = $addresses;

        return $this;
    }

    /**
     * Gets employment
     *
     * @return \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null
     */
    public function getEmployment()
    {
        return $this->container['employment'];
    }

    /**
     * Sets employment
     *
     * @param \App\Module\RecruitisApi\Model\EnumsWorkfieldsGet200ResponseOneOfPayloadInnerProfessionsInner[]|null $employment Typ pracovního úvazku.
     *
     * @return self
     */
    public function setEmployment($employment)
    {
        if (is_null($employment)) {
            throw new \InvalidArgumentException('non-nullable employment cannot be null');
        }
        $this->container['employment'] = $employment;

        return $this;
    }

    /**
     * Gets stats
     *
     * @return \App\Module\RecruitisApi\Model\JobStats|null
     */
    public function getStats()
    {
        return $this->container['stats'];
    }

    /**
     * Sets stats
     *
     * @param \App\Module\RecruitisApi\Model\JobStats|null $stats stats
     *
     * @return self
     */
    public function setStats($stats)
    {
        if (is_null($stats)) {
            throw new \InvalidArgumentException('non-nullable stats cannot be null');
        }
        $this->container['stats'] = $stats;

        return $this;
    }

    /**
     * Gets salary
     *
     * @return \App\Module\RecruitisApi\Model\JobSalary|null
     */
    public function getSalary()
    {
        return $this->container['salary'];
    }

    /**
     * Sets salary
     *
     * @param \App\Module\RecruitisApi\Model\JobSalary|null $salary salary
     *
     * @return self
     */
    public function setSalary($salary)
    {
        if (is_null($salary)) {
            throw new \InvalidArgumentException('non-nullable salary cannot be null');
        }
        $this->container['salary'] = $salary;

        return $this;
    }

    /**
     * Gets channels
     *
     * @return \App\Module\RecruitisApi\Model\JobChannels|null
     */
    public function getChannels()
    {
        return $this->container['channels'];
    }

    /**
     * Sets channels
     *
     * @param \App\Module\RecruitisApi\Model\JobChannels|null $channels channels
     *
     * @return self
     */
    public function setChannels($channels)
    {
        if (is_null($channels)) {
            throw new \InvalidArgumentException('non-nullable channels cannot be null');
        }
        $this->container['channels'] = $channels;

        return $this;
    }

    /**
     * Gets edit_link
     *
     * @return string|null
     */
    public function getEditLink()
    {
        return $this->container['edit_link'];
    }

    /**
     * Sets edit_link
     *
     * @param string|null $edit_link edit_link
     *
     * @return self
     */
    public function setEditLink($edit_link)
    {
        if (is_null($edit_link)) {
            throw new \InvalidArgumentException('non-nullable edit_link cannot be null');
        }
        $this->container['edit_link'] = $edit_link;

        return $this;
    }

    /**
     * Gets public_link
     *
     * @return string|null
     */
    public function getPublicLink()
    {
        return $this->container['public_link'];
    }

    /**
     * Sets public_link
     *
     * @param string|null $public_link public_link
     *
     * @return self
     */
    public function setPublicLink($public_link)
    {
        if (is_null($public_link)) {
            throw new \InvalidArgumentException('non-nullable public_link cannot be null');
        }
        $this->container['public_link'] = $public_link;

        return $this;
    }

    /**
     * Gets referrals
     *
     * @return \App\Module\RecruitisApi\Model\JobReferralsInner[]|null
     */
    public function getReferrals()
    {
        return $this->container['referrals'];
    }

    /**
     * Sets referrals
     *
     * @param \App\Module\RecruitisApi\Model\JobReferralsInner[]|null $referrals referrals
     *
     * @return self
     */
    public function setReferrals($referrals)
    {
        if (is_null($referrals)) {
            throw new \InvalidArgumentException('non-nullable referrals cannot be null');
        }
        $this->container['referrals'] = $referrals;

        return $this;
    }

    /**
     * Gets automations
     *
     * @return \App\Module\RecruitisApi\Model\Automation[]|null
     */
    public function getAutomations()
    {
        return $this->container['automations'];
    }

    /**
     * Sets automations
     *
     * @param \App\Module\RecruitisApi\Model\Automation[]|null $automations automations
     *
     * @return self
     */
    public function setAutomations($automations)
    {
        if (is_null($automations)) {
            throw new \InvalidArgumentException('non-nullable automations cannot be null');
        }
        $this->container['automations'] = $automations;

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


