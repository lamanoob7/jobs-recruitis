<?php

namespace App\Module\Recruitis;

use Psr\Http\Client\ClientInterface;
use RecruitisApi\Api\JobsApi;
use RecruitisApi\Configuration;
use RecruitisApi\Model\Job;

class Jobs {
    /** @var Configuration */
    private $conf;
    /** @var \Psr\Http\Client\ClientInterface */
    private $client;

    public function __construct(Configuration $conf, ClientInterface $client = null) {
        $this->conf = $conf;
        $this->client = $client;
    }

    /** @return Job[] */
    public function getAllJobs() : array {
        $api = new JobsApi(...$this->getApiParameters());
        $jobsPayload = $api->jobsGet(50);
        return $jobsPayload->getPayload();
    }

    public function getJob(int $id): Job {
        dump('getJob');
        $api = new JobsApi(...$this->getApiParameters());
        $jobPayload = $api->jobsIdGet($id);
        return $jobPayload->getPayload();
    }

    /** @return mixed[] */
    protected function getApiParameters(): array {
        $parameters = [
            'config' => $this->conf
        ];
        if($this->client){
            $parameters = array_merge($parameters, ['client' => $this->client]);
        }
        return $parameters;
    }
}