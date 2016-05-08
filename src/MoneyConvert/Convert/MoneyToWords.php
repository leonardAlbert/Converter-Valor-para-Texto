<?php

namespace MoneyConvert\Convert;

use MoneyConvert\Core\AbstractBaseConvert;

/**
 * Realiza a conversão de números em formato de moeda brasileira ex: "R$ 20,98",
 * para texto ex: "Vinte reais e noventa e oito centavos".
 * O numero precisa conter virgula para ser considerado os centavos.
 * Os pontos e catacteres especiais serão retirados para conversão do numero.
 * 
 * Os números Reais (antes da virgula) podem conter até 63 caracteres e os números
 * Centavos (depois da virgula) podem conter até 02 caracteres.
 * 
 * Os números Reais (antes da virgula) são trabalhados e separados em casas de 3 caracteres cada,
 * para assim serem convertidos.
 * 
 * Exemplos:
 *     "R$201,1"  = "Duzentos e um reais e um centavo"
 *     "001,56"   = "Um real e cinquenta e seis centavos"
 *     "r$1.23"   = "Cento e vinte e três reais"
 *     "$16,7,26" = "Atenção: O número possui mais de uma virgula."
 * 
 * @category        
 * @package         library
 * @subpackage      
 * @author          Leonard Albert <leonard_pedro@yahoo.com.br>
 * @filesource        
 * @since           
 * @version         
 * 
 */
class MoneyToWords extends AbstractBaseConvert
{
	/**
	 * @param string $lang
	 * @example BRL (Brazil)
	 */
    public function __construct($lang) 
    {
        parent::__construct($lang);
    }
}
