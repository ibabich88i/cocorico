<?php
/**
 * Created by PhpStorm.
 * User: bingo
 * Date: 03.01.19
 * Time: 20:04
 */

namespace Cocorico\CoreBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreatingFormSubscriber implements EventSubscriberInterface
{

    public function onNewFormBuild(ListingFormBuilderEvent $event)
    {
        $formBuilder = $event->getFormBuilder();
        $formBuilder->add('isbn', 'text', [
            'required' => false
        ]);
    }

    public static function getSubscribedEvents()
    {
        return [
            ListingFormEvents::LISTING_NEW_FORM_BUILD => ['onNewFormBuild', 1]
        ];
    }
}