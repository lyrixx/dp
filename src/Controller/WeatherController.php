<?php

namespace App\Controller;

use App\Weather\Fetcher\ParisFetcher;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    public function __construct(
        private ContainerInterface $weatherFetchers,
        private iterable $weatherFetchers2,
    ) {
    }


    #[Route('/weather/{city}', name: 'weather')]
    public function index(string $city): Response
    {
        foreach($this->weatherFetchers2 as $fetcher) {
            dd($fetcher);
            break;
        }

        if (!$this->weatherFetchers->has($city)) {
            throw $this->createNotFoundException('a pas!');
        }

        $weather = $this->weatherFetchers->get($city)->fetchWeather();

        return $this->render('weather/index.html.twig', [
            'weather' => $weather,
        ]);
    }
}
