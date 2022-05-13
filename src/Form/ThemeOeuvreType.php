<?php

namespace App\Form;

use App\Entity\ThemeOeuvre;
use App\Entity\Oeuvre;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThemeOeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('theme_id', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => function ($theme) {
                    return $theme->getNom();
                },
                'label' => 'theme'

            ])
            ->add('oeuvre_id', EntityType::class, [
                'class' => Oeuvre::class,
                'choice_label' => function ($oeuvre) {
                    return $oeuvre->getNom();
                },
                'label' => 'oeuvre'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ThemeOeuvre::class,
        ]);
    }
}
