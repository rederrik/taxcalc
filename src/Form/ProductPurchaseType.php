<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Product;
use App\Service\ProductsProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ProductPurchaseType extends AbstractType
{
    private ProductsProvider $productsProvider;

    public function __construct(ProductsProvider $productsProvider)
    {
        $this->productsProvider = $productsProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $products = $this->productsProvider->getProducts();
        $builder
            ->add('product', ChoiceType::class, [
                'choices'  => $products,
                'choice_label' => function (?Product $product) {
                    return $product ? $product->getLabel() : '';
                },
                'choice_value' => function (?Product $product) {
                    return $product ? $product->getLabel() : '';
                },
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a product.',
                    ]),
                ],
            ])
            ->add(
                $builder->create('taxNumber', TextType::class, [
                    'attr' => ['placeholder' => 'XX123456789'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter your tax number.',
                        ]),
                        new Regex([
                            'pattern' => '/^[A-Z]{2}\d{9,11}$/',
                            'message' => 'The tax number is not valid. ' .
                                'It should start with 2 letters followed by 9 to 11 digits.',
                        ]),
                    ],
                ])->addModelTransformer(
                    new CallbackTransformer(fn($value) => $value, fn($value) => strtoupper($value ?? ''))
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
