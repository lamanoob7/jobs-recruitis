<?php
/**
 * CandidatesApi
 * PHP version 7.4
 *
 * @category Class
 * @package  RecruitisApi
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

namespace RecruitisApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use RecruitisApi\ApiException;
use RecruitisApi\Configuration;
use RecruitisApi\HeaderSelector;
use RecruitisApi\ObjectSerializer;

/**
 * CandidatesApi Class Doc Comment
 *
 * @category Class
 * @package  RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class CandidatesApi
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
        'activityFeedGet' => [
            'application/json',
        ],
        'answersAnswerIdExportPut' => [
            'application/json',
        ],
        'answersAnswerIdExtraGet' => [
            'application/json',
        ],
        'answersAnswerIdExtraPut' => [
            'application/json',
        ],
        'answersAnswerIdGet' => [
            'application/json',
        ],
        'answersAnswerIdInterviewsNotesGet' => [
            'application/json',
        ],
        'answersGet' => [
            'application/json',
        ],
        'answersPost' => [
            'application/json',
        ],
        'candidatesFormIdGet' => [
            'application/json',
        ],
        'candidatesIdAnswerIdCommunicationGet' => [
            'application/json',
        ],
        'candidatesIdAnswerIdCommunicationPost' => [
            'application/json',
        ],
        'candidatesIdCommunicationGet' => [
            'application/json',
        ],
        'candidatesIdCommunicationPost' => [
            'application/json',
        ],
        'candidatesIdDelete' => [
            'application/json',
        ],
        'candidatesPost' => [
            'application/json',
        ],
        'candidatesUserIdExtraGet' => [
            'application/json',
        ],
        'candidatesUserIdExtraPut' => [
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
     * Operation activityFeedGet
     *
     * List candidate activity feed
     *
     * @param  int $user_id Jedná se o ID kandidáta. (required)
     * @param  string $filter filter (optional)
     * @param  string $lang lang (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activityFeedGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\ActivityFeedGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function activityFeedGet($user_id, $filter = null, $lang = null, string $contentType = self::contentTypes['activityFeedGet'][0])
    {
        list($response) = $this->activityFeedGetWithHttpInfo($user_id, $filter, $lang, $contentType);
        return $response;
    }

    /**
     * Operation activityFeedGetWithHttpInfo
     *
     * List candidate activity feed
     *
     * @param  int $user_id Jedná se o ID kandidáta. (required)
     * @param  string $filter (optional)
     * @param  string $lang (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activityFeedGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\ActivityFeedGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\ActivityFeedGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function activityFeedGetWithHttpInfo($user_id, $filter = null, $lang = null, string $contentType = self::contentTypes['activityFeedGet'][0])
    {
        $request = $this->activityFeedGetRequest($user_id, $filter, $lang, $contentType);

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
                    if ('\RecruitisApi\Model\ActivityFeedGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\ActivityFeedGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\ActivityFeedGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\ActivityFeedGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\ActivityFeedGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation activityFeedGetAsync
     *
     * List candidate activity feed
     *
     * @param  int $user_id Jedná se o ID kandidáta. (required)
     * @param  string $filter (optional)
     * @param  string $lang (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activityFeedGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function activityFeedGetAsync($user_id, $filter = null, $lang = null, string $contentType = self::contentTypes['activityFeedGet'][0])
    {
        return $this->activityFeedGetAsyncWithHttpInfo($user_id, $filter, $lang, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation activityFeedGetAsyncWithHttpInfo
     *
     * List candidate activity feed
     *
     * @param  int $user_id Jedná se o ID kandidáta. (required)
     * @param  string $filter (optional)
     * @param  string $lang (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activityFeedGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function activityFeedGetAsyncWithHttpInfo($user_id, $filter = null, $lang = null, string $contentType = self::contentTypes['activityFeedGet'][0])
    {
        $returnType = '\RecruitisApi\Model\ActivityFeedGet200Response';
        $request = $this->activityFeedGetRequest($user_id, $filter, $lang, $contentType);

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
     * Create request for operation 'activityFeedGet'
     *
     * @param  int $user_id Jedná se o ID kandidáta. (required)
     * @param  string $filter (optional)
     * @param  string $lang (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['activityFeedGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function activityFeedGetRequest($user_id, $filter = null, $lang = null, string $contentType = self::contentTypes['activityFeedGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling activityFeedGet'
            );
        }




        $resourcePath = '/activity_feed';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_id,
            'userId', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            true // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter,
            'filter', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lang,
            'lang', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));




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
     * Operation answersAnswerIdExportPut
     *
     * Export answer
     *
     * @param  int $answer_id answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExportPutRequest $answers_answer_id_export_put_request answers_answer_id_export_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExportPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExportPut200Response|\RecruitisApi\Model\JobsPost400Response
     */
    public function answersAnswerIdExportPut($answer_id, $answers_answer_id_export_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExportPut'][0])
    {
        list($response) = $this->answersAnswerIdExportPutWithHttpInfo($answer_id, $answers_answer_id_export_put_request, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdExportPutWithHttpInfo
     *
     * Export answer
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExportPutRequest $answers_answer_id_export_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExportPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExportPut200Response|\RecruitisApi\Model\JobsPost400Response> array of \RecruitisApi\Model\AnswersAnswerIdExportPut200Response|\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdExportPutWithHttpInfo($answer_id, $answers_answer_id_export_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExportPut'][0])
    {
        $request = $this->answersAnswerIdExportPutRequest($answer_id, $answers_answer_id_export_put_request, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdExportPut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdExportPut200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdExportPut200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdExportPut200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdExportPut200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersAnswerIdExportPutAsync
     *
     * Export answer
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExportPutRequest $answers_answer_id_export_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExportPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExportPutAsync($answer_id, $answers_answer_id_export_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExportPut'][0])
    {
        return $this->answersAnswerIdExportPutAsyncWithHttpInfo($answer_id, $answers_answer_id_export_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdExportPutAsyncWithHttpInfo
     *
     * Export answer
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExportPutRequest $answers_answer_id_export_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExportPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExportPutAsyncWithHttpInfo($answer_id, $answers_answer_id_export_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExportPut'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdExportPut200Response';
        $request = $this->answersAnswerIdExportPutRequest($answer_id, $answers_answer_id_export_put_request, $contentType);

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
     * Create request for operation 'answersAnswerIdExportPut'
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExportPutRequest $answers_answer_id_export_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExportPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdExportPutRequest($answer_id, $answers_answer_id_export_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExportPut'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdExportPut'
            );
        }



        $resourcePath = '/answers/{answer_id}/export';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($answers_answer_id_export_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_export_put_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_export_put_request));
                }
            } else {
                $httpBody = $answers_answer_id_export_put_request;
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
     * Operation answersAnswerIdExtraGet
     *
     * Get candidate&#39;s answer tags
     *
     * @param  int $answer_id answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function answersAnswerIdExtraGet($answer_id, string $contentType = self::contentTypes['answersAnswerIdExtraGet'][0])
    {
        list($response) = $this->answersAnswerIdExtraGetWithHttpInfo($answer_id, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdExtraGetWithHttpInfo
     *
     * Get candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdExtraGetWithHttpInfo($answer_id, string $contentType = self::contentTypes['answersAnswerIdExtraGet'][0])
    {
        $request = $this->answersAnswerIdExtraGetRequest($answer_id, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersAnswerIdExtraGetAsync
     *
     * Get candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExtraGetAsync($answer_id, string $contentType = self::contentTypes['answersAnswerIdExtraGet'][0])
    {
        return $this->answersAnswerIdExtraGetAsyncWithHttpInfo($answer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdExtraGetAsyncWithHttpInfo
     *
     * Get candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExtraGetAsyncWithHttpInfo($answer_id, string $contentType = self::contentTypes['answersAnswerIdExtraGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response';
        $request = $this->answersAnswerIdExtraGetRequest($answer_id, $contentType);

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
     * Create request for operation 'answersAnswerIdExtraGet'
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdExtraGetRequest($answer_id, string $contentType = self::contentTypes['answersAnswerIdExtraGet'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdExtraGet'
            );
        }


        $resourcePath = '/answers/{answer_id}/extra';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
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
     * Operation answersAnswerIdExtraPut
     *
     * Update candidate&#39;s answer tags
     *
     * @param  int $answer_id answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function answersAnswerIdExtraPut($answer_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExtraPut'][0])
    {
        list($response) = $this->answersAnswerIdExtraPutWithHttpInfo($answer_id, $answers_answer_id_extra_put_request, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdExtraPutWithHttpInfo
     *
     * Update candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdExtraPutWithHttpInfo($answer_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExtraPut'][0])
    {
        $request = $this->answersAnswerIdExtraPutRequest($answer_id, $answers_answer_id_extra_put_request, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersAnswerIdExtraPutAsync
     *
     * Update candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExtraPutAsync($answer_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExtraPut'][0])
    {
        return $this->answersAnswerIdExtraPutAsyncWithHttpInfo($answer_id, $answers_answer_id_extra_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdExtraPutAsyncWithHttpInfo
     *
     * Update candidate&#39;s answer tags
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdExtraPutAsyncWithHttpInfo($answer_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExtraPut'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response';
        $request = $this->answersAnswerIdExtraPutRequest($answer_id, $answers_answer_id_extra_put_request, $contentType);

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
     * Create request for operation 'answersAnswerIdExtraPut'
     *
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdExtraPutRequest($answer_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['answersAnswerIdExtraPut'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdExtraPut'
            );
        }



        $resourcePath = '/answers/{answer_id}/extra';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($answers_answer_id_extra_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_extra_put_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_extra_put_request));
                }
            } else {
                $httpBody = $answers_answer_id_extra_put_request;
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
     * Operation answersAnswerIdGet
     *
     * Get answer
     *
     * @param  int $answer_id answer_id (required)
     * @param  string $view view (optional, default to 'basic')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response
     */
    public function answersAnswerIdGet($answer_id, $view = 'basic', string $contentType = self::contentTypes['answersAnswerIdGet'][0])
    {
        list($response) = $this->answersAnswerIdGetWithHttpInfo($answer_id, $view, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdGetWithHttpInfo
     *
     * Get answer
     *
     * @param  int $answer_id (required)
     * @param  string $view (optional, default to 'basic')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response> array of \RecruitisApi\Model\AnswersAnswerIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdGetWithHttpInfo($answer_id, $view = 'basic', string $contentType = self::contentTypes['answersAnswerIdGet'][0])
    {
        $request = $this->answersAnswerIdGetRequest($answer_id, $view, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersAnswerIdGetAsync
     *
     * Get answer
     *
     * @param  int $answer_id (required)
     * @param  string $view (optional, default to 'basic')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdGetAsync($answer_id, $view = 'basic', string $contentType = self::contentTypes['answersAnswerIdGet'][0])
    {
        return $this->answersAnswerIdGetAsyncWithHttpInfo($answer_id, $view, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdGetAsyncWithHttpInfo
     *
     * Get answer
     *
     * @param  int $answer_id (required)
     * @param  string $view (optional, default to 'basic')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdGetAsyncWithHttpInfo($answer_id, $view = 'basic', string $contentType = self::contentTypes['answersAnswerIdGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdGet200Response';
        $request = $this->answersAnswerIdGetRequest($answer_id, $view, $contentType);

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
     * Create request for operation 'answersAnswerIdGet'
     *
     * @param  int $answer_id (required)
     * @param  string $view (optional, default to 'basic')
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdGetRequest($answer_id, $view = 'basic', string $contentType = self::contentTypes['answersAnswerIdGet'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdGet'
            );
        }



        $resourcePath = '/answers/{answer_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $view,
            'view', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));


        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
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
     * Operation answersAnswerIdInterviewsNotesGet
     *
     * Get all interviews, related to answer
     *
     * @param  int $answer_id answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdInterviewsNotesGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response|\RecruitisApi\Model\JobsIdGet404Response
     */
    public function answersAnswerIdInterviewsNotesGet($answer_id, string $contentType = self::contentTypes['answersAnswerIdInterviewsNotesGet'][0])
    {
        list($response) = $this->answersAnswerIdInterviewsNotesGetWithHttpInfo($answer_id, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdInterviewsNotesGetWithHttpInfo
     *
     * Get all interviews, related to answer
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdInterviewsNotesGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response|\RecruitisApi\Model\JobsIdGet404Response> array of \RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response|\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdInterviewsNotesGetWithHttpInfo($answer_id, string $contentType = self::contentTypes['answersAnswerIdInterviewsNotesGet'][0])
    {
        $request = $this->answersAnswerIdInterviewsNotesGetRequest($answer_id, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersAnswerIdInterviewsNotesGetAsync
     *
     * Get all interviews, related to answer
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdInterviewsNotesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdInterviewsNotesGetAsync($answer_id, string $contentType = self::contentTypes['answersAnswerIdInterviewsNotesGet'][0])
    {
        return $this->answersAnswerIdInterviewsNotesGetAsyncWithHttpInfo($answer_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdInterviewsNotesGetAsyncWithHttpInfo
     *
     * Get all interviews, related to answer
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdInterviewsNotesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdInterviewsNotesGetAsyncWithHttpInfo($answer_id, string $contentType = self::contentTypes['answersAnswerIdInterviewsNotesGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdInterviewsNotesGet200Response';
        $request = $this->answersAnswerIdInterviewsNotesGetRequest($answer_id, $contentType);

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
     * Create request for operation 'answersAnswerIdInterviewsNotesGet'
     *
     * @param  int $answer_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdInterviewsNotesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdInterviewsNotesGetRequest($answer_id, string $contentType = self::contentTypes['answersAnswerIdInterviewsNotesGet'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdInterviewsNotesGet'
            );
        }


        $resourcePath = '/answers/{answer_id}/interviews/notes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
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
     * Operation answersGet
     *
     * Get all answers
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $job_id Filtrování odpovědí dle ID inzerátů. (optional)
     * @param  int $flow_id Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. (optional)
     * @param  int $search Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  \DateTime $date_from Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  \DateTime $date_to Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  string $order order (optional, default to 'date_created')
     * @param  int $exported exported (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function answersGet($limit = 10, $page = 1, $job_id = null, $flow_id = null, $search = null, $date_from = null, $date_to = null, $order = 'date_created', $exported = null, string $contentType = self::contentTypes['answersGet'][0])
    {
        list($response) = $this->answersGetWithHttpInfo($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported, $contentType);
        return $response;
    }

    /**
     * Operation answersGetWithHttpInfo
     *
     * Get all answers
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $job_id Filtrování odpovědí dle ID inzerátů. (optional)
     * @param  int $flow_id Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. (optional)
     * @param  int $search Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  \DateTime $date_from Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  \DateTime $date_to Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  string $order (optional, default to 'date_created')
     * @param  int $exported (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersGetWithHttpInfo($limit = 10, $page = 1, $job_id = null, $flow_id = null, $search = null, $date_from = null, $date_to = null, $order = 'date_created', $exported = null, string $contentType = self::contentTypes['answersGet'][0])
    {
        $request = $this->answersGetRequest($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersGetAsync
     *
     * Get all answers
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $job_id Filtrování odpovědí dle ID inzerátů. (optional)
     * @param  int $flow_id Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. (optional)
     * @param  int $search Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  \DateTime $date_from Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  \DateTime $date_to Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  string $order (optional, default to 'date_created')
     * @param  int $exported (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersGetAsync($limit = 10, $page = 1, $job_id = null, $flow_id = null, $search = null, $date_from = null, $date_to = null, $order = 'date_created', $exported = null, string $contentType = self::contentTypes['answersGet'][0])
    {
        return $this->answersGetAsyncWithHttpInfo($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersGetAsyncWithHttpInfo
     *
     * Get all answers
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $job_id Filtrování odpovědí dle ID inzerátů. (optional)
     * @param  int $flow_id Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. (optional)
     * @param  int $search Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  \DateTime $date_from Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  \DateTime $date_to Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  string $order (optional, default to 'date_created')
     * @param  int $exported (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersGetAsyncWithHttpInfo($limit = 10, $page = 1, $job_id = null, $flow_id = null, $search = null, $date_from = null, $date_to = null, $order = 'date_created', $exported = null, string $contentType = self::contentTypes['answersGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersGet200Response';
        $request = $this->answersGetRequest($limit, $page, $job_id, $flow_id, $search, $date_from, $date_to, $order, $exported, $contentType);

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
     * Create request for operation 'answersGet'
     *
     * @param  int $limit Maximální limit pro stránkovač je 50. Pokud není určen, vrací 10 položek. (optional, default to 10)
     * @param  int $page Aktuální stránka. (optional, default to 1)
     * @param  int $job_id Filtrování odpovědí dle ID inzerátů. (optional)
     * @param  int $flow_id Filtrování odpovědí dle Flow ID. Pro filtrování pouze **ZAMÍTNUTÝCH** odpovědí je &#x60;flow_id &#x3D; -1&#x60;. (optional)
     * @param  int $search Filtrace podle ID jednotlivých filtračních položek přiřazených k inzerátu. Více ve [Filtračních položkách](#tag/Job-filters/paths/~1filters/get). (optional)
     * @param  \DateTime $date_from Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, od jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  \DateTime $date_to Datum ve formátu \&quot;YYYY-MM-DD\&quot;. Omezení, do jakého data (včetně) se odpovědi vypíšou. (optional)
     * @param  string $order (optional, default to 'date_created')
     * @param  int $exported (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersGetRequest($limit = 10, $page = 1, $job_id = null, $flow_id = null, $search = null, $date_from = null, $date_to = null, $order = 'date_created', $exported = null, string $contentType = self::contentTypes['answersGet'][0])
    {

        if ($limit !== null && $limit > 50) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling CandidatesApi.answersGet, must be smaller than or equal to 50.');
        }
        









        $resourcePath = '/answers';
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
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $job_id,
            'job_id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $flow_id,
            'flow_id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search,
            'search', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $date_from,
            'date_from', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $date_to,
            'date_to', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order,
            'order', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $exported,
            'exported', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));




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
     * Operation answersPost
     *
     * Create new answer
     *
     * @param  \RecruitisApi\Model\AnswersPostRequest $answers_post_request answers_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersPost201Response|\RecruitisApi\Model\JobsPost400Response
     */
    public function answersPost($answers_post_request = null, string $contentType = self::contentTypes['answersPost'][0])
    {
        list($response) = $this->answersPostWithHttpInfo($answers_post_request, $contentType);
        return $response;
    }

    /**
     * Operation answersPostWithHttpInfo
     *
     * Create new answer
     *
     * @param  \RecruitisApi\Model\AnswersPostRequest $answers_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersPost201Response|\RecruitisApi\Model\JobsPost400Response> array of \RecruitisApi\Model\AnswersPost201Response|\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersPostWithHttpInfo($answers_post_request = null, string $contentType = self::contentTypes['answersPost'][0])
    {
        $request = $this->answersPostRequest($answers_post_request, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersPost201Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation answersPostAsync
     *
     * Create new answer
     *
     * @param  \RecruitisApi\Model\AnswersPostRequest $answers_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersPostAsync($answers_post_request = null, string $contentType = self::contentTypes['answersPost'][0])
    {
        return $this->answersPostAsyncWithHttpInfo($answers_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersPostAsyncWithHttpInfo
     *
     * Create new answer
     *
     * @param  \RecruitisApi\Model\AnswersPostRequest $answers_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersPostAsyncWithHttpInfo($answers_post_request = null, string $contentType = self::contentTypes['answersPost'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersPost201Response';
        $request = $this->answersPostRequest($answers_post_request, $contentType);

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
     * Create request for operation 'answersPost'
     *
     * @param  \RecruitisApi\Model\AnswersPostRequest $answers_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersPostRequest($answers_post_request = null, string $contentType = self::contentTypes['answersPost'][0])
    {



        $resourcePath = '/answers';
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
        if (isset($answers_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($answers_post_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($answers_post_request));
                }
            } else {
                $httpBody = $answers_post_request;
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
     * Operation candidatesFormIdGet
     *
     * Load a landing page
     *
     * @param  int $id 32 znaků dlouhý hash (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesFormIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesFormIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response
     */
    public function candidatesFormIdGet($id, string $contentType = self::contentTypes['candidatesFormIdGet'][0])
    {
        list($response) = $this->candidatesFormIdGetWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation candidatesFormIdGetWithHttpInfo
     *
     * Load a landing page
     *
     * @param  int $id 32 znaků dlouhý hash (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesFormIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesFormIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response|> array of \RecruitisApi\Model\CandidatesFormIdGet200Response|\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesFormIdGetWithHttpInfo($id, string $contentType = self::contentTypes['candidatesFormIdGet'][0])
    {
        $request = $this->candidatesFormIdGetRequest($id, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesFormIdGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesFormIdGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesFormIdGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesFormIdGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesFormIdGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesFormIdGetAsync
     *
     * Load a landing page
     *
     * @param  int $id 32 znaků dlouhý hash (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesFormIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesFormIdGetAsync($id, string $contentType = self::contentTypes['candidatesFormIdGet'][0])
    {
        return $this->candidatesFormIdGetAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesFormIdGetAsyncWithHttpInfo
     *
     * Load a landing page
     *
     * @param  int $id 32 znaků dlouhý hash (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesFormIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesFormIdGetAsyncWithHttpInfo($id, string $contentType = self::contentTypes['candidatesFormIdGet'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesFormIdGet200Response';
        $request = $this->candidatesFormIdGetRequest($id, $contentType);

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
     * Create request for operation 'candidatesFormIdGet'
     *
     * @param  int $id 32 znaků dlouhý hash (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesFormIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesFormIdGetRequest($id, string $contentType = self::contentTypes['candidatesFormIdGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesFormIdGet'
            );
        }


        $resourcePath = '/candidates/form/{id}';
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
     * Operation candidatesIdAnswerIdCommunicationGet
     *
     * List candidate communication
     *
     * @param  int $id id (required)
     * @param  int $answer_id answer_id (required)
     * @param  string $type type (optional)
     * @param  string $sender_type sender_type (optional)
     * @param  int $limit limit (optional)
     * @param  int $page page (optional)
     * @param  int $author_id author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function candidatesIdAnswerIdCommunicationGet($id, $answer_id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationGet'][0])
    {
        list($response) = $this->candidatesIdAnswerIdCommunicationGetWithHttpInfo($id, $answer_id, $type, $sender_type, $limit, $page, $author_id, $contentType);
        return $response;
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationGetWithHttpInfo
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesIdAnswerIdCommunicationGetWithHttpInfo($id, $answer_id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationGet'][0])
    {
        $request = $this->candidatesIdAnswerIdCommunicationGetRequest($id, $answer_id, $type, $sender_type, $limit, $page, $author_id, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationGetAsync
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdAnswerIdCommunicationGetAsync($id, $answer_id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationGet'][0])
    {
        return $this->candidatesIdAnswerIdCommunicationGetAsyncWithHttpInfo($id, $answer_id, $type, $sender_type, $limit, $page, $author_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationGetAsyncWithHttpInfo
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdAnswerIdCommunicationGetAsyncWithHttpInfo($id, $answer_id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationGet'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationGet200Response';
        $request = $this->candidatesIdAnswerIdCommunicationGetRequest($id, $answer_id, $type, $sender_type, $limit, $page, $author_id, $contentType);

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
     * Create request for operation 'candidatesIdAnswerIdCommunicationGet'
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesIdAnswerIdCommunicationGetRequest($id, $answer_id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesIdAnswerIdCommunicationGet'
            );
        }

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling candidatesIdAnswerIdCommunicationGet'
            );
        }







        $resourcePath = '/candidates/{id}/{answer_id}/communication';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $type,
            'type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sender_type,
            'sender_type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $author_id,
            'author_id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
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
     * Operation candidatesIdAnswerIdCommunicationPost
     *
     * Create new communication record
     *
     * @param  int $id id (required)
     * @param  int $answer_id answer_id (required)
     * @param  \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest $candidates_id_answer_id_communication_post_request candidates_id_answer_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response
     */
    public function candidatesIdAnswerIdCommunicationPost($id, $answer_id, $candidates_id_answer_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationPost'][0])
    {
        list($response) = $this->candidatesIdAnswerIdCommunicationPostWithHttpInfo($id, $answer_id, $candidates_id_answer_id_communication_post_request, $contentType);
        return $response;
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationPostWithHttpInfo
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest $candidates_id_answer_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response> array of \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesIdAnswerIdCommunicationPostWithHttpInfo($id, $answer_id, $candidates_id_answer_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationPost'][0])
    {
        $request = $this->candidatesIdAnswerIdCommunicationPostRequest($id, $answer_id, $candidates_id_answer_id_communication_post_request, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationPostAsync
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest $candidates_id_answer_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdAnswerIdCommunicationPostAsync($id, $answer_id, $candidates_id_answer_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationPost'][0])
    {
        return $this->candidatesIdAnswerIdCommunicationPostAsyncWithHttpInfo($id, $answer_id, $candidates_id_answer_id_communication_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesIdAnswerIdCommunicationPostAsyncWithHttpInfo
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest $candidates_id_answer_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdAnswerIdCommunicationPostAsyncWithHttpInfo($id, $answer_id, $candidates_id_answer_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationPost'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response';
        $request = $this->candidatesIdAnswerIdCommunicationPostRequest($id, $answer_id, $candidates_id_answer_id_communication_post_request, $contentType);

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
     * Create request for operation 'candidatesIdAnswerIdCommunicationPost'
     *
     * @param  int $id (required)
     * @param  int $answer_id (required)
     * @param  \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPostRequest $candidates_id_answer_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdAnswerIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesIdAnswerIdCommunicationPostRequest($id, $answer_id, $candidates_id_answer_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdAnswerIdCommunicationPost'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesIdAnswerIdCommunicationPost'
            );
        }

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling candidatesIdAnswerIdCommunicationPost'
            );
        }



        $resourcePath = '/candidates/{id}/{answer_id}/communication';
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
        if ($answer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'answer_id' . '}',
                ObjectSerializer::toPathValue($answer_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($candidates_id_answer_id_communication_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($candidates_id_answer_id_communication_post_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($candidates_id_answer_id_communication_post_request));
                }
            } else {
                $httpBody = $candidates_id_answer_id_communication_post_request;
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
     * Operation candidatesIdCommunicationGet
     *
     * List candidate communication
     *
     * @param  int $id id (required)
     * @param  string $type type (optional)
     * @param  string $sender_type sender_type (optional)
     * @param  int $limit limit (optional)
     * @param  int $page page (optional)
     * @param  int $author_id author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\JobsIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function candidatesIdCommunicationGet($id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdCommunicationGet'][0])
    {
        list($response) = $this->candidatesIdCommunicationGetWithHttpInfo($id, $type, $sender_type, $limit, $page, $author_id, $contentType);
        return $response;
    }

    /**
     * Operation candidatesIdCommunicationGetWithHttpInfo
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\JobsIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\JobsIdCommunicationGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesIdCommunicationGetWithHttpInfo($id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdCommunicationGet'][0])
    {
        $request = $this->candidatesIdCommunicationGetRequest($id, $type, $sender_type, $limit, $page, $author_id, $contentType);

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
                    if ('\RecruitisApi\Model\JobsIdCommunicationGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsIdCommunicationGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsIdCommunicationGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\JobsIdCommunicationGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\JobsIdCommunicationGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesIdCommunicationGetAsync
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdCommunicationGetAsync($id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdCommunicationGet'][0])
    {
        return $this->candidatesIdCommunicationGetAsyncWithHttpInfo($id, $type, $sender_type, $limit, $page, $author_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesIdCommunicationGetAsyncWithHttpInfo
     *
     * List candidate communication
     *
     * @param  int $id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdCommunicationGetAsyncWithHttpInfo($id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdCommunicationGet'][0])
    {
        $returnType = '\RecruitisApi\Model\JobsIdCommunicationGet200Response';
        $request = $this->candidatesIdCommunicationGetRequest($id, $type, $sender_type, $limit, $page, $author_id, $contentType);

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
     * Create request for operation 'candidatesIdCommunicationGet'
     *
     * @param  int $id (required)
     * @param  string $type (optional)
     * @param  string $sender_type (optional)
     * @param  int $limit (optional)
     * @param  int $page (optional)
     * @param  int $author_id (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesIdCommunicationGetRequest($id, $type = null, $sender_type = null, $limit = null, $page = null, $author_id = null, string $contentType = self::contentTypes['candidatesIdCommunicationGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesIdCommunicationGet'
            );
        }







        $resourcePath = '/candidates/{id}/communication';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $type,
            'type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sender_type,
            'sender_type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $author_id,
            'author_id', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ));


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
     * Operation candidatesIdCommunicationPost
     *
     * Create new communication record
     *
     * @param  int $id id (required)
     * @param  \RecruitisApi\Model\CandidatesIdCommunicationPostRequest $candidates_id_communication_post_request candidates_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response
     */
    public function candidatesIdCommunicationPost($id, $candidates_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdCommunicationPost'][0])
    {
        list($response) = $this->candidatesIdCommunicationPostWithHttpInfo($id, $candidates_id_communication_post_request, $contentType);
        return $response;
    }

    /**
     * Operation candidatesIdCommunicationPostWithHttpInfo
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  \RecruitisApi\Model\CandidatesIdCommunicationPostRequest $candidates_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response> array of \RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response|\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesIdCommunicationPostWithHttpInfo($id, $candidates_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdCommunicationPost'][0])
    {
        $request = $this->candidatesIdCommunicationPostRequest($id, $candidates_id_communication_post_request, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesIdCommunicationPostAsync
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  \RecruitisApi\Model\CandidatesIdCommunicationPostRequest $candidates_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdCommunicationPostAsync($id, $candidates_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdCommunicationPost'][0])
    {
        return $this->candidatesIdCommunicationPostAsyncWithHttpInfo($id, $candidates_id_communication_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesIdCommunicationPostAsyncWithHttpInfo
     *
     * Create new communication record
     *
     * @param  int $id (required)
     * @param  \RecruitisApi\Model\CandidatesIdCommunicationPostRequest $candidates_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdCommunicationPostAsyncWithHttpInfo($id, $candidates_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdCommunicationPost'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesIdAnswerIdCommunicationPost201Response';
        $request = $this->candidatesIdCommunicationPostRequest($id, $candidates_id_communication_post_request, $contentType);

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
     * Create request for operation 'candidatesIdCommunicationPost'
     *
     * @param  int $id (required)
     * @param  \RecruitisApi\Model\CandidatesIdCommunicationPostRequest $candidates_id_communication_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdCommunicationPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesIdCommunicationPostRequest($id, $candidates_id_communication_post_request = null, string $contentType = self::contentTypes['candidatesIdCommunicationPost'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesIdCommunicationPost'
            );
        }



        $resourcePath = '/candidates/{id}/communication';
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
        if (isset($candidates_id_communication_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($candidates_id_communication_post_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($candidates_id_communication_post_request));
                }
            } else {
                $httpBody = $candidates_id_communication_post_request;
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
     * Operation candidatesIdDelete
     *
     * Delete candidate
     *
     * @param  int $id id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdDelete'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdDelete200Response|\RecruitisApi\Model\CandidatesIdDelete403Response|\RecruitisApi\Model\JobsIdGet404Response
     */
    public function candidatesIdDelete($id, string $contentType = self::contentTypes['candidatesIdDelete'][0])
    {
        list($response) = $this->candidatesIdDeleteWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation candidatesIdDeleteWithHttpInfo
     *
     * Delete candidate
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdDelete'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesIdDelete200Response|\RecruitisApi\Model\CandidatesIdDelete403Response|\RecruitisApi\Model\JobsIdGet404Response> array of \RecruitisApi\Model\CandidatesIdDelete200Response|\RecruitisApi\Model\CandidatesIdDelete403Response|\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesIdDeleteWithHttpInfo($id, string $contentType = self::contentTypes['candidatesIdDelete'][0])
    {
        $request = $this->candidatesIdDeleteRequest($id, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesIdDelete200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesIdDelete200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesIdDelete200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\RecruitisApi\Model\CandidatesIdDelete403Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesIdDelete403Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesIdDelete403Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\RecruitisApi\Model\JobsIdGet404Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsIdGet404Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsIdGet404Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesIdDelete200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesIdDelete200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\CandidatesIdDelete403Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsIdGet404Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesIdDeleteAsync
     *
     * Delete candidate
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdDeleteAsync($id, string $contentType = self::contentTypes['candidatesIdDelete'][0])
    {
        return $this->candidatesIdDeleteAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesIdDeleteAsyncWithHttpInfo
     *
     * Delete candidate
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesIdDeleteAsyncWithHttpInfo($id, string $contentType = self::contentTypes['candidatesIdDelete'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesIdDelete200Response';
        $request = $this->candidatesIdDeleteRequest($id, $contentType);

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
     * Create request for operation 'candidatesIdDelete'
     *
     * @param  int $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesIdDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesIdDeleteRequest($id, string $contentType = self::contentTypes['candidatesIdDelete'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling candidatesIdDelete'
            );
        }


        $resourcePath = '/candidates/{id}';
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
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation candidatesPost
     *
     * Create new candidate
     *
     * @param  \RecruitisApi\Model\CandidatesPostRequest $candidates_post_request candidates_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\CandidatesPost201Response|\RecruitisApi\Model\JobsPost400Response
     */
    public function candidatesPost($candidates_post_request = null, string $contentType = self::contentTypes['candidatesPost'][0])
    {
        list($response) = $this->candidatesPostWithHttpInfo($candidates_post_request, $contentType);
        return $response;
    }

    /**
     * Operation candidatesPostWithHttpInfo
     *
     * Create new candidate
     *
     * @param  \RecruitisApi\Model\CandidatesPostRequest $candidates_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesPost'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\CandidatesPost201Response|\RecruitisApi\Model\JobsPost400Response> array of \RecruitisApi\Model\CandidatesPost201Response|\RecruitisApi\Model\JobsPost400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesPostWithHttpInfo($candidates_post_request = null, string $contentType = self::contentTypes['candidatesPost'][0])
    {
        $request = $this->candidatesPostRequest($candidates_post_request, $contentType);

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
                    if ('\RecruitisApi\Model\CandidatesPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\CandidatesPost201Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\CandidatesPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\RecruitisApi\Model\JobsPost400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\JobsPost400Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\JobsPost400Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\CandidatesPost201Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\CandidatesPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\JobsPost400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesPostAsync
     *
     * Create new candidate
     *
     * @param  \RecruitisApi\Model\CandidatesPostRequest $candidates_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesPostAsync($candidates_post_request = null, string $contentType = self::contentTypes['candidatesPost'][0])
    {
        return $this->candidatesPostAsyncWithHttpInfo($candidates_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesPostAsyncWithHttpInfo
     *
     * Create new candidate
     *
     * @param  \RecruitisApi\Model\CandidatesPostRequest $candidates_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesPostAsyncWithHttpInfo($candidates_post_request = null, string $contentType = self::contentTypes['candidatesPost'][0])
    {
        $returnType = '\RecruitisApi\Model\CandidatesPost201Response';
        $request = $this->candidatesPostRequest($candidates_post_request, $contentType);

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
     * Create request for operation 'candidatesPost'
     *
     * @param  \RecruitisApi\Model\CandidatesPostRequest $candidates_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesPostRequest($candidates_post_request = null, string $contentType = self::contentTypes['candidatesPost'][0])
    {



        $resourcePath = '/candidates';
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
        if (isset($candidates_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($candidates_post_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($candidates_post_request));
                }
            } else {
                $httpBody = $candidates_post_request;
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
     * Operation candidatesUserIdExtraGet
     *
     * Get candidate tags
     *
     * @param  int $user_id user_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function candidatesUserIdExtraGet($user_id, string $contentType = self::contentTypes['candidatesUserIdExtraGet'][0])
    {
        list($response) = $this->candidatesUserIdExtraGetWithHttpInfo($user_id, $contentType);
        return $response;
    }

    /**
     * Operation candidatesUserIdExtraGetWithHttpInfo
     *
     * Get candidate tags
     *
     * @param  int $user_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersAnswerIdExtraGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesUserIdExtraGetWithHttpInfo($user_id, string $contentType = self::contentTypes['candidatesUserIdExtraGet'][0])
    {
        $request = $this->candidatesUserIdExtraGetRequest($user_id, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesUserIdExtraGetAsync
     *
     * Get candidate tags
     *
     * @param  int $user_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesUserIdExtraGetAsync($user_id, string $contentType = self::contentTypes['candidatesUserIdExtraGet'][0])
    {
        return $this->candidatesUserIdExtraGetAsyncWithHttpInfo($user_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesUserIdExtraGetAsyncWithHttpInfo
     *
     * Get candidate tags
     *
     * @param  int $user_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesUserIdExtraGetAsyncWithHttpInfo($user_id, string $contentType = self::contentTypes['candidatesUserIdExtraGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraGet200Response';
        $request = $this->candidatesUserIdExtraGetRequest($user_id, $contentType);

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
     * Create request for operation 'candidatesUserIdExtraGet'
     *
     * @param  int $user_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesUserIdExtraGetRequest($user_id, string $contentType = self::contentTypes['candidatesUserIdExtraGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling candidatesUserIdExtraGet'
            );
        }


        $resourcePath = '/candidates/{user_id}/extra';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
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
     * Operation candidatesUserIdExtraPut
     *
     * Update candidate tags
     *
     * @param  int $user_id user_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function candidatesUserIdExtraPut($user_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['candidatesUserIdExtraPut'][0])
    {
        list($response) = $this->candidatesUserIdExtraPutWithHttpInfo($user_id, $answers_answer_id_extra_put_request, $contentType);
        return $response;
    }

    /**
     * Operation candidatesUserIdExtraPutWithHttpInfo
     *
     * Update candidate tags
     *
     * @param  int $user_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraPut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersAnswerIdExtraPut200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function candidatesUserIdExtraPutWithHttpInfo($user_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['candidatesUserIdExtraPut'][0])
    {
        $request = $this->candidatesUserIdExtraPutRequest($user_id, $answers_answer_id_extra_put_request, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\RecruitisApi\Model\LoginPut401Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\LoginPut401Response' !== 'string') {
                            try {
                                if(defined('JSON_THROW_ON_ERROR')){
                                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                                } else {
                                    $decodedContent = json_decode($content, false, 512);
                                    if(!$decodedContent){
                                        throw new \JsonException();
                                    }
                                    $content = $decodedContent;
                                }
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\LoginPut401Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        if(defined('JSON_THROW_ON_ERROR')){
                            $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                        } else {
                            $decodedContent = json_decode($content, false, 512);
                            if(!$decodedContent){
                                throw new \JsonException();
                            }
                            $content = $decodedContent;
                        }
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
                        '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\RecruitisApi\Model\LoginPut401Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation candidatesUserIdExtraPutAsync
     *
     * Update candidate tags
     *
     * @param  int $user_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesUserIdExtraPutAsync($user_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['candidatesUserIdExtraPut'][0])
    {
        return $this->candidatesUserIdExtraPutAsyncWithHttpInfo($user_id, $answers_answer_id_extra_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation candidatesUserIdExtraPutAsyncWithHttpInfo
     *
     * Update candidate tags
     *
     * @param  int $user_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function candidatesUserIdExtraPutAsyncWithHttpInfo($user_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['candidatesUserIdExtraPut'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdExtraPut200Response';
        $request = $this->candidatesUserIdExtraPutRequest($user_id, $answers_answer_id_extra_put_request, $contentType);

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
     * Create request for operation 'candidatesUserIdExtraPut'
     *
     * @param  int $user_id (required)
     * @param  \RecruitisApi\Model\AnswersAnswerIdExtraPutRequest $answers_answer_id_extra_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['candidatesUserIdExtraPut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function candidatesUserIdExtraPutRequest($user_id, $answers_answer_id_extra_put_request = null, string $contentType = self::contentTypes['candidatesUserIdExtraPut'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling candidatesUserIdExtraPut'
            );
        }



        $resourcePath = '/candidates/{user_id}/extra';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'user_id' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($answers_answer_id_extra_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_extra_put_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($answers_answer_id_extra_put_request));
                }
            } else {
                $httpBody = $answers_answer_id_extra_put_request;
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
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return mixed[] of http client options
     * @phpstan-return array<string, mixed>
     * @psalm-return array<string, mixed>
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
