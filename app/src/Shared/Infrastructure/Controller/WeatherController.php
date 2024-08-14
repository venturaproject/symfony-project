<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;

use App\Shared\Infrastructure\Form\CityType;
use App\Shared\Infrastructure\Service\OpenWeatherMapService;
use App\Shared\Infrastructure\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    private OpenWeatherMapService $weatherService;
    private MailService $mailService;

    public function __construct(OpenWeatherMapService $weatherService, MailService $mailService)
    {
        $this->weatherService = $weatherService;
        $this->mailService = $mailService;
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
            $email = $form->get('email')->getData(); 
            $weatherData = $this->weatherService->getWeatherDataByCity($city);

            if (isset($weatherData['error'])) {
                $errorMessage = $weatherData['error'];
                $weatherData = null;
            } else {
               
                $this->mailService->send(
                    $email, 
                    'Weather Information',
                    'weather_email',
                    ['weatherData' => $weatherData]
                );
            }
        }

        return $this->render('weather/search.html.twig', [
            'form' => $form->createView(),
            'weatherData' => $weatherData,
            'errorMessage' => $errorMessage,
        ]);
    }
}
