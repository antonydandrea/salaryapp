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
    public function getNextWeekday ($date, $day = "")
    {
        $dateTime = new \DateTime($date);
        $isWeekday = false;
        $datePicked = false;
        while (!$isWeekday || !$datePicked) {
            $dateTime->modify("+1 day");
            $isWeekday = $this->isDateAWeekday($dateTime->format("Y-m-d"));
            if ($isWeekday && $day !== "") {
                if ($day === $dateTime->format("l")) {
                    $datePicked = true;
                } else {
                    $datePicked = false;
                }
            } elseif ($isWeekday){
                $datePicked = true;
            }
        }
        $newDate = $dateTime->format("Y-m-d");        
        return $newDate;
    }
    
    /** 
     * @param string $date
     * @return string
     */
    public function getPreviousWeekday ($date)
    {
        $dateTime = new \DateTime($date);
        $isWeekday = false;
        while (!$isWeekday) {
            $dateTime->modify("-1 day");
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
        if (is_numeric($month)) {
            $month = $this->getMonthName($month);
        }
        $dateTime = new \DateTime($month." ".$year);
        $lastDate = $dateTime->format("Y-m-t");
        return $lastDate;
    }
    
    /** 
     * @param integer $monthNumber
     * @return string
     */
    public function getMonthName ($monthNumber) 
    {
        return date("F", mktime(0, 0, 0, $monthNumber, 1));
    }
    
    /** 
     * @param string $date
     * @param string $next_weekday
     * @return string
     */
    public function processExpenseDay ($date, $next_weekday)
    {
        if (!$this->isDateAWeekday($date)) {
            $expenseDay = $this->getNextWeekday($date, $next_weekday);
        } else {
            list($year, $month, $day) = explode('-', $date);
            $month<10?$month="0$month":$month;
            $day<10?$day="0$day":$day;
            $expenseDay = "$year-$month-$day";
        }
        return $expenseDay;
    }
    
    /** 
     * @param string $year
     * @param string $month
     * @return string
     */
    public function processSalaryDay ($year, $month) 
    {
        $date = $this->getLastDateOfMonth($month, $year);
        if (!$this->isDateAWeekday($date)) {
            $salaryDate = $this->getPreviousWeekday($date);
        } else {
            $salaryDate = $date;
        }
        return $salaryDate;
    }
}