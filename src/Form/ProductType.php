<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('external_id')
            ->add('sku')
            ->add('name')
            ->add('price')
            ->add('link')
            ->add('image')
            ->add('rating')
            ->add('count')
            ->add('caffeine_type')
            ->add('flavored')
            ->add('seasonal')
            ->add('in_stock')
            ->add('facebook')
            ->add('is_k_cup')
            ->add('short_description')
            ->add('description')
            ->add('brand_id')
            ->add('category_id')
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
