<?php

namespace App\Controller;

use App\Services\IpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/ip")
 */
class IpController extends AbstractController
{
    /**
     * @Route("/{ip}", name="ip.get", requirements={"ip"="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}"})
     */
    public function getInfo(IpService $ipService, $ip)
    {
        $ipInfo = $ipService->getInfo($ip, true);
        return new JsonResponse($ipInfo);
    }
}
