<?php
/**
 * HeaderSelector
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

namespace App\Module\RecruitisApi;

/**
 * HeaderSelector Class Doc Comment
 *
 * @category Class
 * @package  App\Module\RecruitisApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class HeaderSelector
{
    /**
     * @param string[] $accept
     * @param string   $contentType
     * @param bool     $isMultipart
     * @return string[]
     */
    public function selectHeaders(array $accept, string $contentType, bool $isMultipart): array
    {
        $headers = [];

        $accept = $this->selectAcceptHeader($accept);
        if ($accept !== null) {
            $headers['Accept'] = $accept;
        }

        if (!$isMultipart) {
            if($contentType === '') {
                $contentType = 'application/json';
            }

            $headers['Content-Type'] = $contentType;
        }

        return $headers;
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided.
     *
     * @param string[] $accept Array of header
     *
     * @return null|string Accept (e.g. application/json)
     */
    private function selectAcceptHeader(array $accept): ?string
    {
        # filter out empty entries
        $accept = array_filter($accept);

        if (count($accept) === 0) {
            return null;
        }

        # If there's only one Accept header, just use it
        if (count($accept) === 1) {
            return reset($accept);
        }

        # If none of the available Accept headers is of type "json", then just use all them
        $headersWithJson = preg_grep('~(?i)^(application/json|[^;/ \t]+/[^;/ \t]+[+]json)[ \t]*(;.*)?$~', $accept);
        if (count($headersWithJson) === 0) {
            return implode(',', $accept);
        }

        # If we got here, then we need add quality values (weight), as described in IETF RFC 9110, Items 12.4.2/12.5.1,
        # to give the highest priority to json-like headers - recalculating the existing ones, if needed
        return $this->getAcceptHeaderWithAdjustedWeight($accept, $headersWithJson);
    }

    /**
    * Create an Accept header string from the given "Accept" headers array, recalculating all weights
    *
    * @param string[] $accept            Array of Accept Headers
    * @param string[] $headersWithJson   Array of Accept Headers of type "json"
    *
    * @return string "Accept" Header (e.g. "application/json, text/html; q=0.9")
    */
    private function getAcceptHeaderWithAdjustedWeight(array $accept, array $headersWithJson): string
    {
        $processedHeaders = [
            'withApplicationJson' => [],
            'withJson' => [],
            'withoutJson' => [],
        ];

        foreach ($accept as $header) {

            $headerData = $this->getHeaderAndWeight($header);

            if (stripos($headerData['header'], 'application/json') === 0) {
                $processedHeaders['withApplicationJson'][] = $headerData;
            } elseif (in_array($header, $headersWithJson, true)) {
                $processedHeaders['withJson'][] = $headerData;
            } else {
                $processedHeaders['withoutJson'][] = $headerData;
            }
        }

        $acceptHeaders = [];
        $currentWeight = 1000;

        $hasMoreThan28Headers = count($accept) > 28;

        foreach($processedHeaders as $headers) {
            if (count($headers) > 0) {
                $acceptHeaders[] = $this->adjustWeight($headers, $currentWeight, $hasMoreThan28Headers);
            }
        }

        $acceptHeaders = array_merge(...$acceptHeaders);

        return implode(',', $acceptHeaders);
    }

    /**
     * Given an Accept header, returns an associative array splitting the header and its weight
     *
     * @param string $header "Accept" Header
     *
     * @return array with the header and its weight
     */
    private function getHeaderAndWeight(string $header): array
    {
        # matches headers with weight, splitting the header and the weight in $outputArray
        if (preg_match('/(.*);\s*q=(1(?:\.0+)?|0\.\d+)$/', $header, $outputArray) === 1) {
            $headerData = [
                'header' => $outputArray[1],
                'weight' => (int)($outputArray[2] * 1000),
            ];
        } else {
            $headerData = [
                'header' => trim($header),
                'weight' => 1000,
            ];
        }

        return $headerData;
    }

    /**
     * @param array[] $headers
     * @param float   $currentWeight
     * @param bool    $hasMoreThan28Headers
     * @return string[] array of adjusted "Accept" headers
     */
    private function adjustWeight(array $headers, float &$currentWeight, bool $hasMoreThan28Headers): array
    {
        usort($headers, function (array $a, array $b) {
            return $b['weight'] - $a['weight'];
        });

        $acceptHeaders = [];
        foreach ($headers as $index => $header) {
            if($index > 0 && $headers[$index - 1]['weight'] > $header['weight'])
            {
                $currentWeight = $this->getNextWeight($currentWeight, $hasMoreThan28Headers);
            }

            $weight = $currentWeight;

            $acceptHeaders[] = $this->buildAcceptHeader($header['header'], $weight);
        }

        $currentWeight = $this->getNextWeight($currentWeight, $hasMoreThan28Headers);

        return $acceptHeaders;
    }

    /**
     * @param string $header
     * @param int    $weight
     * @return string
     */
    private function buildAcceptHeader(string $header, int $weight): string
    {
        if($weight === 1000) {
            return $header;
        }

        return trim($header, '; ') . ';q=' . rtrim(sprintf('%0.3f', $weight / 1000), '0');
    }

    /**
     * Calculate the next weight, based on the current one.
     *
     * If there are less than 28 "Accept" headers, the weights will be decreased by 1 on its highest significant digit, using the
     * following formula:
     *
     *    next weight = current weight - 10 ^ (floor(log(current weight - 1)))
     *
     *    ( current weight minus ( 10 raised to the power of ( floor of (log to the base 10 of ( current weight minus 1 ) ) ) ) )
     *
     * Starting from 1000, this generates the following series:
     *
     * 1000, 900, 800, 700, 600, 500, 400, 300, 200, 100, 90, 80, 70, 60, 50, 40, 30, 20, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1
     *
     * The resulting quality codes are closer to the average "normal" usage of them (like "q=0.9", "q=0.8" and so on), but it only works
     * if there is a maximum of 28 "Accept" headers. If we have more than that (which is extremely unlikely), then we fall back to a 1-by-1
     * decrement rule, which will result in quality codes like "q=0.999", "q=0.998" etc.
     *
     * @param int  $currentWeight varying from 1 to 1000 (will be divided by 1000 to build the quality value)
     * @param bool $hasMoreThan28Headers
     * @return int
     */
    public function getNextWeight(int $currentWeight, bool $hasMoreThan28Headers): int
    {
        if ($currentWeight <= 1) {
            return 1;
        }

        if ($hasMoreThan28Headers) {
            return $currentWeight - 1;
        }

        return $currentWeight - 10 ** floor( log10($currentWeight - 1) );
    }
}
