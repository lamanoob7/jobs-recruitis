<?php
namespace App\Controller;

use App\Module\Cacher\Jobs as CacherJobs;
use RecruitisApi\Configuration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $conf = (new Configuration())->setAccessToken($this->getParameter('recruitis.api.token'));
        $cache = new CacherJobs($conf);
        $jobs = $cache->getJobs();
        return $this->render('homepage/index.html.twig', ['jobs' => $jobs]);
    }

    #[Route('/job/{id}', name: "job-detail")]
    public function job($id): Response
    {
        $conf = (new Configuration())->setAccessToken($this->getParameter('recruitis.api.token'));

        $cache = new CacherJobs($conf);
        $job = $cache->getJob($id);
        return $this->render('homepage/job.html.twig', ['job' => $job]);
    }
}