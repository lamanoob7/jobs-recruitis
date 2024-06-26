<?php

namespace App\Module\Cacher;

use App\Module\Recruitis\Jobs as RecruitisJobs;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\PruneableInterface;
use Symfony\Contracts\Cache\ItemInterface;
use RecruitisApi\Configuration;
use RecruitisApi\Model\Job;

class Jobs
{
    const CACHE_TIME = 3600;
    /** @var PruneableInterface */
    private $cache;

    /** @var Configuration */
    private $conf;

    public function __construct($conf) {
        $this->conf = $conf;
        $this->cache = new FilesystemAdapter(namespace: 'jobs');
    }

    public function getJob($jobId): Job {
        $jobSerilezed = $this->cache->get($jobId, function (ItemInterface $item) use ($jobId): string {
            $item->expiresAfter(self::CACHE_TIME);
        
            $recruitisJobs = new RecruitisJobs($this->conf);
            $job = $recruitisJobs->getJob($jobId);
        
            return serialize($job);
        });

        return unserialize($jobSerilezed);
    }
    
    /** @return Job[] */
    public function getJobs() : array {
        $jobsSerilezed = $this->cache->get('all', function (ItemInterface $item): string {
            $item->expiresAfter(self::CACHE_TIME);
        
            $recruitisJobs = new RecruitisJobs($this->conf);
            $jobs = $recruitisJobs->getAllJobs();

            foreach($jobs As $job){
                $this->setJob($job);
            }

            return serialize($jobs);
        });

        return unserialize($jobsSerilezed);
    }

    protected function setJob(Job $job) : self {
        $this->cache->delete($job->getJobId());
        $this->cache->get($job->getJobId(), function (ItemInterface $item) use ($job) : string {
            $item->expiresAfter(self::CACHE_TIME);
            return serialize($job);
        });

        return $this;
    }
}