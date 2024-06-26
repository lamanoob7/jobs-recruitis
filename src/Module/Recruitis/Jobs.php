<?php

namespace App\Module\Recruitis;

use RecruitisApi\Api\JobsApi;
use RecruitisApi\Configuration;
use RecruitisApi\Model\Job;

// use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Jobs {
    /** @var Configuration */
    private $conf;

    public function __construct(Configuration $conf) {
        $this->conf = $conf;
    }

    /** @return Job[] */
    public function getAllJobs() : array {
        $api = new JobsApi(config: $this->conf);
        $jobsPayload = $api->jobsGet();
        return $jobsPayload->getPayload();
    }

    public function getJob(int $id): Job {
        $api = new JobsApi(config: $this->conf);
        $jobPayload = $api->jobsIdGet($id);
        return $jobPayload->getPayload();
    }
}