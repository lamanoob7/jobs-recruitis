<?php
namespace App\Controller;

use App\Module\Recruitis\Jobs;
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

        $jobs = new Jobs($conf);
        $jobsList = $jobs->getAllJobs();
        return $this->render('homepage/index.html.twig', ['jobs' => $jobsList]);
    }

    #[Route('/job/{id}', name: "job-detail")]
    public function job($id): Response
    {
        $conf = (new Configuration())->setAccessToken($this->getParameter('recruitis.api.token'));

        $jobs = new Jobs($conf);
        $job = $jobs->getJob($id);
        return $this->render('homepage/job.html.twig', ['job' => $job]);
    }
}