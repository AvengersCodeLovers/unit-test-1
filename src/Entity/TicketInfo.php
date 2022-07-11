<?php

namespace StdGroup\App\Entity;

use DateTime;

class TicketInfo
{
    public DateTime $bookingDate;
    public int $gender;
    public int $age;

    public function __construct(DateTime $bookingDate, int $gender, int $age)
    {
        $this->bookingDate = $bookingDate;
        $this->gender = $gender;
        $this->age = $age;
    }
}
