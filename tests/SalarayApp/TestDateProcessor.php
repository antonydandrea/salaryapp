<?php
use SalaryApp\DateProcessor;
class TestDateProcessor extends PHPUnit_Framework_TestCase
{
    public function testWeekdayProvider ()
    {
        return array (
            array (
                "2012-09-01",
                false
            ),
            array (
                "2012-07-30",
                true
            ),
            array (
                "2012-07-01",
                false
            ),            
        );
    }
    
    public function getNextWeekdayProvider ()
    {
        return array (
            array (
                "2012-03-31",
                "2012-04-02"
            ),
            array (
                "2012-04-27",
                "2012-04-30",
            ),
            array (
                "2012-04-11",
                "2012-04-12",
            ),
            array (
                "2012-07-01",
                "2012-07-02"
            ),            
        );
    }
    
    public function getLastDateProvider ()
    {
        return array (
            array (
                "March",
                "2012",
                "2012-03-31"
            ),
            array (
                "February",
                "2012",
                "2012-02-29"
            ),
            array (
                "February",
                "2013",
                "2013-02-28"
            ),
            array (
                "April",
                "2012",
                "2012-04-30"
            ),            
            array (
                "Jan",
                "2012",
                "2012-01-31"
            )            
        );
    }
    
    /** 
     * @dataProvider testWeekdayProvider
     * @param string $date
     * @param string $expected
     */
    public function testIsDateAWeekday($date, $expected)
    {
        $dateProcessor = new DateProcessor();
        $isWeekday = $dateProcessor->isDateAWeekday($date);
        $this->assertEquals($expected, $isWeekday);
    }
    
    /** 
     * @dataProvider getNextWeekdayProvider
     * @param string $date
     * @param string $expectedDate
     */
    public function testGetNextWeekday ($date, $expectedDate)
    {
        $dateProcessor = new DateProcessor();
        $nextWeekday = $dateProcessor->getNextWeekday($date);
        $this->assertEquals($nextWeekday, $expectedDate);
    }
    
    /** 
     * @dataProvider getLastDateProvider
     * @param string $month
     * @param string $year
     * @param string $expectedDate
     */
    public function testGetLastDateOfMonth ($month, $year, $expectedDate)
    {
        $dateProcessor = new DateProcessor();
        $date = $dateProcessor->getLastDateOfMonth($month, $year);
        $this->assertEquals($date, $expectedDate);
    }
}