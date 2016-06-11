<?php

namespace MoneyConvert\Core;

use MoneyConvert\Core\BaseConvertInterface;

/**
 * @author Diego Brocanelli <contato@diegobrocanelli.com.br>
 */
class AbstractBaseConvert implements BaseConvertInterface 
{
    /**
     * Error Message
     */
    const DATA_NOT_VALID = 'This number not valid.';

    /**
     * Number for treatment
     * 
     * @var string
     */
    protected $number;

    /**
     * Object Lang Base
     * @var MoneyConvert\i18n
     */
    protected $langConvert;

    /**
     * @param string $lang
     */
    public function __construct($lang) 
    {
        $path = __DIR__.'/../i18n/'.$lang.'.php';

        if(!file_exists($path)){
            throw new \Exception("Class: {$lang} not fount.");
        }
        
        $nameSpace = "MoneyConvert\i18n\\{$lang}";
        $langType  = new $nameSpace;
        
        
        $this->langConvert = $langType;
    }
    
    /**
     * Convert numbers to words.
     * 
     * @param float $number
     * @param int $decimalPoint
     * @return string
     * @throws Exception
     */
    public function convert($number, $decimalPoint = 0)
    {
        $this->number = $number;
        
        if(!$this->validate()){
            $result = self::DATA_NOT_VALID;
        }

        $data = $this->explodeData();

        $result = ucfirst($this->mountToWord($data));

        return $result;
    }

    /**
     * Validate number for formatting
     * 
     * @return boolean
     */
    private function validate()
    {
        $result = true;

        if(empty($this->number)){
            $result = false;
        }

        if($this->number == 0){
            $result = false;
        }

        $number = $this->number;

        foreach ($this->langConvert->specialCharacter as $string) {
            
            $this->number = str_ireplace($string, '', $this->number);
        }

        if (substr_count($this->number, ',') > 1) {
            $result = false;
        }

        return $result;
    }

    /**
     * Explode number "dollar" and "cents"
     * 
     * @return array
     */
    private function explodeData()
    {
        return explode('.', $this->number);
    }
    
    /**
     * [convertToWord description]
     * @param  [type] $number [description]
     * @return [type]         [description]
     */
    private function convertToWord($number)
    {
        $numberFormatted = new \NumberFormatter($this->langConvert->lang, \NumberFormatter::SPELLOUT);
        $result          = $numberFormatted->format($number);

        return $result;
    }

    /**
     * Adding divider between strings
     * 
     * @param  string $number
     * @param  string $type   'real' or 'cents'
     * @return string
     */
    private function divisor($number, $type)
    {
        $indice = 0;

        if($number > 1 ){
            $indice = 1;
        }

        $result = $this->langConvert->realType[$indice];

        if($type == 'cents'){
            $result = $this->langConvert->centsType[$indice];
        }

        return $result;
    }

    /**
     * Words mount
     * 
     * @param  array $data
     * @return string
     */
    private function mountToWord($data)
    {
        $result = '';
        
        if((int)$data[0] > 0 ){
            $real     = $this->convertToWord($data[0]);
            $textReal = $this->divisor($data[0], 'real');

            $result = $real .' '. $textReal;
        }

        if((int)$data[0] > 0 && (int)$data[1] > 0){
            $result .=  ' '. $this->langConvert->divisor . ' ';
        }

        if(array_key_exists(1, $data)){
            if( (int)$data[1] > 0 ){
                $cents     = $this->convertToWord($data[1]);
                $textCents = $this->divisor($data[1], 'cents');

                $result .= $cents .' '.$textCents;
            }
        }

        return $result;
    }
}
