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
        'progressBar'         => false,
        'progressBarClass'    => 'bnbc-ajax-file-progress',
        'progressBarPosition' => 'append',
        'multiple'            => false,
        'label'               => null,
        'autoUpload'          => true,
        'dropZone'            => true,
        'dropZoneText'        => 'Drop file(s) here',
        'callbackFunction'    => null,
        'formData'            => array(
            'uniqid'            => false,
            'max_file_size'     => 5 * 1024 * 1024,
            'accept_file_types' => null,
        //    'upload_folder'     => 'test',
            'image_versions'    => array(
                'thumbnail' => array(
                    'max_width'  => 100,
                    'max_height' => 100,
                    'crop'       => true
                )
            )
        )
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
