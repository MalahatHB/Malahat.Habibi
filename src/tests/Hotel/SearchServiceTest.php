<?php

namespace App\Tests\Hotel;

use App\Entity\Hotel;
use App\Hotel\SearchService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SearchServiceTest extends KernelTestCase {

    public function testSearch() {
        self::bootKernel();
        $container = static::getContainer();
        /** @var SearchService $searchService */
        $searchService = $container->get(SearchService::class);

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine')->getManager();

        $hotel = new Hotel();
        $hotel->setName("prefix Grand Hotel postfix");
        $hotel->setAddress("Tehran");
        $entityManager->persist($hotel);

        $entityManager->flush();

        $result = $searchService->search("Grand");
        $this->assertNotEmpty($result);
    }
}
