<?php
namespace SalaryApp;

class Output 
{
    /** 
     * @var string 
     */
    private $filePath;
    
    /** 
     * @param string $filePath
     */
    public function __construct ($filePath) 
    {
        $this->filePath = $filePath;
    }
    
    /** 
     * @param array $array
     */
    public function writeOutputFile ($array)
    {
        $content = $this->formatOutput($array);
        $fileWritten = file_put_contents ($this->filePath, $content);
        if ($fileWritten === false) {
            die ("File failed to write.");
        }
    }
    
    /**
     * @param array $array
     * @return string
     */
    public function formatOutput ($array)
    {
        $head = '"Month Name", "1st expenses day", "2nd expenses day", "Salary day"'.PHP_EOL;
        $body = "";
        foreach ($array as $monthName => $dates) {
            $body .= '"'.$monthName.'","'.$dates[0].'", "'.$dates[1].'", "'.$dates[2].'"'.PHP_EOL;
        }
        return $head.$body;
    }
}