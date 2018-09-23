<?php

namespace AppBundle\Form;

use Bnbc\UploadBundle\Form\Type\AjaxfileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $permissions = array(
            'Directeur' => 'ROLE_DIRECTEUR',
            'Secrétaire' => 'ROLE_SECRETAIRE',
            'Comptable' => 'ROLE_COMPTABLE',
            'Technicien' => 'ROLE_TECHNICIEN',
            'Responsable Achat' => 'ROLE_ACHAT',
            'Administrateur' => 'ROLE_SUPER_ADMIN'
        );

        $builder
            ->add('lastname')
            ->add('firstname')
            ->add(
                'role',
                ChoiceType::class,
                array(
                    'label'   => 'Choisir le rôle',
                    'choices' => $permissions,
                )
            )
            ->add('photo',AjaxfileType::class, array(
                    'required'            => false,
                    'compound'            => false,
                    'progressBar'         => false,
                    'progressBarClass'    => 'bnbc-ajax-file-progress',
                    'progressBarPosition' => 'append',
                    'multiple'            => false,
                    'label'               => null,
                )
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
