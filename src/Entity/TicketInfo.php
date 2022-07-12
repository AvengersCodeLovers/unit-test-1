<?php

namespace StdGroup\App\Entity;

use DateTime;

class TicketInfo
{
    public $bookingDate;
    public $gender;
    public $age;

    public function __construct(DateTime $bookingDate, int $gender, int $age)
    {
        $this->bookingDate = $bookingDate;
        $this->gender = $gender;
        $this->age = $age;
    }
}
