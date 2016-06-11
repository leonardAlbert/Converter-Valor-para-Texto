<?php

namespace MoneyConvert\i18n;

/**
 * Coin BRL
 *
 * @author Diego Brocanelli <contato@diegobrocanelli.com.br>
 */
class BRL 
{
    /**
     * For filtering
     * @var array
     */
    public $specialCharacter = array('R$','r$', '$', ',', '(', ')', '#', ' ');

    /**
     * Divisor money string
     * 
     * @var string
     */
    public $divisor = 'e';
    
    /**
     * Plural and singular, dollar.
     * 
     * @var array
     */
    public $realType = array(
        'real',
        'reais'
    );

    /**
     * Plural and singular, cents.
     * 
     * @var array
     */
    public $centsType = array(
        'centavo',
        'centavos'
    );

    /**
     * Coin country
     * @var string
     */
    public $lang = "pt-BR";
}
