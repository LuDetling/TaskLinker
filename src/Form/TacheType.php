<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Statut;
use App\Entity\Tache;
use App\Repository\EmployeRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $employes = $options["employes"];
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la tâche',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function (Employe $employe) {
                    return $employe->getFullName();
                },
                'choices' => $employes,
                'label' => 'Membre',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => function (Statut $statut) {
                    return $statut->getLibelle();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
        $resolver->setRequired([
            'employes'
        ]);
    }
}
