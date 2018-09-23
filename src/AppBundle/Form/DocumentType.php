<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bnbc\UploadBundle\Form\Type\AjaxfileType;
class DocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre')
        ->add('commentaire')
        ->add('fichier',AjaxfileType::class, array(
        'required'            => false,
        'compound'            => false,
        'progressBar'         => false,
        'progressBarClass'    => 'bnbc-ajax-file-progress',
        'progressBarPosition' => 'append',
        'multiple'            => false,
        'label'               => null,
            )
        )
        ->add('categorie')
        ->add('destinataire');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Document'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_document';
    }


}
