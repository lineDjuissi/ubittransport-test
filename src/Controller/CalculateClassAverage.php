<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Score;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculateClassAverage
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(): JsonResponse
    {
        $result = [];
        try {
            $result['average'] = $this->em->getRepository(Score::class)
                    ->findClassAverage();
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return new JsonResponse($result);
    }
}