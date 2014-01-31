<?php
namespace SalaryApp;

class DateProcessor 
{
    /** 
     * @param string $timezone
     */
    public function __construct ($timezone = "UTC")
    {
        date_default_timezone_set ($timezone);
    }
    
    /** 
     * @param string $date
     * @return boolean
     */
    public function isDateAWeekday ($date)
    {
        $isWeekday = false;
        $dateTime = new \DateTime($date);
        $dayNumber = $dateTime->format("N");
        if ($dayNumber != 6 && $dayNumber != 7) {
            $isWeekday = true;
        } 
        return $isWeekday;
    }
    
    /** 
     * @param string $date
     * @return string
     */
    public function getNextWeekday ($date)
    {
        $dateTime = new \DateTime($date);
        $isWeekday = false;
        while (!$isWeekday) {
            $dateTime->modify("+1 day");
            $isWeekday = $this->isDateAWeekday($dateTime->format("Y-m-d"));
        }
        $newDate = $dateTime->format("Y-m-d");        
        return $newDate;
    }
    
    /**
     * Month must be textual, e.g. Jan or January, not 01 or 1.
     * @param string $month
     * @param string $year
     * @return string
     */
    public function getLastDateOfMonth ($month, $year)
    {
        $dateTime = new \DateTime($month." ".$year);
        $lastDate = $dateTime->format("Y-m-t");
        return $lastDate;
    }
}