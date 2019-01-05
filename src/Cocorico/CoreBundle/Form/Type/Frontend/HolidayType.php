<?php

namespace Cocorico\CoreBundle\Form\Type\Frontend;

use Cocorico\CoreBundle\Entity\Holiday;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HolidayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'required' => false,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'class' => 'input-group-addon'
                ]
            ])
            ->add('description', 'text', [
                'required' => false,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'class' => 'input-group-addon'
                ]
            ])
            ->add('date', 'text', [
                'required' => false,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'class' => 'input-group-addon'
                ]
            ]);

        $builder->get('date')
            ->addModelTransformer(new CallbackTransformer(
                function (\DateTime $dateAsObj) {

                    return $dateAsObj->format('Y-m-d');
                },
                function ($dateAsString) {

                    return \DateTime::createFromFormat('Y-m-d', $dateAsString);
                }
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Holiday::class,
                'csrf_token_id' => 'listing_new',
            )
        );
    }
}
