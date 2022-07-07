<?php

namespace StdGroup\App\Entity;

class TicketInfo
{
    public int $bookingDate;
    public int $gender;
    public int $age;

    public function __construct(\DateTime $bookingDate, int $gender, int $age)
    {
        $this->bookingDate = $bookingDate;
        $this->gender = $gender;
        $this->age = $age;
    }
}
