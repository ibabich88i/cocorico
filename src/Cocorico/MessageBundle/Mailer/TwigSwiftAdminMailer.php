<?php

namespace Cocorico\MessageBundle\Mailer;

use Cocorico\CoreBundle\Mailer\TwigSwiftMailer;

class TwigSwiftAdminMailer
{
    const SUBJECT_NEW_BOOKING = 'New booking';

    /** @var TwigSwiftMailer */
    private $twigSwiftMailer;
    /** @var array */
    private $messages = [
        self::SUBJECT_NEW_BOOKING => 'New booking request is done'
    ];

    /**
     * TwigSwiftAdminMailer constructor.
     * @param TwigSwiftMailer $twigSwiftMailer
     */
    public function __construct(TwigSwiftMailer $twigSwiftMailer)
    {
        $this->twigSwiftMailer = $twigSwiftMailer;
    }

    public function newBookingRequestIsDone()
    {
        $this->twigSwiftMailer->sendMessageToAdmin(
            self::SUBJECT_NEW_BOOKING,
            $this->messages[self::SUBJECT_NEW_BOOKING]
        );
    }
}