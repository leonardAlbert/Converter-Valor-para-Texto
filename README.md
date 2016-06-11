# Conversor Monetário para Extenso.

Converter valor para texto.

## Briefing
Este sistema tem como objetivo converter os numeros passados para texto por extenso.

## Autor
. _Leonard Albert M. Pedro_

## Colaborador
. [_Diego Brocanelli_](https://github.com/Diego-Brocanelli)

## Ferramentas Utilizadas.
 * _PHP_
 * Rafatoração baseado no repośitório: [https://github.com/md-amanalikhani/number-2-text_PHP](https://github.com/md-amanalikhani/number-2-text_PHP)

## Requisitos 

. [INTL Extension](http://php.net/manual/pt_BR/book.intl.php)


## Exemplos:
### BRL
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use MoneyConvert\Convert\MoneyToWords;

$convert  = new MoneyToWords('BRL');

echo $convert->convert('R$01.00').'<br>';
echo $convert->convert('$125.67').'<br>';
echo $convert->convert('8563754.01').'<br>';
echo $convert->convert('01.01').'<br>';
echo $convert->convert('0.01').'<br>';
echo $convert->convert('111.11').'<br>';
echo $convert->convert('25.00').'<br>';
echo $convert->convert('1.25').'<br>';
echo $convert->convert('7596.37').'<br>';
```
## Resultado
```
Um real
Cento e vinte e cinco reais e sessenta e sete centavos
Oito milhões e quinhentos e sessenta e três mil e setecentos e cinquenta e quatro reais e um centavo
Um real e um centavo
Um centavo
Cento e onze reais e onze centavos
Vinte e cinco reais
Um real e vinte e cinco centavos
Sete mil e quinhentos e noventa e seis reais e trinta e sete centavos
```
