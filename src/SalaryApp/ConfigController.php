<?php 
namespace SalaryApp;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * @package SalaryApp
 *
 * Config controller that reads the config file for settings.
 */
class ConfigController
{
    /**
     * Holds raw Yaml data.
     * @var string
     */
    private $data;

    /**
     * Loads the config data on construct.
     * @param string $configPath
     */
    public function __construct($configPath)
    {
        try {
            $this->data = file_get_contents($configPath);
        } catch (Exception $e) {
            throw new \LogicException("Unable to open file:{$configPath}", $e->getMessage());
        }
    }

    /**
     * Returns internal data as an array.
     * @return array
     */
    public function getConfigSettingsAsArray ()
    {
        $returnArray = array();
        $yaml = new Parser();
        if ($this->data != null) {
            try {
                $returnArray = $yaml->parse($this->data);
            } catch (ParseException $e) {
                throw new \LogicException("Unable to parse the YAML string: {$this->data}", $e->getMessage());
            }
        }
        return $returnArray;
    }
}