<?php
/**
 * Created by PhpStorm.
 * User: bingo
 * Date: 03.01.19
 * Time: 20:04
 */

namespace Cocorico\CoreBundle\Event;

use Cocorico\CoreBundle\Entity\Listing;
use Cocorico\CoreBundle\Form\Type\Frontend\HolidayType;
use Cocorico\CoreBundle\Repository\HolidayRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormBuilder;

class CreatingFormSubscriber implements EventSubscriberInterface
{
    /** @var EntityManager */
    private $entityManager;
    /** @var HolidayRepository */
    private $holidayRepository;

    /**
     * CreatingFormSubscriber constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->holidayRepository = $this->entityManager->getRepository('CocoricoCoreBundle:Holiday');
    }

    /**
     * @param ListingFormBuilderEvent $event
     */
    public function onNewFormBuild(ListingFormBuilderEvent $event)
    {
        /** @var FormBuilder $formBuilder */
        $formBuilder = $event->getFormBuilder();
        /** @var array $holidays */
        $holidays = $this->holidayRepository->findAll();
        /** @var Listing $listing */
        $listing = $formBuilder->getData();

        foreach ($holidays as $holiday) {
            $listing->addHoliday($holiday);
        }

        $formBuilder
            ->add('isbn', 'text', [
                'required' => false,
                'attr' => [
                    'class' => "form-control"
                ]
            ])
            ->add('holidays', 'collection', [
                'required' => false,
                'entry_type'   => HolidayType::class,
                'entry_options' => array('label' => false),
            ])
        ;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ListingFormEvents::LISTING_NEW_FORM_BUILD => ['onNewFormBuild', 1]
        ];
    }
}