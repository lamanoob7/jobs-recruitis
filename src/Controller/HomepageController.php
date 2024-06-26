<?php
namespace App\Controller;

use App\Module\Cacher\Jobs as CacherJobs;
use Psr\Log\LoggerInterface;
use RecruitisApi\ApiException;
use RecruitisApi\Configuration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(LoggerInterface $logger): Response
    {
        $conf = (new Configuration())->setAccessToken($this->getParameter('recruitis.api.token'));
        $cache = new CacherJobs($conf);
        try {
            $jobs = $cache->getJobs();
        } catch (ApiException $exception){
            return $this->showError($exception, $logger);
        }
        return $this->render('homepage/index.html.twig', ['jobs' => $jobs]);
    }

    #[Route('/job/{id}', name: "job-detail")]
    public function job(LoggerInterface $logger, $id): Response
    {
        $conf = (new Configuration())->setAccessToken($this->getParameter('recruitis.api.token'));

        $cache = new CacherJobs($conf);
        try {
            $job = $cache->getJob($id);
        } catch (ApiException $exception){
            return $this->showError($exception, $logger);
        }
        return $this->render('homepage/job.html.twig', ['job' => $job]);
    }

    private function showError(ApiException $exception, LoggerInterface $logger): Response {
        $logger->error($exception);
        return $this->render('error.html.twig', ['exception' => $exception]);
    }
}