# Conversor Monetário para Extenso.

Converter valor para texto.

## Briefing
Este sistema tem como objetivo converter os numeros passados para texto por extenso.

## Autor
_Leonard Albert M. Pedro_

## Ferramentas Utilizadas.
 * _PHP_
 * Rafatoração baseado no repośitório: [https://github.com/md-amanalikhani/number-2-text_PHP](https://github.com/md-amanalikhani/number-2-text_PHP)


## Exemplos:
### BRL
```php
<?php
require_once __DIR__.'/vendor/autoload.php';

use MoneyConvert\Convert\MoneyToWords;

$convert  = new MoneyToWords('BRL');

echo $convert->convert(0).'<br>';
echo $convert->convert(01).'<br>';
echo $convert->convert(2).'<br>';
echo $convert->convert(10).'<br>';
echo $convert->convert(18).'<br>';
echo $convert->convert(100).'<br>';
echo $convert->convert(158).'<br>';
echo $convert->convert(1000).'<br>';
echo $convert->convert(1879568).'<br>';
echo $convert->convert(2879568.01).'<br>';
echo $convert->convert(70007879568.00).'<br>';
echo $convert->convert(25.59).'<br>';
echo $convert->convert(25.23).'<br>';
```
## Resultado
```
Value informed is zero, please report value bigger than zero
um real  
dois reais  
dez reais  
dezoito reais  
cem reais  
cento e cinquenta e oito reais  
um mil reais  
um milhão e setecentos e setenta e nove mil e quatrocentos e sessenta e oito reais  
dois milhões e setecentos e setenta e nove mil e quatrocentos e sessenta e oito reais e um centavo
setenta bilhões e sete milhões e setecentos e setenta e nove mil e quatrocentos e sessenta e oito reais  
vinte e cinco reais e cinquenta e nove centavos
vinte e cinco reais e vinte e três centavos
```
 * "R$201,1"  = "Duzentos e um reais e um centavo"
 * "001,56"   = "Um real e cinquenta e seis centavos"
 * "r$1.23"   = "Cento e vinte e três reais"
 * "$16,7,26" = "Atenção: O número possui mais de uma virgula."
 * "1" = "Um real."
 * "r$ 13.3" = "Cento e trinta e três reais."

Obs: Os números podem conter no máximo "66" caracteres.
