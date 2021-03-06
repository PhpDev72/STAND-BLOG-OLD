<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image(JPG,JPEG or PNG file)',
                'required' => false,
                'delete_label' => 'Supprimer l\'image',
                'allow_delete' => true,
                'download_uri' => false,
                'image_uri' => false,
                //'imagine_pattern' => 'squared_thumbnail_medium'
            ])
            ->add('title')
            ->add('description')
            ->add('category');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
