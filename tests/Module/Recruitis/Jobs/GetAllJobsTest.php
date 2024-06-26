<?php

declare(strict_types=1);

namespace Tests\Module\Recruitis\Jobs;

use App\Module\Recruitis\Jobs;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RecruitisApi\Configuration;
use RecruitisApi\Model\Job;

final class GetAllJobsTest extends TestCase
{
    public function testWithValidAuthorization(): void
    {
        $mock = new MockHandler([
            new Response(201, ['Content-Type' => 'application/json'], $this->getRawResponse())
        ]);

        $jobsModule = new Jobs(
            (new Configuration()),
            new Client(['handler' => HandlerStack::create($mock)])
        );

        $jobs = $jobsModule->getAllJobs();
        
        $this->assertCount(2, $jobs);
        
        $this->assertInstanceOf(Job::class, $job1 = $jobs[0]);
        $this->assertIsInt($job1->getJobId());
        $this->assertSame(123456, $job1->getJobId());

        $this->assertInstanceOf(Job::class, $job2 = $jobs[1]);
        $this->assertIsInt($job2->getJobId());
        $this->assertSame(987654, $job2->getJobId());
    }

    private function getRawResponse() : string {
        return '{
            "payload": [
                {
                    "job_id": 123456,
                    "secured_id": "abcdef",
                    "draft": false,
                    "active": true,
                    "access_state": 1,
                    "public_id": null,
                    "title": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris tincidunt sem sed arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Mauris elementum mauris vitae tortor. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Vivamus ac leo pretium faucibus. Aenean id metus id velit ullamcorper pulvinar. Pellentesque arcu. Proin in tellus sit amet nibh dignissim sagittis. In enim a arcu imperdiet malesuada.",
                    "internal_note|string": null,
                    "date_end": null,
                    "date_closed": null,
                    "closed_duration": null,
                    "date_created": "2023-06-30 09:28:00",
                    "date_created_origin": "2023-06-30 09:28:00",
                    "last_update": "2023-06-30 09:44:15",
                    "text_language": "cs",
                    "workfields": [
                        {
                            "id": 2516,
                            "name": "Vedoucí prodejny/provozu"
                        },
                        {
                            "id": 3704,
                            "name": "Marketingový ředitel"
                        }
                    ],
                    "filterlist": [
                        {
                            "id": 1829,
                            "name": "CZweb",
                            "group": "Kariérní web",
                            "group_id": 334
                        },
                        {
                            "id": 1839,
                            "name": "TM_centrala",
                            "group": "Photo Gallery",
                            "group_id": 335
                        },
                        {
                            "id": 1843,
                            "name": "DNA Hunter Plus",
                            "group": "Referral program",
                            "group_id": 336
                        },
                        {
                            "id": 2175,
                            "name": "Administration",
                            "group": "Team",
                            "group_id": 388
                        }
                    ],
                    "education": {
                        "id": -1,
                        "name": "Vzdělání není podstatné"
                    },
                    "disability": null,
                    "details": {
                        "office_id": 123,
                        "facebook_picture_path": null,
                        "opening_reason": null,
                        "suitable_for": [
                            {
                                "id": 1,
                                "name": "Absolventi"
                            },
                            {
                                "id": 2,
                                "name": "Důchodci"
                            },
                            {
                                "id": 3,
                                "name": "Na rodičovské dovolené"
                            },
                            {
                                "id": 4,
                                "name": "Nezaměstnaní"
                            },
                            {
                                "id": 5,
                                "name": "NVS, ZVS"
                            },
                            {
                                "id": 6,
                                "name": "OSVČ (práce na IČO)"
                            },
                            {
                                "id": 7,
                                "name": "Studenti"
                            },
                            {
                                "id": 8,
                                "name": "Zaměstnaní"
                            },
                            {
                                "id": 10,
                                "name": "Není vhodná pro absolventy"
                            },
                            {
                                "id": 11,
                                "name": "Uprchlíci z Ukrajiny"
                            }
                        ],
                        "remote_work": null,
                        "driving_license": null,
                        "video_link": null,
                        "video_link_name": null
                    },
                    "personalist": {
                        "id": 123,
                        "name": "Al Bed",
                        "initials": "AB"
                    },
                    "contact": {
                        "name": "Lu Han",
                        "initials": "LH",
                        "email": "ml@gmail.com",
                        "phone": null,
                        "employee": {
                            "id": 234,
                            "name": "Lu",
                            "surname": "Han",
                            "initials": "LH",
                            "email": "lu.han@test.test",
                            "photo_url": "image",
                            "phone": "+421 123 456 789",
                            "linkedin": "https://www.linkedin.com/luhan/"
                        }
                    },
                    "sharing": [],
                    "addresses": [
                        {
                            "id": 3452167,
                            "office_id": 3432662,
                            "city": "Praha 11",
                            "postcode": "14800",
                            "street": "Prayska",
                            "region": "Hlavní město Praha",
                            "state": "CZ",
                            "is_primary": true
                        }
                    ],
                    "employment": {
                        "id": 1,
                        "name": "Práce na zkrácený úvazek"
                    },
                    "confidential": false,
                    "salary": {
                        "min": 0,
                        "max": 35709,
                        "currency": "CZK",
                        "unit": "month",
                        "visible": false,
                        "note": null,
                        "is_min_visible": false,
                        "is_max_visible": false,
                        "is_range": false
                    },
                    "salary_default_currency": "CZK",
                    "channels": {
                        "portal": {
                            "id": 2,
                            "name": "Inzerní portály",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "company_page": {
                            "id": 3,
                            "name": "Firemní stránky",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "company_page_internal_offers": {
                            "id": 10,
                            "name": "Firemní stránky pro interní pozice v rámci ATS Recruitis",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "intranet": {
                            "id": 4,
                            "name": "Intranet",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "internal": {
                            "id": 1,
                            "name": "Interní pozice",
                            "date_end": false,
                            "date_from": false,
                            "date_assigned": "2023-07-30 00:00:02",
                            "paused": false,
                            "active": true,
                            "visible_for_everyone": true
                        },
                        "czechcrunch": {
                            "id": 8,
                            "name": "Czechcrunch",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "profesia": {
                            "id": 9,
                            "name": "Profesia API",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        }
                    },
                    "edit_link": "https://app.recruitis.io/zadavatel/editor/create/id/431912",
                    "public_link": "https://jobs.recruitis.io/testovaciucetpr/431912-manazer-segmentu-trhu-ve-fiber-tribu-klon-lho-17-m-z-test-test-m-z-test-test",
                    "preview_url": "https://jobs.recruitis.io/testovaciucetpr/431912-manazer-segmentu-trhu-ve-fiber-tribu-klon-lho-17-m-z-test-test-m-z-test-test-6D65xKemuldGqfr6xRMq1UtMcmNURQr3",
                    "referrals": []
                },
                {
                    "job_id": 987654,
                    "secured_id": "jMpjWBqTeISS4GG38F6NHlj14Dhqm6Ex",
                    "draft": false,
                    "active": true,
                    "access_state": 1,
                    "public_id": null,
                    "title": "Manažer segmentu trhu ve Fiber tribu KLON m/z JMR 13 test lomitka",
                    "description": "<p><strong>“Téčko” tedy T-Mobile a Slovak Telekom zahájilo agilní transformaci a vy se na ni můžete podílet s námi! Přidejte se k nám a využijte jedinečnou příležitost přenést vaši představu o nejlepším a nejoceňovanějším poskytovateli internetu v ČR do reality! Pomozte nám ukázat našim zákazníkům, že naše služby a naše technologie jsou ty nejlepší na trhu!&nbsp;</strong></p><p><strong>T-Mobile je českou jedničkou v budování optické infrastruktury. Nyní hledáme segmentového manažera, který nám pomůže uvádět na trh a neustále vylepšovat služby poskytované společností T-Mobile na optických&nbsp;sítích.</strong></p><p><strong>Budete to vy?</strong></p><h2>Čemu se budete věnovat</h2><p>Budete:</p><ul><li>proaktivně navrhovat a uvádět v život komerční aktivity s cílem získávání nových zákazníků pro službu optický internet</li><li>zodpovědný/á za celý proces realizace aktivit. Od nápadu, definici parametrů, připravenost prodejních kanálů až po komunikaci směrem k zákazníkům</li><li>aktivně spolupracovat s dalšími týmy – prodejními kanály, financemi, produktem, hardware/terminal management, právním a další</li><li>znát potřeby a chování potencionálních i stávajících zákazníků, identifikovat nové komerční příležitosti</li><li>pracovat samostatně, organizovat si vlastní práci a řídit realizaci vlastních aktivit</li><li>vlastnit svěřenou agendu a prezentovat ji u vedení společnosti</li><li>dělat rozhodnutí na základě dostupných dat a reportů, sledovat prodejní výsledky a pohotově reagovat na odchylky v plnění</li><li>se orientovat v dění (konkurenti, propozice, technologie) na trhu pevného internetu v ČR</li></ul><h2>Koho hledáme</h2><p>Hledáme <a href=\"www.google.com\" target=\"_blank\">týmového hráče</a> s&nbsp;pozitivním myšlením a proaktivním přístupem.&nbsp;</p><p>Na pohovoru nás bude zajímat, jestli…</p><ul><li>jste komunikativní, máte schopnost argumentovat a přesvědčivě prezentovat</li><li>máte minimálně 2 roky zkušeností s řízením&nbsp;marketingové mixu&nbsp;(např. zkušenosti ze segmentu, produktu, pricingu, procesů nebo s řízením prodejních kanálů)</li><li>máte schopnost pracovat samostatně, organizovat si práci</li><li>máte schopnost komerčního uvažování</li><li>se umíte orientovat a pracovat s&nbsp;čísly</li><li>se dorozumíte anglicky</li><li>máte zkušenost z oboru telekomunikací, IT, finančních služeb (výhodou, nikoli podmínkou)</li></ul><h2>Co vám nabízíme</h2><ul><li><strong>Smartphone:</strong> Vyberte si telefon a získejte na něj kompenzaci každé 3 roky v hodnotě do 23 100 Kč.</li><li>Zaměstnanecký tarif: <strong>Datujte neomezeně</strong>, telefonujte a SMSkujte za zvýhodněnou cenu! Je jedno, zda na soukromé nebo pracovní účely.</li><li>Bonusy a odměny: Šikovnost se cení! A to odměnami za individuální výkon. Navíc, pokud se firmě bude dařit, máte šanci získat i roční <strong>bonus do výše 15 %.</strong></li><li>T-Mobile slevy: Využijte <strong>slevy až -75 %</strong> na 8 T-Mobile služeb pro rodinu a blízké.</li><li>Slevy u partnerů: <strong>Užijte si zlevněné ceny&nbsp;</strong>u našich partnerů.</li><li>Flexibilní pracovní doba: Obvykle pracujeme office vs. home-office 60:40, <strong>přizpůsobte práci svým potřebám.</strong></li><li>Dovolená a oddych: <strong>5 týdnů dovolené</strong>, <strong>osobní volno až do 4 dní</strong> a 1 den na dobročinnou činnost.</li><li>MultiSport: Sportujte nebo se zrelaxujte se svými nejbližšími zdarma či se slevami díky zvýhodněné kartě MultiSport</li><li>Zdravotní péče: Dbejte o své zdraví za zvýhodněnou cenu s <strong>nadstandardní péčí</strong> v našem smluvním zařízení.</li><li>Vzdelávaní a rozvoj: Rozšiřte své obzory s interní <strong>T-Univerzitou</strong>, která nabízí bohatý výběr kurzů pro osobností a kariérní rozvoj.</li><li>Cafeteria: Benefity v hodnotě až <strong>10 000 Kč ročně&nbsp;</strong>– služby z oblasti sportu a kultury, příspěvky na dopravu, dovolenou nebo jazykové kurzy.</li><li><strong>Psychologická poradna:</strong> Čelíte potížím v soukromém nebo pracovním životě? Poraďte se s odborníkem přes telefon nebo online.</li><li><strong>Stravenkový paušál:</strong> Pochutnejte si na skvělém obědě s příspěvkem 63 Kč na každý pracovní den.</li><li>Penzijní spoření: Připravte se na podzim života s <strong>příspěvkem na pojištění</strong> po 12 odpracovaných měsících.</li></ul><h2>Zaujala vás nabídka?</h2><p>Klikněte na tlačítko „Mám zájem o tuto pozici“ a vyplňte prosím formulář.</p><p>Budeme rádi, když připojíte i pár řádků o tom, co vás na pozici zaujalo.</p>",
                    "internal_note|string": null,
                    "date_end": null,
                    "date_closed": null,
                    "closed_duration": null,
                    "date_created": "2023-06-19 13:34:55",
                    "date_created_origin": "2023-06-19 13:34:55",
                    "last_update": "2023-11-06 22:36:32",
                    "text_language": "cs",
                    "workfields": [
                        {
                            "id": 2516,
                            "name": "Vedoucí prodejny/provozu"
                        },
                        {
                            "id": 3704,
                            "name": "Marketingový ředitel"
                        }
                    ],
                    "filterlist": [
                        {
                            "id": 1829,
                            "name": "CZweb",
                            "group": "Kariérní web",
                            "group_id": 334
                        },
                        {
                            "id": 1839,
                            "name": "TM_centrala",
                            "group": "Photo Gallery",
                            "group_id": 335
                        },
                        {
                            "id": 1843,
                            "name": "DNA Hunter Plus",
                            "group": "Referral program",
                            "group_id": 336
                        },
                        {
                            "id": 2175,
                            "name": "Administration",
                            "group": "Team",
                            "group_id": 388
                        },
                        {
                            "id": 2997,
                            "name": "header_picture_test_01",
                            "group": "Header Image",
                            "group_id": 521
                        }
                    ],
                    "education": {
                        "id": -1,
                        "name": "Vzdělání není podstatné"
                    },
                    "disability": null,
                    "details": {
                        "office_id": 3432662,
                        "facebook_picture_path": null,
                        "opening_reason": null,
                        "suitable_for": [
                            {
                                "id": 1,
                                "name": "Absolventi"
                            },
                            {
                                "id": 2,
                                "name": "Důchodci"
                            },
                            {
                                "id": 3,
                                "name": "Na rodičovské dovolené"
                            },
                            {
                                "id": 4,
                                "name": "Nezaměstnaní"
                            },
                            {
                                "id": 5,
                                "name": "NVS, ZVS"
                            },
                            {
                                "id": 6,
                                "name": "OSVČ (práce na IČO)"
                            },
                            {
                                "id": 7,
                                "name": "Studenti"
                            },
                            {
                                "id": 8,
                                "name": "Zaměstnaní"
                            },
                            {
                                "id": 10,
                                "name": "Není vhodná pro absolventy"
                            },
                            {
                                "id": 11,
                                "name": "Uprchlíci z Ukrajiny"
                            }
                        ],
                        "remote_work": null,
                        "driving_license": null,
                        "video_link": null,
                        "video_link_name": null
                    },
                    "personalist": {
                        "id": 27015,
                        "name": "Aleš Bednář",
                        "initials": "AB"
                    },
                    "contact": {
                        "name": "Lukáš Hanko",
                        "initials": "LH",
                        "email": "mlynarcikova.simona@gmail.com",
                        "phone": null,
                        "employee": {
                            "id": 27050,
                            "name": "Lukáš",
                            "surname": "Hanko",
                            "initials": "LH",
                            "email": "lukas.hanko2@t-mobile.cz",
                            "photo_url": "https://app.recruitis.io/image/h/cExNTDJlTEFLSUlYR01haTgyZGlzemdEN3Y2RGU0b3NIbEJIKy9FMERrV0s5MlIwRTYveklGU1UxbTF0aCsreQ==?focus=center&imprint=c81dc2542c94fe77211f1d655ad6f5e0",
                            "phone": "+421 123 456 789",
                            "linkedin": "https://www.linkedin.com/in/lukashlukash/"
                        }
                    },
                    "sharing": [],
                    "addresses": [
                        {
                            "id": 3451353,
                            "office_id": 3432662,
                            "city": "Praha 11",
                            "postcode": "14800",
                            "street": "Tomíčkova 2144/1",
                            "region": "Hlavní město Praha",
                            "state": "CZ",
                            "is_primary": true
                        }
                    ],
                    "employment": {
                        "id": 1,
                        "name": "Práce na zkrácený úvazek"
                    },
                    "confidential": false,
                    "salary": {
                        "min": 0,
                        "max": 35709,
                        "currency": "CZK",
                        "unit": "month",
                        "visible": false,
                        "note": null,
                        "is_min_visible": false,
                        "is_max_visible": false,
                        "is_range": false
                    },
                    "salary_default_currency": "CZK",
                    "channels": {
                        "portal": {
                            "id": 2,
                            "name": "Inzerní portály",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "company_page": {
                            "id": 3,
                            "name": "Firemní stránky",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "company_page_internal_offers": {
                            "id": 10,
                            "name": "Firemní stránky pro interní pozice v rámci ATS Recruitis",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "intranet": {
                            "id": 4,
                            "name": "Intranet",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "internal": {
                            "id": 1,
                            "name": "Interní pozice",
                            "date_end": false,
                            "date_from": false,
                            "date_assigned": "2023-07-19 00:00:02",
                            "paused": false,
                            "active": true,
                            "visible_for_everyone": true
                        },
                        "czechcrunch": {
                            "id": 8,
                            "name": "Czechcrunch",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        },
                        "profesia": {
                            "id": 9,
                            "name": "Profesia API",
                            "date_end": false,
                            "date_from": false,
                            "active": false,
                            "paused": false,
                            "date_assigned": false,
                            "visible_for_everyone": true
                        }
                    },
                    "edit_link": "https://app.recruitis.io/zadavatel/editor/create/id/431085",
                    "public_link": "https://jobs.recruitis.io/testovaciucetpr/431085-manazer-segmentu-trhu-ve-fiber-tribu-klon-m-z-jmr-13-test-lomitka",
                    "preview_url": "https://jobs.recruitis.io/testovaciucetpr/431085-manazer-segmentu-trhu-ve-fiber-tribu-klon-m-z-jmr-13-test-lomitka-jMpjWBqTeISS4GG38F6NHlj14Dhqm6Ex",
                    "referrals": []
                }
            ],
            "meta": {
                "code": "api.found",
                "duration": 120,
                "message": "Jobs are returned.",
                "entries_from": 1,
                "entries_to": 2,
                "entries_total": 62,
                "entries_sum": 2
            }
        }';
    }
}