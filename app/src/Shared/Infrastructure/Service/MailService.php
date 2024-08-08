<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailService
{
    private MailerInterface $mailer;
    private string $defaultSender;

    public function __construct(MailerInterface $mailer, string $defaultSender)
    {
        $this->mailer = $mailer;
        $this->defaultSender = $defaultSender;
    }

    public function send(string $to, string $subject, string $template, array $context): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->defaultSender, 'Weather App'))
            ->to($to)
            ->subject($subject)
            ->htmlTemplate(sprintf('emails/%s.html.twig', $template))
            ->context($context);

        $this->mailer->send($email);
    }
}
