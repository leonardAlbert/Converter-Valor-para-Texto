<?php
/**
 *
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
 * 
 * @category		
 * @package 		library
 * @subpackage		Helper
 * @author  		Leonard Albert 
 * @filesource		
 * @since   		
 * @version 		
 * 
 */
class Helper_ConverterValorPorExtenso 
{
	//--------------------------------------------------------------------------
	
	/**
	 * Representa a posição do array referente ao valores REIAS (antes da virgula) 
	 * 
	 * @var int
	 */
	const REAIS = 0;
	
	//--------------------------------------------------------------------------
	
	/**
	 * Representa a posição do array referente ao valores CENTAVOS (depois da virgula)
	 *
	 * @var int
	 */
	const CENTAVOS = 1;
	
	//--------------------------------------------------------------------------
	
	/**
	 * Posição do array correspondente ao primeiro numero a ser trabalhado.
	 * 
	 * @var int
	 */
	const POSICAO_UM = 0;
	
	//--------------------------------------------------------------------------
	
	/**
	 * Posição do array correspondente ao segundo numero a ser trabalhado.
	 *  
	 * @var int
	 */
	const POSICAO_DOIS = 1;
	
	//--------------------------------------------------------------------------
	
	/**
	 * Posição do array correspondente ao terceiro numero a ser trabalhado.
	 * 
	 * @var int
	 */
	const POSICAO_TRES = 2;
	
	//--------------------------------------------------------------------------
	
	/**
	 * Array de nomes com o centavo por extenso (plural e singular)
	 * 
	 * @var array
	 */
	protected $complementoCentavo = array(
		'centavo',
		'centavos'	
	);
	
	//--------------------------------------------------------------------------
	
	/**
	 * Array de nomes com o real por extenso (plural)
	 * 
	 * @var array
	 */
	protected $complementoRealPlural = array(
		'reais',
		'mil',
		'milhões',
		'bilhões',
		'trilhões',
		'quatrilhões',
		'quintilhões',
		'sextilhões',
		'septilhões',
		'octilhões',
		'nonilhões',
		'decilhões',
		'undecilhões',
		'duodecilhões',
		'tredecilhões',
		'quatordecilhões',
		'quindecilhões',
		'sexdecilhões',
		'setedecilhões',
		'octodecilhões',
		'novedecilhões',
		'vigesilhões'
	);
	
	//--------------------------------------------------------------------------
	
	/**
	 * Array de nomes com o real por extenso (singular)
	 *
	 * @var array
	 */
	protected $complementoRealSingular = array(
		'real',
		'mil',
		'milhão',
		'bilhão',
		'trilhão',
		'quatrilhão',
		'quintilhão',
		'sextilhão',
		'septilhão',
		'octilhão',
		'nonilhão',
		'decilhão',
		'undecilhão',
		'duodecilhão',
		'tredecilhão',
		'quatordecilhão',
		'quindecilhão',
		'sexdecilhão',
		'setedecilhão',
		'octodecilhão',
		'novedecilhão',
		'vigesilhão'
	);
	
	//--------------------------------------------------------------------------
	
	/**
	 * Array de nomes com números por extenso 
	 * (pode ser usado tanto para real como para centavo)
	 * 
	 * @var array
	 */
	protected $numeros = array(
		'UmNove' => array(
			'1' => 'um',
			'2' => 'dois',
			'3' => 'três',
			'4' => 'quatro',
			'5' => 'cinco',
			'6' => 'seis',
			'7' => 'sete',
			'8' => 'oito',
			'9' => 'nove'
		),
		'DezDezenove' => array(
			'dez',
			'onze',
			'doze',
			'treze',
			'quatorze',
			'quinze',
			'dezesseis',
			'dezesete',
			'dezoito',
			'dezenove',
		),

		'VinteNoventa' => array(
			'2' => 'vinte',
			'3' => 'trinta',
			'4' => 'quarenta',
			'5' => 'cinquenta',
			'6' => 'sessenta',
			'7' => 'setenta',
			'8' => 'oitenta',
			'9' => 'noventa'
		),
		'CemNovecentos' => array(
			'cento',
			'cem',
			'duzentos',
			'trezentos',
			'quatrocentos',
			'quinhentos',
			'seiscentos',
			'setecentos',
			'oitocentos',
			'novecentos'
		)
	);
	
	//--------------------------------------------------------------------------
	
	/**
	 * Converte o numero passado para extenso.
	 * 
	 * @main
	 * @param string $numero
	 * @return string
	 */
	public function converter($numero)
	{
		try {
			// Passa para array o numero a ser tratado.
			// Array de duas posições somente, reais[0] e centavos[1].
			$arrayNumeros = $this->tratarNumero($numero);
		
			// Tratar Reais.
			$reais = $arrayNumeros[self::REAIS];
			
			foreach ($reais as $value) {
				// Todos os nós de Reais iram conter 3 digitos.
				$string = $this->tresDigitos($value);

				// Passa para inteiro o numero a ser referênciado na posição do
				// array correspondente a string.
				$value = (int) $value;
				$arrayString[self::REAIS][][$value] = $string;
			}
			// FIM - Tratar Reais.
			
			// Tratar Centavos.
			$centavos[$arrayNumeros[self::CENTAVOS]] = $this->doisDigitos($arrayNumeros[self::CENTAVOS]);
			$arrayString[self::CENTAVOS] = $centavos;
			// FIM - Tratar Centavos.
			
			// Adiciona os complementos da string.
			$resultado = $this->complementoString($arrayString);
		
			return $resultado;
			
		} catch (Exception $e) {
			return "Problemas para conversão do número. {$e->getMessage()}";
		}
	}

	//--------------------------------------------------------------------------
	
	/**
	 * Trata do numero informado, retirando caractes que não serão utilizados e monta
	 * o array para ser convertido os valores por extenso.
	 * 
	 * @param string $numero
	 * @return array
	 */
	private function tratarNumero($numero)
	{
		// Remove o "R$" da string.
		$numero = str_ireplace('r$', '', $numero);
		// Retira os espaços da string.
		$numero = trim($numero);
		// Remove os pontos da string.
		$numero = str_ireplace('.', '', $numero);
		// Remove os espaços em branco da string.
		$numero = str_ireplace(' ', '', $numero);

		$real	 = $this->real($numero);
		$centavo = $this->centavos($numero);
		
		// Converte para array onde, $arrayNumeros[0] = Reais e $arrayNumeros[1] = Centavos.
		$arrayNumeros[self::REAIS] = $real; // Reais.
		$arrayNumeros[self::CENTAVOS] = $centavo; // Centavos.

		return $arrayNumeros;
	}
	
	//--------------------------------------------------------------------------
		
	/**
	 * Devolve o numero formatado referênte aos reais, antes da virgula.
	 * 
	 * @param string $numero
	 * @return array
	 */
	private function real($numero) 
	{
		$virtula = strrpos($numero, ',');
		// Verifica se o numero possui virtula.
		if ($virtula) {
			$real = substr($numero, 0, $virtula);
		} else {
			$real = $numero;
		}
		// Corta a string.
		$real = substr($real, 0, 63);
		// Preenche os campos vazios.
		$real = str_pad($real, 66 , "0", STR_PAD_LEFT);
		
		// Quebra em array o numero Real em tres(3) posições.
		$arrayReais = str_split($real, 3);
		
		return $arrayReais;
	}
	
	//--------------------------------------------------------------------------
	
	/**
	 * Devolve o numero formatado referênte aos centavos, depois da virgula.
	 * 
	 * @param string $numero
	 * @return int
	 */
	private function centavos($numero) 
	{
		$virgula = strrpos($numero, ',');
		// Verifica se o numero possui virtula.
		if ($virgula) {
			$centavo = substr($numero, $virgula + 1);
		} else {
			$centavo = '00';
		}
		// Corta a string.
		$centavo = substr($centavo, 0, 2);
		// Preenche os campos vazios.
		$centavo = str_pad($centavo, 2 , "0", STR_PAD_LEFT);
		
		return $centavo;
	}
	
	//--------------------------------------------------------------------------
	
	/**
	 * Adiciona na string dentro do array os complementos correspondentes.
	 * Ex: "reais, mil, milhão, etc...".
	 * 
	 * @param array $arrayString
	 * @return string
	 */
	private function complementoString(array $arrayString)
	{
		// Tratar Reais.
		$reais = $arrayString[self::REAIS];
		// Inverte o array para ser adicionado os complementos "reais, mil, milhão, etc...".
		$reais = array_reverse($reais);
		
		// Novo array que será adicionado as strings com os complementos correspondentes.		
		$reaisString = array();
		// Massaroca ponto com ponto br
		foreach ($reais as $row => &$value) {
			foreach ($value as $numero => $string) {
				// Verificação plural ou singular.
				if (! empty($numero)) {
					if ($numero > 1) {
						$reaisString[] = "{$string} {$this->complementoRealPlural[$row]}";
					} else {
						$reaisString[] = "{$string} {$this->complementoRealSingular[$row]}";
					}
				}
			}
		}
		// Desinverte o array para montar a string final de Reais. 
		$reaisString = array_reverse($reaisString);
		
		foreach ($reaisString as $row => $value) {
			$string .= $value;
			// Separa por virgula as strings de Reais que estão no array.
			if ($row + 1 != count($reaisString)) {
				$string .= ", ";
			}
		}
		// FIM - Tratar Reais.

		// Tratar Centavos.
		$centavos = $arrayString[self::CENTAVOS];
		
		// Irá adicionar a string "centavos" se o numero($row) não estiver zerado.
		foreach ($centavos as $row => $value) {
			if (! empty($value)) {
				// Verifica se a string não está vazia.
				if (! empty($string)) {
					$string .= " e ";
				}
				// Varifica o numero para adicionar o complemento no plural ou singular.
				if ($row > 1) {
					// Adiciona a string "centavos" no plural.
					$string .= "{$value} {$this->complementoCentavo[1]}";
				} else {
					// Adiciona a string "centavo" no singular.
					$string .= "{$value} {$this->complementoCentavo[0]}";
				}
			}
		}
		// FIM - Tratar Centavos.

		// Remove os espaços em brancos duplos.
		$string = str_ireplace('  ', ' ', $string);
		// Remove os espaços em branco.
		$string = trim($string);
		// Adiciona a primera letra maiuscula e o complemento do texto.
		$string = ucfirst($string);
		
		return $string;
	}
	
	//--------------------------------------------------------------------------
	
	/**
	 * Pega o valor por extenso para um número com uma casa decimal. (0-9)
	 * 
	 * @param  string $numero
	 * @return string
	 */
	private function umDigito($numero)
	{
		// Retorna a string correspondente ao numero passado.
		return $this->numeros['UmNove'][$numero];
	}
	
	//--------------------------------------------------------------------------
	
	/**
         * Pega o valor por extenso para um número com duas casa decimal. (10-99)
	 * 
	 * @param string $numero
	 * @return string
	 */
	private function doisDigitos($numero)
	{
		// Quebra em array o numero a ser trabalhado.
		if (! is_array($numero)) {
			$arrayNumero = str_split($numero);
		} else {
			$arrayNumero = $numero;
		}
		
		// Não retorna nada se o valor estiver zerado.
		if ($arrayNumero[self::POSICAO_UM] == 0 && 
			$arrayNumero[self::POSICAO_DOIS] == 0) {
			return '';
		}
		// Validação do primeira posição zereada.
		if ($arrayNumero[self::POSICAO_UM] == 0) {
			return $this->umDigito($arrayNumero[self::POSICAO_DOIS]);
		}
		// Validação da primeira posição começando com o numero UM.
		if ($arrayNumero[self::POSICAO_UM] == 1) {
			// Trabalha com array de números de dez a dezenove.
			$string = $this->numeros['DezDezenove'][$arrayNumero[self::POSICAO_DOIS]];
		} else{
			// Trabalha com array de números de vinte a noveta.		
			$string = $this->numeros['VinteNoventa'][$arrayNumero[self::POSICAO_UM]];
			// Verifica se o numero seguinte é diferente de zero.
			if ($arrayNumero[self::POSICAO_DOIS] == 0) {
			 	return $string;
			}
			
			// Monta a string completando o ultimo digito restante.
			$string = "{$string} e {$this->umDigito($arrayNumero[self::POSICAO_DOIS])}";
		}

		return $string;
	}
	
	//--------------------------------------------------------------------------
	
	/**
         * Pega o valor por extenso para um número com três casa decimal. (100-999)
	 * 
	 * @param array/string $numero
	 * @return string
	 */
	private function tresDigitos($numero)
	{
		// Quebra em array o numero a ser trabalhado.
		if (! is_array($numero)) {
			$arrayNumero = str_split($numero);
		} else {
			$arrayNumero = $numero;
		}
		
		// Validação números zerados.
		if ($arrayNumero[self::POSICAO_UM] == 0 &&
			$arrayNumero[self::POSICAO_DOIS] == 0 && 
			$arrayNumero[self::POSICAO_TRES] == 0) {
			return '';
		}
		// Validação se o primeiro numero estiver zerado.
		if ($arrayNumero[self::POSICAO_UM] == 0) {
			// Remove a primeira posição do array.
			unset($arrayNumero[self::POSICAO_UM]);
			// Ordena o array.
			$arrayNumero = array_values($arrayNumero);
			
			return $this->doisDigitos($arrayNumero);	
		}
		// Validação segunda e terceira posições zeradas. 
		if ($arrayNumero[self::POSICAO_DOIS] == 0 && $arrayNumero[self::POSICAO_TRES] == 0) {
			return $this->numeros['CemNovecentos'][$arrayNumero[self::POSICAO_UM]];
		} 
		// Verifica se o numero começa com o numero "um" para adicionar o "cento" no inicio da string.
		if ($arrayNumero[self::POSICAO_UM] == 1) {
			$prefixo = $this->numeros['CemNovecentos'][self::POSICAO_UM];
		} else {
			$prefixo = $this->numeros['CemNovecentos'][$arrayNumero[self::POSICAO_UM]];
		}

		// Remove a primeira posição do array.
		unset($arrayNumero[self::POSICAO_UM]);
		// Ordena o array.
		$arrayNumero = array_values($arrayNumero); 
		
		// Monta a string completando os dois digitos restantes do numero.
		$string = "{$prefixo} e {$this->doisDigitos($arrayNumero)}";
		
		return $string;
	}
	
	//--------------------------------------------------------------------------
	
}
