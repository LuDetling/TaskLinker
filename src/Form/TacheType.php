<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Etiquette;
use App\Entity\Tache;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('deadline', null, [
                'widget' => 'single_text',
            ])
            ->add('employe_id', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'id',
            ])
            ->add('etiquettes', EntityType::class, [
                'class' => Etiquette::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
