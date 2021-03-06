<?php

/*
 * This file is part of the Cocorico package.
 *
 * (c) Cocolabs SAS <contact@cocolabs.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocorico\MessageBundle\Event;


use Cocorico\CoreBundle\Event\BookingEvent;
use Cocorico\CoreBundle\Event\BookingEvents;
use Cocorico\CoreBundle\Mailer\TwigSwiftMailer;
use Cocorico\MessageBundle\Mailer\TwigSwiftAdminMailer;
use Cocorico\MessageBundle\Model\ThreadManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class BookingSubscriber implements EventSubscriberInterface
{
    /** @var ThreadManager */
    protected $threadManager;
    /** @var TwigSwiftAdminMailer */
    private $adminMailer;

    /**
     * @param ThreadManager $threadManager
     */
    public function __construct(ThreadManager $threadManager, TwigSwiftAdminMailer $adminMailer)
    {
        $this->threadManager = $threadManager;
        $this->adminMailer = $adminMailer;
    }


    public function onBookingNewCreated(BookingEvent $event)
    {
        $booking = $event->getBooking();
        $user = $booking->getUser();
        $this->threadManager->createNewListingThread($user, $booking);
        $this->adminMailer->newBookingRequestIsDone();
    }


    public static function getSubscribedEvents()
    {
        return array(
            BookingEvents::BOOKING_NEW_CREATED => array('onBookingNewCreated', 1),
        );
    }

}