<?php
/**
 * JobsApi
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

namespace App\Module\RecruitisApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use App\Module\RecruitisApi\ApiException;
use App\Module\RecruitisApi\Configuration;
use App\Module\RecruitisApi\HeaderSelector;
use App\Module\RecruitisApi\ObjectSerializer;

/**
 * JobsApi Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class JobsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'jobsGet' => [
            'application/json',
        ],
        'jobsIdAccessPut' => [
            'application/json',
        ],
        'jobsIdAccessStateStatePut' => [
            'application/json',
        ],
        'jobsIdChannelChannelIdDelete' => [
            'application/json',
        ],
        'jobsIdChannelChannelIdPut' => [
            'application/json',
        ],
        'jobsIdChannelsGet' => [
            'application/json',
        ],
        'jobsIdCommunicationGet' => [
            'application/json',
        ],
        'jobsIdFormGet' => [
            'application/json',
        ],
        'jobsIdFormValidatePost' => [
            'application/json',
        ],
        'jobsIdGet' => [
            'application/json',
        ],
        'jobsIdRecommendApplicantPost' => [
            'application/json',
        ],
        'jobsPost' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation jobsGet
     *
     * Get all jobs
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  string $text_language Parametr filtruje pozice podle jazyku. (optional)
     * @param  int[] $workfield_id Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). (optional)
     * @param  int[] $office_id Filtrace podle ID poboček. (optional)
     * @param  int[] $filter_id Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  int[] $channel_id Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). (optional)
     * @param  string $order_by Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). (optional, default to 'date_created')
     * @param  bool $include_inactive Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. (optional, default to false) (deprecated)
     * @param  bool $only_deleted Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). (optional, default to false) (deprecated)
     * @param  int $status Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. (optional, default to 1) (deprecated)
     * @param  int $activity_state Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). (optional, default to 1)
     * @param  int $access_state Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. (optional)
     * @param  int $with_rewards Zobrazí inzeráty, na které se váže refferal odměna. (optional)
     * @param  \DateTime $updated_from Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  \DateTime $updated_to Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response
     */
    public function jobsGet($limit = 10, $page = 1, $with_automation = null, $text_language = null, $workfield_id = null, $office_id = null, $filter_id = null, $channel_id = null, $order_by = 'date_created', $include_inactive = false, $only_deleted = false, $status = 1, $activity_state = 1, $access_state = null, $with_rewards = null, $updated_from = null, $updated_to = null, string $contentType = self::contentTypes['jobsGet'][0])
    {
        list($response) = $this->jobsGetWithHttpInfo($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to, $contentType);
        return $response;
    }

    /**
     * Operation jobsGetWithHttpInfo
     *
     * Get all jobs
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  string $text_language Parametr filtruje pozice podle jazyku. (optional)
     * @param  int[] $workfield_id Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). (optional)
     * @param  int[] $office_id Filtrace podle ID poboček. (optional)
     * @param  int[] $filter_id Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  int[] $channel_id Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). (optional)
     * @param  string $order_by Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). (optional, default to 'date_created')
     * @param  bool $include_inactive Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. (optional, default to false) (deprecated)
     * @param  bool $only_deleted Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). (optional, default to false) (deprecated)
     * @param  int $status Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. (optional, default to 1) (deprecated)
     * @param  int $activity_state Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). (optional, default to 1)
     * @param  int $access_state Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. (optional)
     * @param  int $with_rewards Zobrazí inzeráty, na které se váže refferal odměna. (optional)
     * @param  \DateTime $updated_from Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  \DateTime $updated_to Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsGetWithHttpInfo($limit = 10, $page = 1, $with_automation = null, $text_language = null, $workfield_id = null, $office_id = null, $filter_id = null, $channel_id = null, $order_by = 'date_created', $include_inactive = false, $only_deleted = false, $status = 1, $activity_state = 1, $access_state = null, $with_rewards = null, $updated_from = null, $updated_to = null, string $contentType = self::contentTypes['jobsGet'][0])
    {
        $request = $this->jobsGetRequest($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsGet200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\App\Module\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsGetAsync
     *
     * Get all jobs
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  string $text_language Parametr filtruje pozice podle jazyku. (optional)
     * @param  int[] $workfield_id Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). (optional)
     * @param  int[] $office_id Filtrace podle ID poboček. (optional)
     * @param  int[] $filter_id Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  int[] $channel_id Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). (optional)
     * @param  string $order_by Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). (optional, default to 'date_created')
     * @param  bool $include_inactive Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. (optional, default to false) (deprecated)
     * @param  bool $only_deleted Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). (optional, default to false) (deprecated)
     * @param  int $status Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. (optional, default to 1) (deprecated)
     * @param  int $activity_state Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). (optional, default to 1)
     * @param  int $access_state Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. (optional)
     * @param  int $with_rewards Zobrazí inzeráty, na které se váže refferal odměna. (optional)
     * @param  \DateTime $updated_from Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  \DateTime $updated_to Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsGetAsync($limit = 10, $page = 1, $with_automation = null, $text_language = null, $workfield_id = null, $office_id = null, $filter_id = null, $channel_id = null, $order_by = 'date_created', $include_inactive = false, $only_deleted = false, $status = 1, $activity_state = 1, $access_state = null, $with_rewards = null, $updated_from = null, $updated_to = null, string $contentType = self::contentTypes['jobsGet'][0])
    {
        return $this->jobsGetAsyncWithHttpInfo($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsGetAsyncWithHttpInfo
     *
     * Get all jobs
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  string $text_language Parametr filtruje pozice podle jazyku. (optional)
     * @param  int[] $workfield_id Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). (optional)
     * @param  int[] $office_id Filtrace podle ID poboček. (optional)
     * @param  int[] $filter_id Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  int[] $channel_id Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). (optional)
     * @param  string $order_by Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). (optional, default to 'date_created')
     * @param  bool $include_inactive Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. (optional, default to false) (deprecated)
     * @param  bool $only_deleted Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). (optional, default to false) (deprecated)
     * @param  int $status Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. (optional, default to 1) (deprecated)
     * @param  int $activity_state Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). (optional, default to 1)
     * @param  int $access_state Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. (optional)
     * @param  int $with_rewards Zobrazí inzeráty, na které se váže refferal odměna. (optional)
     * @param  \DateTime $updated_from Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  \DateTime $updated_to Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsGetAsyncWithHttpInfo($limit = 10, $page = 1, $with_automation = null, $text_language = null, $workfield_id = null, $office_id = null, $filter_id = null, $channel_id = null, $order_by = 'date_created', $include_inactive = false, $only_deleted = false, $status = 1, $activity_state = 1, $access_state = null, $with_rewards = null, $updated_from = null, $updated_to = null, string $contentType = self::contentTypes['jobsGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsGet200Response';
        $request = $this->jobsGetRequest($limit, $page, $with_automation, $text_language, $workfield_id, $office_id, $filter_id, $channel_id, $order_by, $include_inactive, $only_deleted, $status, $activity_state, $access_state, $with_rewards, $updated_from, $updated_to, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsGet'
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  string $text_language Parametr filtruje pozice podle jazyku. (optional)
     * @param  int[] $workfield_id Filtrace podle ID oborů (profesí). Více v [Enumerations - Workfields](#tag/Enumerations/paths/~1enums~1workfields/get). (optional)
     * @param  int[] $office_id Filtrace podle ID poboček. (optional)
     * @param  int[] $filter_id Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  int[] $channel_id Omezení na určité kanály. Více informací o kanálech vrací číselník, viz [Enumerations - Company channels](#tag/Enumerations/paths/~1enums~1channels/get). Pokud je parametr určen, pole se vrátí seřazené podle data přiřazení ke kanálu. Pokud není parametr určen, vrátí se všechny možné inzeráty (dle tokenu). (optional)
     * @param  string $order_by Defaultní řazení je dle data vytvoření (date_created). Další možností řazení je podle data přiřazení do publikačního kanálu (date_channel_assigned). (optional, default to 'date_created')
     * @param  bool $include_inactive Vyžaduje full_access token. Pokud chcete, aby systém vrátil i pozastavené / staré inzeráty, vložte tento parametr s hodnotou 1. (optional, default to false) (deprecated)
     * @param  bool $only_deleted Vyžaduje full_access token. Pokud chcete, aby systém vrátil POUZE smazané inzeráty. V tento moment systém vrátí ale payload pouze s job_id parametrem (payload: [{job_id:1234},{job_id:5678}]). (optional, default to false) (deprecated)
     * @param  int $status Vyžaduje full_access token. Parametr se chová jako bitmapa. 1 &#x3D; aktivní, 2 &#x3D; neaktivní, 4 &#x3D; draft, 8 &#x3D; smazaný. Jsou povolené kombinace všech, krom smazaných, které jdou zobrazit pouze samostatně. (optional, default to 1) (deprecated)
     * @param  int $activity_state Vyžaduje full_access token. Parametr filtruje pozice podle toho, jestli jsou aktivní (1) nebo neaktivní (2). Zároveň je parametr bitmapa, tudíž lze jednotlivé hodnoty sčítat a ty používat (Umožňuje filtrovat více možností na jednou.). (optional, default to 1)
     * @param  int $access_state Vyžaduje full_access token. Parametr filtruje inzeráty podle logiky otevřených a uzavřených pozic. Na rozdíl od activity_state nelze jednotlivé hodnoty kombinovat. (optional)
     * @param  int $with_rewards Zobrazí inzeráty, na které se váže refferal odměna. (optional)
     * @param  \DateTime $updated_from Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  \DateTime $updated_to Filtrace podle data poslední editace inzerátu. Formát YYYY-mm-dd HH:mm:ss (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsGetRequest($limit = 10, $page = 1, $with_automation = null, $text_language = null, $workfield_id = null, $office_id = null, $filter_id = null, $channel_id = null, $order_by = 'date_created', $include_inactive = false, $only_deleted = false, $status = 1, $activity_state = 1, $access_state = null, $with_rewards = null, $updated_from = null, $updated_to = null, string $contentType = self::contentTypes['jobsGet'][0])
    {

        if ($limit !== null && $limit > 50) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling JobsApi.jobsGet, must be smaller than or equal to 50.');
        }
        

















        $resourcePath = '/jobs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $with_automation,
            'with_automation', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $text_language,
            'text_language', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $workfield_id,
            'workfield_id[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $office_id,
            'office_id[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter_id,
            'filter_id[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $channel_id,
            'channel_id[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order_by,
            'order_by', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $include_inactive,
            'include_inactive', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $only_deleted,
            'only_deleted', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $status,
            'status', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $activity_state,
            'activity_state', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $access_state,
            'access_state', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $with_rewards,
            'with_rewards', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $updated_from,
            'updated_from', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $updated_to,
            'updated_to', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdAccessPut
     *
     * Add new visit count
     *
     * @param  int $id id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest $jobs_id_access_put_request jobs_id_access_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessPut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdAccessPut200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdAccessPut($id, $jobs_id_access_put_request = null, string $contentType = self::contentTypes['jobsIdAccessPut'][0])
    {
        list($response) = $this->jobsIdAccessPutWithHttpInfo($id, $jobs_id_access_put_request, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdAccessPutWithHttpInfo
     *
     * Add new visit count
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest $jobs_id_access_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessPut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdAccessPut200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdAccessPutWithHttpInfo($id, $jobs_id_access_put_request = null, string $contentType = self::contentTypes['jobsIdAccessPut'][0])
    {
        $request = $this->jobsIdAccessPutRequest($id, $jobs_id_access_put_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdAccessPutAsync
     *
     * Add new visit count
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest $jobs_id_access_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdAccessPutAsync($id, $jobs_id_access_put_request = null, string $contentType = self::contentTypes['jobsIdAccessPut'][0])
    {
        return $this->jobsIdAccessPutAsyncWithHttpInfo($id, $jobs_id_access_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdAccessPutAsyncWithHttpInfo
     *
     * Add new visit count
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest $jobs_id_access_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdAccessPutAsyncWithHttpInfo($id, $jobs_id_access_put_request = null, string $contentType = self::contentTypes['jobsIdAccessPut'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdAccessPut200Response';
        $request = $this->jobsIdAccessPutRequest($id, $jobs_id_access_put_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdAccessPut'
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdAccessPutRequest $jobs_id_access_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdAccessPutRequest($id, $jobs_id_access_put_request = null, string $contentType = self::contentTypes['jobsIdAccessPut'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdAccessPut'
            );
        }



        $resourcePath = '/jobs/{id}/access';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($jobs_id_access_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($jobs_id_access_put_request));
            } else {
                $httpBody = $jobs_id_access_put_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdAccessStateStatePut
     *
     * Change job access state
     *
     * @param  int $id id (required)
     * @param  int $state state (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessStateStatePut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdAccessStateStatePut($id, $state, string $contentType = self::contentTypes['jobsIdAccessStateStatePut'][0])
    {
        list($response) = $this->jobsIdAccessStateStatePutWithHttpInfo($id, $state, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdAccessStateStatePutWithHttpInfo
     *
     * Change job access state
     *
     * @param  int $id (required)
     * @param  int $state (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessStateStatePut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdAccessStateStatePutWithHttpInfo($id, $state, string $contentType = self::contentTypes['jobsIdAccessStateStatePut'][0])
    {
        $request = $this->jobsIdAccessStateStatePutRequest($id, $state, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdAccessStateStatePutAsync
     *
     * Change job access state
     *
     * @param  int $id (required)
     * @param  int $state (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessStateStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdAccessStateStatePutAsync($id, $state, string $contentType = self::contentTypes['jobsIdAccessStateStatePut'][0])
    {
        return $this->jobsIdAccessStateStatePutAsyncWithHttpInfo($id, $state, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdAccessStateStatePutAsyncWithHttpInfo
     *
     * Change job access state
     *
     * @param  int $id (required)
     * @param  int $state (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessStateStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdAccessStateStatePutAsyncWithHttpInfo($id, $state, string $contentType = self::contentTypes['jobsIdAccessStateStatePut'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdAccessStateStatePut200Response';
        $request = $this->jobsIdAccessStateStatePutRequest($id, $state, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdAccessStateStatePut'
     *
     * @param  int $id (required)
     * @param  int $state (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdAccessStateStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdAccessStateStatePutRequest($id, $state, string $contentType = self::contentTypes['jobsIdAccessStateStatePut'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdAccessStateStatePut'
            );
        }

        // verify the required parameter 'state' is set
        if ($state === null || (is_array($state) && count($state) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $state when calling jobsIdAccessStateStatePut'
            );
        }


        $resourcePath = '/jobs/{id}/access_state/{state}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($state !== null) {
            $resourcePath = str_replace(
                '{' . 'state' . '}',
                ObjectSerializer::toPathValue($state),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdChannelChannelIdDelete
     *
     * Unpublish job
     *
     * @param  int $id id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id channel_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdDelete'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response|\App\Module\RecruitisApi\Model\JobsPost400Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdChannelChannelIdDelete($id, $channel_id, string $contentType = self::contentTypes['jobsIdChannelChannelIdDelete'][0])
    {
        list($response) = $this->jobsIdChannelChannelIdDeleteWithHttpInfo($id, $channel_id, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdChannelChannelIdDeleteWithHttpInfo
     *
     * Unpublish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdDelete'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response|\App\Module\RecruitisApi\Model\JobsPost400Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdChannelChannelIdDeleteWithHttpInfo($id, $channel_id, string $contentType = self::contentTypes['jobsIdChannelChannelIdDelete'][0])
    {
        $request = $this->jobsIdChannelChannelIdDeleteRequest($id, $channel_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 202:
                    if ('\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\App\Module\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdChannelChannelIdDeleteAsync
     *
     * Unpublish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelChannelIdDeleteAsync($id, $channel_id, string $contentType = self::contentTypes['jobsIdChannelChannelIdDelete'][0])
    {
        return $this->jobsIdChannelChannelIdDeleteAsyncWithHttpInfo($id, $channel_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdChannelChannelIdDeleteAsyncWithHttpInfo
     *
     * Unpublish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelChannelIdDeleteAsyncWithHttpInfo($id, $channel_id, string $contentType = self::contentTypes['jobsIdChannelChannelIdDelete'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdDelete202Response';
        $request = $this->jobsIdChannelChannelIdDeleteRequest($id, $channel_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdChannelChannelIdDelete'
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdChannelChannelIdDeleteRequest($id, $channel_id, string $contentType = self::contentTypes['jobsIdChannelChannelIdDelete'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdChannelChannelIdDelete'
            );
        }

        // verify the required parameter 'channel_id' is set
        if ($channel_id === null || (is_array($channel_id) && count($channel_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $channel_id when calling jobsIdChannelChannelIdDelete'
            );
        }


        $resourcePath = '/jobs/{id}/channel/{channel_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($channel_id !== null) {
            $resourcePath = str_replace(
                '{' . 'channel_id' . '}',
                ObjectSerializer::toPathValue($channel_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdChannelChannelIdPut
     *
     * Publish job
     *
     * @param  int $id id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id channel_id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest $jobs_id_channel_channel_id_put_request jobs_id_channel_channel_id_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdPut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response|\App\Module\RecruitisApi\Model\JobsPost400Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdChannelChannelIdPut($id, $channel_id, $jobs_id_channel_channel_id_put_request = null, string $contentType = self::contentTypes['jobsIdChannelChannelIdPut'][0])
    {
        list($response) = $this->jobsIdChannelChannelIdPutWithHttpInfo($id, $channel_id, $jobs_id_channel_channel_id_put_request, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdChannelChannelIdPutWithHttpInfo
     *
     * Publish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest $jobs_id_channel_channel_id_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdPut'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response|\App\Module\RecruitisApi\Model\JobsPost400Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdChannelChannelIdPutWithHttpInfo($id, $channel_id, $jobs_id_channel_channel_id_put_request = null, string $contentType = self::contentTypes['jobsIdChannelChannelIdPut'][0])
    {
        $request = $this->jobsIdChannelChannelIdPutRequest($id, $channel_id, $jobs_id_channel_channel_id_put_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 202:
                    if ('\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\App\Module\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdChannelChannelIdPutAsync
     *
     * Publish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest $jobs_id_channel_channel_id_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelChannelIdPutAsync($id, $channel_id, $jobs_id_channel_channel_id_put_request = null, string $contentType = self::contentTypes['jobsIdChannelChannelIdPut'][0])
    {
        return $this->jobsIdChannelChannelIdPutAsyncWithHttpInfo($id, $channel_id, $jobs_id_channel_channel_id_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdChannelChannelIdPutAsyncWithHttpInfo
     *
     * Publish job
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest $jobs_id_channel_channel_id_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelChannelIdPutAsyncWithHttpInfo($id, $channel_id, $jobs_id_channel_channel_id_put_request = null, string $contentType = self::contentTypes['jobsIdChannelChannelIdPut'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPut202Response';
        $request = $this->jobsIdChannelChannelIdPutRequest($id, $channel_id, $jobs_id_channel_channel_id_put_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdChannelChannelIdPut'
     *
     * @param  int $id (required)
     * @param  JobsIdChannelChannelIdPutChannelIdParameter $channel_id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdChannelChannelIdPutRequest $jobs_id_channel_channel_id_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelChannelIdPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdChannelChannelIdPutRequest($id, $channel_id, $jobs_id_channel_channel_id_put_request = null, string $contentType = self::contentTypes['jobsIdChannelChannelIdPut'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdChannelChannelIdPut'
            );
        }

        // verify the required parameter 'channel_id' is set
        if ($channel_id === null || (is_array($channel_id) && count($channel_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $channel_id when calling jobsIdChannelChannelIdPut'
            );
        }



        $resourcePath = '/jobs/{id}/channel/{channel_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($channel_id !== null) {
            $resourcePath = str_replace(
                '{' . 'channel_id' . '}',
                ObjectSerializer::toPathValue($channel_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($jobs_id_channel_channel_id_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($jobs_id_channel_channel_id_put_request));
            } else {
                $httpBody = $jobs_id_channel_channel_id_put_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdChannelsGet
     *
     * Show list of channels
     *
     * @param  int $id id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdChannelsGet($id, string $contentType = self::contentTypes['jobsIdChannelsGet'][0])
    {
        list($response) = $this->jobsIdChannelsGetWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdChannelsGetWithHttpInfo
     *
     * Show list of channels
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdChannelsGetWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdChannelsGet'][0])
    {
        $request = $this->jobsIdChannelsGetRequest($id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdChannelsGetAsync
     *
     * Show list of channels
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelsGetAsync($id, string $contentType = self::contentTypes['jobsIdChannelsGet'][0])
    {
        return $this->jobsIdChannelsGetAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdChannelsGetAsyncWithHttpInfo
     *
     * Show list of channels
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdChannelsGetAsyncWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdChannelsGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdChannelsGet200Response';
        $request = $this->jobsIdChannelsGetRequest($id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdChannelsGet'
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdChannelsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdChannelsGetRequest($id, string $contentType = self::contentTypes['jobsIdChannelsGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdChannelsGet'
            );
        }


        $resourcePath = '/jobs/{id}/channels';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdCommunicationGet
     *
     * List communication with candidates
     *
     * @param  int $id id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response
     */
    public function jobsIdCommunicationGet($id, string $contentType = self::contentTypes['jobsIdCommunicationGet'][0])
    {
        list($response) = $this->jobsIdCommunicationGetWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdCommunicationGetWithHttpInfo
     *
     * List communication with candidates
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdCommunicationGetWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdCommunicationGet'][0])
    {
        $request = $this->jobsIdCommunicationGetRequest($id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\App\Module\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdCommunicationGetAsync
     *
     * List communication with candidates
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdCommunicationGetAsync($id, string $contentType = self::contentTypes['jobsIdCommunicationGet'][0])
    {
        return $this->jobsIdCommunicationGetAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdCommunicationGetAsyncWithHttpInfo
     *
     * List communication with candidates
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdCommunicationGetAsyncWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdCommunicationGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdCommunicationGet200Response';
        $request = $this->jobsIdCommunicationGetRequest($id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdCommunicationGet'
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdCommunicationGetRequest($id, string $contentType = self::contentTypes['jobsIdCommunicationGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdCommunicationGet'
            );
        }


        $resourcePath = '/jobs/{id}/communication';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdFormGet
     *
     * Load a job answer form
     *
     * @param  int $id id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdFormGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdFormGet($id, string $contentType = self::contentTypes['jobsIdFormGet'][0])
    {
        list($response) = $this->jobsIdFormGetWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdFormGetWithHttpInfo
     *
     * Load a job answer form
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdFormGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdFormGetWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdFormGet'][0])
    {
        $request = $this->jobsIdFormGetRequest($id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdFormGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdFormGet200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdFormGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdFormGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdFormGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdFormGetAsync
     *
     * Load a job answer form
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdFormGetAsync($id, string $contentType = self::contentTypes['jobsIdFormGet'][0])
    {
        return $this->jobsIdFormGetAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdFormGetAsyncWithHttpInfo
     *
     * Load a job answer form
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdFormGetAsyncWithHttpInfo($id, string $contentType = self::contentTypes['jobsIdFormGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdFormGet200Response';
        $request = $this->jobsIdFormGetRequest($id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdFormGet'
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdFormGetRequest($id, string $contentType = self::contentTypes['jobsIdFormGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdFormGet'
            );
        }


        $resourcePath = '/jobs/{id}/form';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdFormValidatePost
     *
     * Validate a job answer form
     *
     * @param  int $id id (required)
     * @param  string $accept_language accept_language (optional)
     * @param  \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest $jobs_id_form_validate_post_request Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormValidatePost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response
     */
    public function jobsIdFormValidatePost($id, $accept_language = null, $jobs_id_form_validate_post_request = null, string $contentType = self::contentTypes['jobsIdFormValidatePost'][0])
    {
        list($response) = $this->jobsIdFormValidatePostWithHttpInfo($id, $accept_language, $jobs_id_form_validate_post_request, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdFormValidatePostWithHttpInfo
     *
     * Validate a job answer form
     *
     * @param  int $id (required)
     * @param  string $accept_language (optional)
     * @param  \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest $jobs_id_form_validate_post_request Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormValidatePost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response|\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdFormValidatePostWithHttpInfo($id, $accept_language = null, $jobs_id_form_validate_post_request = null, string $contentType = self::contentTypes['jobsIdFormValidatePost'][0])
    {
        $request = $this->jobsIdFormValidatePostRequest($id, $accept_language, $jobs_id_form_validate_post_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdFormValidatePostAsync
     *
     * Validate a job answer form
     *
     * @param  int $id (required)
     * @param  string $accept_language (optional)
     * @param  \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest $jobs_id_form_validate_post_request Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormValidatePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdFormValidatePostAsync($id, $accept_language = null, $jobs_id_form_validate_post_request = null, string $contentType = self::contentTypes['jobsIdFormValidatePost'][0])
    {
        return $this->jobsIdFormValidatePostAsyncWithHttpInfo($id, $accept_language, $jobs_id_form_validate_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdFormValidatePostAsyncWithHttpInfo
     *
     * Validate a job answer form
     *
     * @param  int $id (required)
     * @param  string $accept_language (optional)
     * @param  \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest $jobs_id_form_validate_post_request Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormValidatePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdFormValidatePostAsyncWithHttpInfo($id, $accept_language = null, $jobs_id_form_validate_post_request = null, string $contentType = self::contentTypes['jobsIdFormValidatePost'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdFormValidatePost200Response';
        $request = $this->jobsIdFormValidatePostRequest($id, $accept_language, $jobs_id_form_validate_post_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdFormValidatePost'
     *
     * @param  int $id (required)
     * @param  string $accept_language (optional)
     * @param  \App\Module\RecruitisApi\Model\JobsIdFormValidatePostRequest $jobs_id_form_validate_post_request Hodnoty z odpovědního formuláře ve formátu pole &#x3D;&gt; hodnota. Jelikož se jedná o JSON API, nikoliv multipart form, je potřeba poslat přílohy (CV) jako pole objektů dle schematu. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdFormValidatePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdFormValidatePostRequest($id, $accept_language = null, $jobs_id_form_validate_post_request = null, string $contentType = self::contentTypes['jobsIdFormValidatePost'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdFormValidatePost'
            );
        }




        $resourcePath = '/jobs/{id}/form/validate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($accept_language !== null) {
            $headerParams['Accept-Language'] = ObjectSerializer::toHeaderValue($accept_language);
        }

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($jobs_id_form_validate_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($jobs_id_form_validate_post_request));
            } else {
                $httpBody = $jobs_id_form_validate_post_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdGet
     *
     * Get job detail
     *
     * @param  int $id id (required)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  int $activity_state activity_state (optional)
     * @param  int $access_state access_state (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdGet($id, $with_automation = null, $activity_state = null, $access_state = null, string $contentType = self::contentTypes['jobsIdGet'][0])
    {
        list($response) = $this->jobsIdGetWithHttpInfo($id, $with_automation, $activity_state, $access_state, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdGetWithHttpInfo
     *
     * Get job detail
     *
     * @param  int $id (required)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  int $activity_state (optional)
     * @param  int $access_state (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdGetWithHttpInfo($id, $with_automation = null, $activity_state = null, $access_state = null, string $contentType = self::contentTypes['jobsIdGet'][0])
    {
        $request = $this->jobsIdGetRequest($id, $with_automation, $activity_state, $access_state, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet200Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\App\Module\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdGetAsync
     *
     * Get job detail
     *
     * @param  int $id (required)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  int $activity_state (optional)
     * @param  int $access_state (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdGetAsync($id, $with_automation = null, $activity_state = null, $access_state = null, string $contentType = self::contentTypes['jobsIdGet'][0])
    {
        return $this->jobsIdGetAsyncWithHttpInfo($id, $with_automation, $activity_state, $access_state, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdGetAsyncWithHttpInfo
     *
     * Get job detail
     *
     * @param  int $id (required)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  int $activity_state (optional)
     * @param  int $access_state (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdGetAsyncWithHttpInfo($id, $with_automation = null, $activity_state = null, $access_state = null, string $contentType = self::contentTypes['jobsIdGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdGet200Response';
        $request = $this->jobsIdGetRequest($id, $with_automation, $activity_state, $access_state, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdGet'
     *
     * @param  int $id (required)
     * @param  int $with_automation V případě with_automation&#x3D;1 se vypíše ve výsledku volání také nové pole automations (optional)
     * @param  int $activity_state (optional)
     * @param  int $access_state (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdGetRequest($id, $with_automation = null, $activity_state = null, $access_state = null, string $contentType = self::contentTypes['jobsIdGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdGet'
            );
        }





        $resourcePath = '/jobs/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $with_automation,
            'with_automation', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $activity_state,
            'activity_state', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $access_state,
            'access_state', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsIdRecommendApplicantPost
     *
     * Create candidate recommendation
     *
     * @param  int $id id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest $jobs_id_recommend_applicant_post_request jobs_id_recommend_applicant_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdRecommendApplicantPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response|\App\Module\RecruitisApi\Model\LoginPut401Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function jobsIdRecommendApplicantPost($id, $jobs_id_recommend_applicant_post_request = null, string $contentType = self::contentTypes['jobsIdRecommendApplicantPost'][0])
    {
        list($response) = $this->jobsIdRecommendApplicantPostWithHttpInfo($id, $jobs_id_recommend_applicant_post_request, $contentType);
        return $response;
    }

    /**
     * Operation jobsIdRecommendApplicantPostWithHttpInfo
     *
     * Create candidate recommendation
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest $jobs_id_recommend_applicant_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdRecommendApplicantPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response|\App\Module\RecruitisApi\Model\LoginPut401Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsIdRecommendApplicantPostWithHttpInfo($id, $jobs_id_recommend_applicant_post_request = null, string $contentType = self::contentTypes['jobsIdRecommendApplicantPost'][0])
    {
        $request = $this->jobsIdRecommendApplicantPostRequest($id, $jobs_id_recommend_applicant_post_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\App\Module\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsIdRecommendApplicantPostAsync
     *
     * Create candidate recommendation
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest $jobs_id_recommend_applicant_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdRecommendApplicantPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdRecommendApplicantPostAsync($id, $jobs_id_recommend_applicant_post_request = null, string $contentType = self::contentTypes['jobsIdRecommendApplicantPost'][0])
    {
        return $this->jobsIdRecommendApplicantPostAsyncWithHttpInfo($id, $jobs_id_recommend_applicant_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsIdRecommendApplicantPostAsyncWithHttpInfo
     *
     * Create candidate recommendation
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest $jobs_id_recommend_applicant_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdRecommendApplicantPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsIdRecommendApplicantPostAsyncWithHttpInfo($id, $jobs_id_recommend_applicant_post_request = null, string $contentType = self::contentTypes['jobsIdRecommendApplicantPost'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPost201Response';
        $request = $this->jobsIdRecommendApplicantPostRequest($id, $jobs_id_recommend_applicant_post_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsIdRecommendApplicantPost'
     *
     * @param  int $id (required)
     * @param  \App\Module\RecruitisApi\Model\JobsIdRecommendApplicantPostRequest $jobs_id_recommend_applicant_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsIdRecommendApplicantPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsIdRecommendApplicantPostRequest($id, $jobs_id_recommend_applicant_post_request = null, string $contentType = self::contentTypes['jobsIdRecommendApplicantPost'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling jobsIdRecommendApplicantPost'
            );
        }



        $resourcePath = '/jobs/{id}/recommend/applicant';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($jobs_id_recommend_applicant_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($jobs_id_recommend_applicant_post_request));
            } else {
                $httpBody = $jobs_id_recommend_applicant_post_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation jobsPost
     *
     * Create new job
     *
     * @param  \App\Module\RecruitisApi\Model\JobsPostRequest $jobs_post_request jobs_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\JobsPost201Response|\App\Module\RecruitisApi\Model\JobsPost400Response
     */
    public function jobsPost($jobs_post_request = null, string $contentType = self::contentTypes['jobsPost'][0])
    {
        list($response) = $this->jobsPostWithHttpInfo($jobs_post_request, $contentType);
        return $response;
    }

    /**
     * Operation jobsPostWithHttpInfo
     *
     * Create new job
     *
     * @param  \App\Module\RecruitisApi\Model\JobsPostRequest $jobs_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\JobsPost201Response|\App\Module\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function jobsPostWithHttpInfo($jobs_post_request = null, string $contentType = self::contentTypes['jobsPost'][0])
    {
        $request = $this->jobsPostRequest($jobs_post_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\App\Module\RecruitisApi\Model\JobsPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsPost201Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\App\Module\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\JobsPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation jobsPostAsync
     *
     * Create new job
     *
     * @param  \App\Module\RecruitisApi\Model\JobsPostRequest $jobs_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsPostAsync($jobs_post_request = null, string $contentType = self::contentTypes['jobsPost'][0])
    {
        return $this->jobsPostAsyncWithHttpInfo($jobs_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation jobsPostAsyncWithHttpInfo
     *
     * Create new job
     *
     * @param  \App\Module\RecruitisApi\Model\JobsPostRequest $jobs_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function jobsPostAsyncWithHttpInfo($jobs_post_request = null, string $contentType = self::contentTypes['jobsPost'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\JobsPost201Response';
        $request = $this->jobsPostRequest($jobs_post_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'jobsPost'
     *
     * @param  \App\Module\RecruitisApi\Model\JobsPostRequest $jobs_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['jobsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function jobsPostRequest($jobs_post_request = null, string $contentType = self::contentTypes['jobsPost'][0])
    {



        $resourcePath = '/jobs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($jobs_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($jobs_post_request));
            } else {
                $httpBody = $jobs_post_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
