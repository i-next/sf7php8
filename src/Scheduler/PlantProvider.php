<?php

namespace App\Scheduler;

use App\Scheduler\Message\PlantPrefloChangeToFlo;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\Attribute\AsSchedule;

#[AsSchedule(name: 'default')]
class PlantProvider implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(
            RecurringMessage::every('1 hours', new PlantPrefloChangeToFlo())
        );
    }
}
