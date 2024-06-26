<?php
/**
 * ReportsGet200ResponsePayloadJobsInner
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
 * ReportsGet200ResponsePayloadJobsInner Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ReportsGet200ResponsePayloadJobsInner implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = '_reports_get_200_response_payload_jobs_inner';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'job_id' => 'int',
        'job_title' => 'string',
        'job_description' => 'string',
        'date_created' => '\DateTime',
        'date_closed' => '\DateTime',
        'closed_duration' => 'int',
        'author_id' => 'int',
        'author_name' => 'string',
        'contact_name' => 'string',
        'contact_email' => 'string',
        'contact_phone' => 'string',
        'office_id' => 'int',
        'office_name' => 'string',
        'stats_views' => 'int',
        'stats_answers' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'job_id' => null,
        'job_title' => null,
        'job_description' => null,
        'date_created' => 'date-time',
        'date_closed' => 'date-time',
        'closed_duration' => null,
        'author_id' => null,
        'author_name' => null,
        'contact_name' => null,
        'contact_email' => 'email',
        'contact_phone' => null,
        'office_id' => null,
        'office_name' => null,
        'stats_views' => null,
        'stats_answers' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'job_id' => false,
        'job_title' => false,
        'job_description' => false,
        'date_created' => false,
        'date_closed' => false,
        'closed_duration' => false,
        'author_id' => false,
        'author_name' => false,
        'contact_name' => false,
        'contact_email' => false,
        'contact_phone' => false,
        'office_id' => false,
        'office_name' => false,
        'stats_views' => false,
        'stats_answers' => false
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
        'id' => 'ID',
        'job_id' => 'JobID',
        'job_title' => 'JobTitle',
        'job_description' => 'JobDescription',
        'date_created' => 'DateCreated',
        'date_closed' => 'DateClosed',
        'closed_duration' => 'ClosedDuration',
        'author_id' => 'AuthorID',
        'author_name' => 'AuthorName',
        'contact_name' => 'ContactName',
        'contact_email' => 'ContactEmail',
        'contact_phone' => 'ContactPhone',
        'office_id' => 'OfficeID',
        'office_name' => 'OfficeName',
        'stats_views' => 'StatsViews',
        'stats_answers' => 'StatsAnswers'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'job_id' => 'setJobId',
        'job_title' => 'setJobTitle',
        'job_description' => 'setJobDescription',
        'date_created' => 'setDateCreated',
        'date_closed' => 'setDateClosed',
        'closed_duration' => 'setClosedDuration',
        'author_id' => 'setAuthorId',
        'author_name' => 'setAuthorName',
        'contact_name' => 'setContactName',
        'contact_email' => 'setContactEmail',
        'contact_phone' => 'setContactPhone',
        'office_id' => 'setOfficeId',
        'office_name' => 'setOfficeName',
        'stats_views' => 'setStatsViews',
        'stats_answers' => 'setStatsAnswers'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'job_id' => 'getJobId',
        'job_title' => 'getJobTitle',
        'job_description' => 'getJobDescription',
        'date_created' => 'getDateCreated',
        'date_closed' => 'getDateClosed',
        'closed_duration' => 'getClosedDuration',
        'author_id' => 'getAuthorId',
        'author_name' => 'getAuthorName',
        'contact_name' => 'getContactName',
        'contact_email' => 'getContactEmail',
        'contact_phone' => 'getContactPhone',
        'office_id' => 'getOfficeId',
        'office_name' => 'getOfficeName',
        'stats_views' => 'getStatsViews',
        'stats_answers' => 'getStatsAnswers'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('job_id', $data ?? [], null);
        $this->setIfExists('job_title', $data ?? [], null);
        $this->setIfExists('job_description', $data ?? [], null);
        $this->setIfExists('date_created', $data ?? [], null);
        $this->setIfExists('date_closed', $data ?? [], null);
        $this->setIfExists('closed_duration', $data ?? [], null);
        $this->setIfExists('author_id', $data ?? [], null);
        $this->setIfExists('author_name', $data ?? [], null);
        $this->setIfExists('contact_name', $data ?? [], null);
        $this->setIfExists('contact_email', $data ?? [], null);
        $this->setIfExists('contact_phone', $data ?? [], null);
        $this->setIfExists('office_id', $data ?? [], null);
        $this->setIfExists('office_name', $data ?? [], null);
        $this->setIfExists('stats_views', $data ?? [], null);
        $this->setIfExists('stats_answers', $data ?? [], null);
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
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

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
     * @param int|null $job_id job_id
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
     * Gets job_title
     *
     * @return string|null
     */
    public function getJobTitle()
    {
        return $this->container['job_title'];
    }

    /**
     * Sets job_title
     *
     * @param string|null $job_title job_title
     *
     * @return self
     */
    public function setJobTitle($job_title)
    {
        if (is_null($job_title)) {
            throw new \InvalidArgumentException('non-nullable job_title cannot be null');
        }
        $this->container['job_title'] = $job_title;

        return $this;
    }

    /**
     * Gets job_description
     *
     * @return string|null
     */
    public function getJobDescription()
    {
        return $this->container['job_description'];
    }

    /**
     * Sets job_description
     *
     * @param string|null $job_description job_description
     *
     * @return self
     */
    public function setJobDescription($job_description)
    {
        if (is_null($job_description)) {
            throw new \InvalidArgumentException('non-nullable job_description cannot be null');
        }
        $this->container['job_description'] = $job_description;

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
     * @param \DateTime|null $date_created date_created
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
            throw new \InvalidArgumentException('non-nullable date_closed cannot be null');
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
     * @param int|null $closed_duration closed_duration
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
     * Gets author_id
     *
     * @return int|null
     */
    public function getAuthorId()
    {
        return $this->container['author_id'];
    }

    /**
     * Sets author_id
     *
     * @param int|null $author_id author_id
     *
     * @return self
     */
    public function setAuthorId($author_id)
    {
        if (is_null($author_id)) {
            throw new \InvalidArgumentException('non-nullable author_id cannot be null');
        }
        $this->container['author_id'] = $author_id;

        return $this;
    }

    /**
     * Gets author_name
     *
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->container['author_name'];
    }

    /**
     * Sets author_name
     *
     * @param string|null $author_name author_name
     *
     * @return self
     */
    public function setAuthorName($author_name)
    {
        if (is_null($author_name)) {
            throw new \InvalidArgumentException('non-nullable author_name cannot be null');
        }
        $this->container['author_name'] = $author_name;

        return $this;
    }

    /**
     * Gets contact_name
     *
     * @return string|null
     */
    public function getContactName()
    {
        return $this->container['contact_name'];
    }

    /**
     * Sets contact_name
     *
     * @param string|null $contact_name contact_name
     *
     * @return self
     */
    public function setContactName($contact_name)
    {
        if (is_null($contact_name)) {
            throw new \InvalidArgumentException('non-nullable contact_name cannot be null');
        }
        $this->container['contact_name'] = $contact_name;

        return $this;
    }

    /**
     * Gets contact_email
     *
     * @return string|null
     */
    public function getContactEmail()
    {
        return $this->container['contact_email'];
    }

    /**
     * Sets contact_email
     *
     * @param string|null $contact_email contact_email
     *
     * @return self
     */
    public function setContactEmail($contact_email)
    {
        if (is_null($contact_email)) {
            throw new \InvalidArgumentException('non-nullable contact_email cannot be null');
        }
        $this->container['contact_email'] = $contact_email;

        return $this;
    }

    /**
     * Gets contact_phone
     *
     * @return string|null
     */
    public function getContactPhone()
    {
        return $this->container['contact_phone'];
    }

    /**
     * Sets contact_phone
     *
     * @param string|null $contact_phone contact_phone
     *
     * @return self
     */
    public function setContactPhone($contact_phone)
    {
        if (is_null($contact_phone)) {
            throw new \InvalidArgumentException('non-nullable contact_phone cannot be null');
        }
        $this->container['contact_phone'] = $contact_phone;

        return $this;
    }

    /**
     * Gets office_id
     *
     * @return int|null
     */
    public function getOfficeId()
    {
        return $this->container['office_id'];
    }

    /**
     * Sets office_id
     *
     * @param int|null $office_id office_id
     *
     * @return self
     */
    public function setOfficeId($office_id)
    {
        if (is_null($office_id)) {
            throw new \InvalidArgumentException('non-nullable office_id cannot be null');
        }
        $this->container['office_id'] = $office_id;

        return $this;
    }

    /**
     * Gets office_name
     *
     * @return string|null
     */
    public function getOfficeName()
    {
        return $this->container['office_name'];
    }

    /**
     * Sets office_name
     *
     * @param string|null $office_name office_name
     *
     * @return self
     */
    public function setOfficeName($office_name)
    {
        if (is_null($office_name)) {
            throw new \InvalidArgumentException('non-nullable office_name cannot be null');
        }
        $this->container['office_name'] = $office_name;

        return $this;
    }

    /**
     * Gets stats_views
     *
     * @return int|null
     */
    public function getStatsViews()
    {
        return $this->container['stats_views'];
    }

    /**
     * Sets stats_views
     *
     * @param int|null $stats_views stats_views
     *
     * @return self
     */
    public function setStatsViews($stats_views)
    {
        if (is_null($stats_views)) {
            throw new \InvalidArgumentException('non-nullable stats_views cannot be null');
        }
        $this->container['stats_views'] = $stats_views;

        return $this;
    }

    /**
     * Gets stats_answers
     *
     * @return int|null
     */
    public function getStatsAnswers()
    {
        return $this->container['stats_answers'];
    }

    /**
     * Sets stats_answers
     *
     * @param int|null $stats_answers stats_answers
     *
     * @return self
     */
    public function setStatsAnswers($stats_answers)
    {
        if (is_null($stats_answers)) {
            throw new \InvalidArgumentException('non-nullable stats_answers cannot be null');
        }
        $this->container['stats_answers'] = $stats_answers;

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


