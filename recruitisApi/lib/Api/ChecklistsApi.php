<?php
/**
 * ChecklistsApi
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
 * ChecklistsApi Class Doc Comment
 *
 * @category Class
 * @package  RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ChecklistsApi
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
        'answersAnswerIdChecklistsFlowIdGet' => [
            'application/json',
        ],
        'checklistsAnswerIdItemItemIdStatePut' => [
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
     * Operation answersAnswerIdChecklistsFlowIdGet
     *
     * List answer checklist
     *
     * @param  int $answer_id answer_id (required)
     * @param  int $flow_id flow_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdChecklistsFlowIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function answersAnswerIdChecklistsFlowIdGet($answer_id, $flow_id, string $contentType = self::contentTypes['answersAnswerIdChecklistsFlowIdGet'][0])
    {
        list($response) = $this->answersAnswerIdChecklistsFlowIdGetWithHttpInfo($answer_id, $flow_id, $contentType);
        return $response;
    }

    /**
     * Operation answersAnswerIdChecklistsFlowIdGetWithHttpInfo
     *
     * List answer checklist
     *
     * @param  int $answer_id (required)
     * @param  int $flow_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdChecklistsFlowIdGet'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function answersAnswerIdChecklistsFlowIdGetWithHttpInfo($answer_id, $flow_id, string $contentType = self::contentTypes['answersAnswerIdChecklistsFlowIdGet'][0])
    {
        $request = $this->answersAnswerIdChecklistsFlowIdGetRequest($answer_id, $flow_id, $contentType);

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
                    if ('\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response', []),
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

            $returnType = '\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response';
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
                        '\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response',
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
     * Operation answersAnswerIdChecklistsFlowIdGetAsync
     *
     * List answer checklist
     *
     * @param  int $answer_id (required)
     * @param  int $flow_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdChecklistsFlowIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdChecklistsFlowIdGetAsync($answer_id, $flow_id, string $contentType = self::contentTypes['answersAnswerIdChecklistsFlowIdGet'][0])
    {
        return $this->answersAnswerIdChecklistsFlowIdGetAsyncWithHttpInfo($answer_id, $flow_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation answersAnswerIdChecklistsFlowIdGetAsyncWithHttpInfo
     *
     * List answer checklist
     *
     * @param  int $answer_id (required)
     * @param  int $flow_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdChecklistsFlowIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function answersAnswerIdChecklistsFlowIdGetAsyncWithHttpInfo($answer_id, $flow_id, string $contentType = self::contentTypes['answersAnswerIdChecklistsFlowIdGet'][0])
    {
        $returnType = '\RecruitisApi\Model\AnswersAnswerIdChecklistsFlowIdGet200Response';
        $request = $this->answersAnswerIdChecklistsFlowIdGetRequest($answer_id, $flow_id, $contentType);

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
     * Create request for operation 'answersAnswerIdChecklistsFlowIdGet'
     *
     * @param  int $answer_id (required)
     * @param  int $flow_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['answersAnswerIdChecklistsFlowIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function answersAnswerIdChecklistsFlowIdGetRequest($answer_id, $flow_id, string $contentType = self::contentTypes['answersAnswerIdChecklistsFlowIdGet'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling answersAnswerIdChecklistsFlowIdGet'
            );
        }

        // verify the required parameter 'flow_id' is set
        if ($flow_id === null || (is_array($flow_id) && count($flow_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $flow_id when calling answersAnswerIdChecklistsFlowIdGet'
            );
        }


        $resourcePath = '/answers/{answer_id}/checklists/{flow_id}';
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
        // path params
        if ($flow_id !== null) {
            $resourcePath = str_replace(
                '{' . 'flow_id' . '}',
                ObjectSerializer::toPathValue($flow_id),
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
     * Operation checklistsAnswerIdItemItemIdStatePut
     *
     * Update item state
     *
     * @param  int $answer_id answer_id (required)
     * @param  int $item_id item_id (required)
     * @param  \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest $checklists_answer_id_item_item_id_state_put_request checklists_answer_id_item_item_id_state_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checklistsAnswerIdItemItemIdStatePut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed[]|int|object|null|\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response|\RecruitisApi\Model\LoginPut401Response
     */
    public function checklistsAnswerIdItemItemIdStatePut($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request = null, string $contentType = self::contentTypes['checklistsAnswerIdItemItemIdStatePut'][0])
    {
        list($response) = $this->checklistsAnswerIdItemItemIdStatePutWithHttpInfo($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request, $contentType);
        return $response;
    }

    /**
     * Operation checklistsAnswerIdItemItemIdStatePutWithHttpInfo
     *
     * Update item state
     *
     * @param  int $answer_id (required)
     * @param  int $item_id (required)
     * @param  \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest $checklists_answer_id_item_item_id_state_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checklistsAnswerIdItemItemIdStatePut'] to see the possible values for this operation
     *
     * @throws \RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<mixed[]|int|object|null|\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response|\RecruitisApi\Model\LoginPut401Response> array of \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response|\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function checklistsAnswerIdItemItemIdStatePutWithHttpInfo($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request = null, string $contentType = self::contentTypes['checklistsAnswerIdItemItemIdStatePut'][0])
    {
        $request = $this->checklistsAnswerIdItemItemIdStatePutRequest($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request, $contentType);

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
                    if ('\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response', []),
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

            $returnType = '\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response';
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
                        '\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response',
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
     * Operation checklistsAnswerIdItemItemIdStatePutAsync
     *
     * Update item state
     *
     * @param  int $answer_id (required)
     * @param  int $item_id (required)
     * @param  \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest $checklists_answer_id_item_item_id_state_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checklistsAnswerIdItemItemIdStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function checklistsAnswerIdItemItemIdStatePutAsync($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request = null, string $contentType = self::contentTypes['checklistsAnswerIdItemItemIdStatePut'][0])
    {
        return $this->checklistsAnswerIdItemItemIdStatePutAsyncWithHttpInfo($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation checklistsAnswerIdItemItemIdStatePutAsyncWithHttpInfo
     *
     * Update item state
     *
     * @param  int $answer_id (required)
     * @param  int $item_id (required)
     * @param  \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest $checklists_answer_id_item_item_id_state_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checklistsAnswerIdItemItemIdStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function checklistsAnswerIdItemItemIdStatePutAsyncWithHttpInfo($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request = null, string $contentType = self::contentTypes['checklistsAnswerIdItemItemIdStatePut'][0])
    {
        $returnType = '\RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePut200Response';
        $request = $this->checklistsAnswerIdItemItemIdStatePutRequest($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request, $contentType);

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
     * Create request for operation 'checklistsAnswerIdItemItemIdStatePut'
     *
     * @param  int $answer_id (required)
     * @param  int $item_id (required)
     * @param  \RecruitisApi\Model\ChecklistsAnswerIdItemItemIdStatePutRequest $checklists_answer_id_item_item_id_state_put_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checklistsAnswerIdItemItemIdStatePut'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function checklistsAnswerIdItemItemIdStatePutRequest($answer_id, $item_id, $checklists_answer_id_item_item_id_state_put_request = null, string $contentType = self::contentTypes['checklistsAnswerIdItemItemIdStatePut'][0])
    {

        // verify the required parameter 'answer_id' is set
        if ($answer_id === null || (is_array($answer_id) && count($answer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $answer_id when calling checklistsAnswerIdItemItemIdStatePut'
            );
        }

        // verify the required parameter 'item_id' is set
        if ($item_id === null || (is_array($item_id) && count($item_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $item_id when calling checklistsAnswerIdItemItemIdStatePut'
            );
        }



        $resourcePath = '/checklists/{answer_id}/item/{item_id}/state';
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
        // path params
        if ($item_id !== null) {
            $resourcePath = str_replace(
                '{' . 'item_id' . '}',
                ObjectSerializer::toPathValue($item_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($checklists_answer_id_item_item_id_state_put_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                if(PHP_VERSION_ID < 70200){
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($checklists_answer_id_item_item_id_state_put_request));
                } else {
                    $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($checklists_answer_id_item_item_id_state_put_request));
                }
            } else {
                $httpBody = $checklists_answer_id_item_item_id_state_put_request;
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
