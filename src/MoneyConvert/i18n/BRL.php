<?php

namespace MoneyConvert\i18n;

/**
 * Coin BRL
 *
 * @author Diego Brocanelli <contato@diegobrocanelli.com.br>
 */
class BRL 
{
    public $specialCharacter = array('r$', '$', '.', '(', ')', '#', ' ');


    public $digitON = array(
        "pt_BR" =>
            array('zero', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove'),
    );
    public $digitTE = array(
        "pt_BR" =>
            array(1 => 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezesete', 'dezoito', 'dezenove'),
    );
    public $digitTW = array(
        "pt_BR" =>
            array(1 => 'dez', 'vinte', 'treinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'opitenta', 'noventa'),
    );
    public $digitTH = array(
        "pt_BR" =>
            array(1 => 'cento','cem', 'duzentos', 'trtezentos', 'quatrocentos', 'quinentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos'),
    );
    public $stepsPoint = array(
        "pt_BR" =>
            array(
                1 => 'décimo',      // 10^1
                     'centesimo',   //10^2
                     'milésimo'     // 10^3
            ),
    );
    public $stepsPlural = array(
        "pt_BR" =>
            array(
                1 => 'mil',          //	10^3
                     'milhões',      //	10^6
                     'bilhões',      //	10^9
                     'trilhões',     //	10^12
                     'quatrilhões',  //	10^15
                     'quintilhões',  //	10^18
                     'sextilhões',   //	10^21
                     'setilhões',    //	10^24
                     'octilhões',    //	10^27
                     'nonilhões',    //	10^30
                     'decilhões'     //	10^33
            )
    );
    public $stepsSingular = array(
        "pt_BR" =>
            array(
                1 => 'mil',        //	10^3
                     'milhão',     //	10^6
                     'bilhão',     //	10^9
                     'trilhão',    //	10^12
                     'quatrilhão', //	10^15
                     'quintilhão', //	10^18
                     'sextilhão',  //	10^21
                     'setilhão',   //	10^24
                     'octilhão',   //	10^27
                     'nonilhão',   //	10^30
                     'decilhão'    //	10^33
            )
    );
    public $etc = array(
        "pt_BR" =>
            array('&' => 'e', '.' => ''),
    );
    
    public $divisor = 'de';
    
    public $realType = array(
        'real',
        'reais'
    );
    public $centsType = array(
        'centavo',
        'centavos'
    );
    public $lang = "pt_BR"; // same name of the keys of the above arrays
    public $decimalPoint;
    public $result;
    public $number;
    public $numberP;

}
