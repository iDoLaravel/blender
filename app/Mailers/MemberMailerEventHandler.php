<?php

namespace App\Mailers;

use App\Events\UserWasActivated;
use App\Models\Enums\UserRole;
use App\Services\EventHandler;

class MemberMailerEventHandler extends EventHandler
{
    /**
     * @param MemberMailer $mailer
     */
    public function __construct(MemberMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function whenUserWasActivated(UserWasActivated $event)
    {
        if ($event->user->hasRole(UserRole::MEMBER)) {
            $this->mailer->sendApprovedMail($event->user);
        }
    }
}