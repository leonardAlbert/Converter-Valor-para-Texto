<?php

namespace MoneyConvert\i18n;

/**
 * Coin EN
 *
 * @author Diego Brocanelli <contato@diegobrocanelli.com.br>
 */
class EN 
{
    /**
     * For filtering
     * @var array
     */
    public $specialCharacter = array('$', ',', '(', ')', '#', ' ');
    
    /**
     * Divisor money string
     * 
     * @var string
     */
    public $divisor = 'and';
    
    /**
     * Plural and singular, dollar.
     * 
     * @var array
     */
    public $realType = array(
        'dollar',
        'dollars'
    );
    
    /**
     * Plural and singular, cents.
     * 
     * @var array
     */
    public $centsType = array(
        'cent',
        'cents'
    );

    /**
     * Coin country
     * @var string
     */
    public $lang = "en";
}
