<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'City',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'City field cannot be blank.',
                    ]),
                    new Assert\Type([
                        'type' => 'string',
                        'message' => 'The city field must be a string.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',
                        'message' => 'The city name cannot contain numbers.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Enter city name',
                ],
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Search',
            ]);
    }
}
