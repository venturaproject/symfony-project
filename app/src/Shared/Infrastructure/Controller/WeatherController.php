<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;


use Shared\Infrastructure\Form\CityType;
use Shared\Infrastructure\Service\OpenWeatherMapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    private OpenWeatherMapService $weatherService;

    public function __construct(OpenWeatherMapService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    #[Route('/weather', name: 'weather_search')]
    public function search(Request $request): Response
    {
        $form = $this->createForm(CityType::class);
        $form->handleRequest($request);

        $weatherData = null;
        $errorMessage = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->get('city')->getData();
            $weatherData = $this->weatherService->getWeatherDataByCity($city);

            if (isset($weatherData['error'])) {
                $errorMessage = $weatherData['error'];
                $weatherData = null;
            }
        }

        return $this->render('weather/search.html.twig', [
            'form' => $form->createView(),
            'weatherData' => $weatherData,
            'errorMessage' => $errorMessage,
        ]);
    }
}



