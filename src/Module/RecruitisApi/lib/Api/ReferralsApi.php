<?php
/**
 * ReferralsApi
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
 * ReferralsApi Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ReferralsApi
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
        'referralsGet' => [
            'application/json',
        ],
        'referralsIdGet' => [
            'application/json',
        ],
        'referralsPost' => [
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
     * Operation referralsGet
     *
     * Get referral list
     *
     * @param  string[] $id ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. (optional)
     * @param  int $limit Maximální počet entit, které má server vrátit. Maximální limit je 100. (optional, default to 10)
     * @param  int $page Strana s entitami. (optional, default to 1)
     * @param  OneOfStringObject $search Vrátí referraly s daným jménem, popř. emailem. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\ReferralsGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response
     */
    public function referralsGet($id = null, $limit = 10, $page = 1, $search = null, string $contentType = self::contentTypes['referralsGet'][0])
    {
        list($response) = $this->referralsGetWithHttpInfo($id, $limit, $page, $search, $contentType);
        return $response;
    }

    /**
     * Operation referralsGetWithHttpInfo
     *
     * Get referral list
     *
     * @param  string[] $id ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. (optional)
     * @param  int $limit Maximální počet entit, které má server vrátit. Maximální limit je 100. (optional, default to 10)
     * @param  int $page Strana s entitami. (optional, default to 1)
     * @param  OneOfStringObject $search Vrátí referraly s daným jménem, popř. emailem. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\ReferralsGet200Response|\App\Module\RecruitisApi\Model\LoginPut401Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function referralsGetWithHttpInfo($id = null, $limit = 10, $page = 1, $search = null, string $contentType = self::contentTypes['referralsGet'][0])
    {
        $request = $this->referralsGetRequest($id, $limit, $page, $search, $contentType);

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
                    if ('\App\Module\RecruitisApi\Model\ReferralsGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\ReferralsGet200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\ReferralsGet200Response', []),
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

            $returnType = '\App\Module\RecruitisApi\Model\ReferralsGet200Response';
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
                        '\App\Module\RecruitisApi\Model\ReferralsGet200Response',
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
     * Operation referralsGetAsync
     *
     * Get referral list
     *
     * @param  string[] $id ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. (optional)
     * @param  int $limit Maximální počet entit, které má server vrátit. Maximální limit je 100. (optional, default to 10)
     * @param  int $page Strana s entitami. (optional, default to 1)
     * @param  OneOfStringObject $search Vrátí referraly s daným jménem, popř. emailem. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsGetAsync($id = null, $limit = 10, $page = 1, $search = null, string $contentType = self::contentTypes['referralsGet'][0])
    {
        return $this->referralsGetAsyncWithHttpInfo($id, $limit, $page, $search, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation referralsGetAsyncWithHttpInfo
     *
     * Get referral list
     *
     * @param  string[] $id ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. (optional)
     * @param  int $limit Maximální počet entit, které má server vrátit. Maximální limit je 100. (optional, default to 10)
     * @param  int $page Strana s entitami. (optional, default to 1)
     * @param  OneOfStringObject $search Vrátí referraly s daným jménem, popř. emailem. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsGetAsyncWithHttpInfo($id = null, $limit = 10, $page = 1, $search = null, string $contentType = self::contentTypes['referralsGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\ReferralsGet200Response';
        $request = $this->referralsGetRequest($id, $limit, $page, $search, $contentType);

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
     * Create request for operation 'referralsGet'
     *
     * @param  string[] $id ID referrala, popř. &#x60;access_id&#x60; referrala. ID se může zadat i jako array. Pozor: nekombinujte referral ID a referral &#x60;access_id&#x60;. (optional)
     * @param  int $limit Maximální počet entit, které má server vrátit. Maximální limit je 100. (optional, default to 10)
     * @param  int $page Strana s entitami. (optional, default to 1)
     * @param  OneOfStringObject $search Vrátí referraly s daným jménem, popř. emailem. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function referralsGetRequest($id = null, $limit = 10, $page = 1, $search = null, string $contentType = self::contentTypes['referralsGet'][0])
    {


        if ($limit !== null && $limit > 100) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReferralsApi.referralsGet, must be smaller than or equal to 100.');
        }
        if ($limit !== null && $limit < 0) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReferralsApi.referralsGet, must be bigger than or equal to 0.');
        }
        
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling ReferralsApi.referralsGet, must be bigger than or equal to 1.');
        }
        


        $resourcePath = '/referrals';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $id,
            'id[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
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
            $search,
            'search', // param base name
            '', // openApiType
            '', // style
            false, // explode
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
     * Operation referralsIdGet
     *
     * Get referral
     *
     * @param  string $id id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsIdGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\ReferralsIdGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response
     */
    public function referralsIdGet($id, string $contentType = self::contentTypes['referralsIdGet'][0])
    {
        list($response) = $this->referralsIdGetWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation referralsIdGetWithHttpInfo
     *
     * Get referral
     *
     * @param  string $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsIdGet'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\ReferralsIdGet200Response|\App\Module\RecruitisApi\Model\JobsIdGet404Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function referralsIdGetWithHttpInfo($id, string $contentType = self::contentTypes['referralsIdGet'][0])
    {
        $request = $this->referralsIdGetRequest($id, $contentType);

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
                    if ('\App\Module\RecruitisApi\Model\ReferralsIdGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\ReferralsIdGet200Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\ReferralsIdGet200Response', []),
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

            $returnType = '\App\Module\RecruitisApi\Model\ReferralsIdGet200Response';
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
                        '\App\Module\RecruitisApi\Model\ReferralsIdGet200Response',
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
     * Operation referralsIdGetAsync
     *
     * Get referral
     *
     * @param  string $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsIdGetAsync($id, string $contentType = self::contentTypes['referralsIdGet'][0])
    {
        return $this->referralsIdGetAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation referralsIdGetAsyncWithHttpInfo
     *
     * Get referral
     *
     * @param  string $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsIdGetAsyncWithHttpInfo($id, string $contentType = self::contentTypes['referralsIdGet'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\ReferralsIdGet200Response';
        $request = $this->referralsIdGetRequest($id, $contentType);

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
     * Create request for operation 'referralsIdGet'
     *
     * @param  string $id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsIdGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function referralsIdGetRequest($id, string $contentType = self::contentTypes['referralsIdGet'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling referralsIdGet'
            );
        }


        $resourcePath = '/referrals/{id}';
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
     * Operation referralsPost
     *
     * Create new referal
     *
     * @param  \App\Module\RecruitisApi\Model\ReferralsPostRequest $referrals_post_request referrals_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \App\Module\RecruitisApi\Model\ReferralsPost201Response|\App\Module\RecruitisApi\Model\ReferralsPost409Response
     */
    public function referralsPost($referrals_post_request = null, string $contentType = self::contentTypes['referralsPost'][0])
    {
        list($response) = $this->referralsPostWithHttpInfo($referrals_post_request, $contentType);
        return $response;
    }

    /**
     * Operation referralsPostWithHttpInfo
     *
     * Create new referal
     *
     * @param  \App\Module\RecruitisApi\Model\ReferralsPostRequest $referrals_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsPost'] to see the possible values for this operation
     *
     * @throws \App\Module\RecruitisApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \App\Module\RecruitisApi\Model\ReferralsPost201Response|\App\Module\RecruitisApi\Model\ReferralsPost409Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function referralsPostWithHttpInfo($referrals_post_request = null, string $contentType = self::contentTypes['referralsPost'][0])
    {
        $request = $this->referralsPostRequest($referrals_post_request, $contentType);

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
                    if ('\App\Module\RecruitisApi\Model\ReferralsPost201Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\ReferralsPost201Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\ReferralsPost201Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 409:
                    if ('\App\Module\RecruitisApi\Model\ReferralsPost409Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\Module\RecruitisApi\Model\ReferralsPost409Response' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\App\Module\RecruitisApi\Model\ReferralsPost409Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\Module\RecruitisApi\Model\ReferralsPost201Response';
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
                        '\App\Module\RecruitisApi\Model\ReferralsPost201Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\Module\RecruitisApi\Model\ReferralsPost409Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation referralsPostAsync
     *
     * Create new referal
     *
     * @param  \App\Module\RecruitisApi\Model\ReferralsPostRequest $referrals_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsPostAsync($referrals_post_request = null, string $contentType = self::contentTypes['referralsPost'][0])
    {
        return $this->referralsPostAsyncWithHttpInfo($referrals_post_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation referralsPostAsyncWithHttpInfo
     *
     * Create new referal
     *
     * @param  \App\Module\RecruitisApi\Model\ReferralsPostRequest $referrals_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function referralsPostAsyncWithHttpInfo($referrals_post_request = null, string $contentType = self::contentTypes['referralsPost'][0])
    {
        $returnType = '\App\Module\RecruitisApi\Model\ReferralsPost201Response';
        $request = $this->referralsPostRequest($referrals_post_request, $contentType);

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
     * Create request for operation 'referralsPost'
     *
     * @param  \App\Module\RecruitisApi\Model\ReferralsPostRequest $referrals_post_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['referralsPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function referralsPostRequest($referrals_post_request = null, string $contentType = self::contentTypes['referralsPost'][0])
    {



        $resourcePath = '/referrals';
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
        if (isset($referrals_post_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($referrals_post_request));
            } else {
                $httpBody = $referrals_post_request;
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
