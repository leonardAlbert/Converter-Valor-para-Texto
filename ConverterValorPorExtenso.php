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
 * Exemplos:
 *     "R$201,1" = "Duzentos e um reais e um centavo"
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
     * Obs: A chave do array corresponde com o numero por extenso.
     * 
     * @var array
     */
    protected $complementoRealPlural = array(
        '0'  => 'reais',
        '1'  => 'mil',
        '2'  => 'milhões',
        '3'  => 'bilhões',
        '4'  => 'trilhões',
        '5'  => 'quatrilhões',
        '6'  => 'quintilhões',
        '7'  => 'sextilhões',
        '8'  => 'septilhões',
        '9'  => 'octilhões',
        '10' => 'nonilhões',
        '11' => 'decilhões',
        '12' => 'undecilhões',
        '13' => 'duodecilhões',
        '14' => 'tredecilhões',
        '15' => 'quatordecilhões',
        '16' => 'quindecilhões',
        '17' => 'sexdecilhões',
        '18' => 'setedecilhões',
        '19' => 'octodecilhões',
        '20' => 'novedecilhões',
        '21' => 'vigesilhões'
    );
    
    //--------------------------------------------------------------------------
    
    /**
     * Array de nomes com o real por extenso (singular)
     * Obs: A chave do array corresponde com o numero por extenso.
     * 
     * @var array
     */
    protected $complementoRealSingular = array(
        '0'  => 'real',
        '1'  => 'mil',
        '2'  => 'milhão',
        '3'  => 'bilhão',
        '4'  => 'trilhão',
        '5'  => 'quatrilhão',
        '6'  => 'quintilhão',
        '7'  => 'sextilhão',
        '8'  => 'septilhão',
        '9'  => 'octilhão',
        '10' => 'nonilhão',
        '11' => 'decilhão',
        '12' => 'undecilhão',
        '13' => 'duodecilhão',
        '14' => 'tredecilhão',
        '15' => 'quatordecilhão',
        '16' => 'quindecilhão',
        '17' => 'sexdecilhão',
        '18' => 'setedecilhão',
        '19' => 'octodecilhão',
        '20' => 'novedecilhão',
        '21' => 'vigesilhão'
    );
    
    //--------------------------------------------------------------------------
    
    /**
     * Array de nomes com números por extenso (pode ser usado tanto para 
     * real como para centavo)
     * Obs: A chave do array corresponde com o numero por extenso.
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
            '0' => 'dez',
            '1' => 'onze',
            '2' => 'doze',
            '3' => 'treze',
            '4' => 'quatorze',
            '5' => 'quinze',
            '6' => 'dezesseis',
            '7' => 'dezesete',
            '8' => 'dezoito',
            '9' => 'dezenove',
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
            '0' => 'cento',
            '1' => 'cem',
            '2' => 'duzentos',
            '3' => 'trezentos',
            '4' => 'quatrocentos',
            '5' => 'quinhentos',
            '6' => 'seiscentos',
            '7' => 'setecentos',
            '8' => 'oitocentos',
            '9' => 'novecentos'
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
            
            // Tratar Centavos.
            $centavos[$arrayNumeros[self::CENTAVOS]] = $this->doisDigitos($arrayNumeros[self::CENTAVOS]);
            $arrayString[self::CENTAVOS] = $centavos;
            
            // Adiciona os complementos da string.
            $resultado = $this->complementoString($arrayString);
        
            return $resultado;
        } catch (Exception $e) {
            return "Atenção: {$e->getMessage()}";
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
        // Caracteres a serem removidos do numero informado.
        $remover = array('r$', '$', '.', '(', ')', '#', ' ');
        foreach ($remover as $string) {
            $numero = str_ireplace($string, '', $numero);
        }
        // Verifica se o numero informado possui mais de uma virgula.
        if (substr_count($numero, ',') > 1) {
            throw new Exception("O número possui mais de uma virgula.");
        }
        
        $real    = $this->real($numero);
        $centavo = $this->centavos($numero);
        // Converte para array onde, $arrayNumeros[0] = Reais e $arrayNumeros[1] = Centavos.
        $arrayNumeros[self::REAIS]    = $real;    // Reais.
        $arrayNumeros[self::CENTAVOS] = $centavo; // Centavos.
        
        return $arrayNumeros;
    }
    
    //--------------------------------------------------------------------------
        
    /**
     * Devolve o numero formatado referênte aos reais, antes da virgula.
     * 
     * @param string $numero
     * @return int
     */
    private function real($numero) {
        $real = $numero;
        
        $virtula = strrpos($numero, ',');
        // Verifica se o numero possui virtula.
        if ($virtula) {
            $real = substr($numero, 0, $virtula);
        }
        // Corta a string.
        $real = substr($real, 0, 66);
        // Preenche os campos vazios.
        $real = str_pad($real, 66 , "0", STR_PAD_LEFT);
        // Passa o real para array com nós de três(3) por pedaços.
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
    private function centavos($numero) {
        $centavo = '00';
        
        $virgula = strrpos($numero, ',');
        // Verifica se o numero possui virtula.
        if ($virgula) {
            $centavo = substr($numero, $virgula + 1);
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
        // String a ser montada.
        $stringFinal = "";
        
        // Tratar Reais.
        $reais = $arrayString[self::REAIS];
        // Inverte o array para seguir a ordem dos complementos que estão no 
        // array "complementoRealPlural" a ser adicionado na stringFinal. 
        // Ex: "reais, mil, milhão, etc...".
        $reais = array_reverse($reais);
        // Novo array que será adicionado as strings com os complementos correspondentes.
        $reaisString = array();
        
        foreach ($reais as $row => $value) {
            foreach ($value as $numero => $string) {
                if (! empty($numero)) {
                    // Verificação plural ou singular.
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
            $stringFinal .= $value;
            // Separa por virgula as strings de Reais que estão no array.
            if ($row + 1 != count($reaisString)) {
                $stringFinal .= ", ";
            }
        }

        // Tratar Centavos.
        $centavos = $arrayString[self::CENTAVOS];
        
        // Irá adicionar a string "centavos" se o numero($row) não estiver zerado.
        foreach ($centavos as $numero => $string) {
            if (! empty($string)) {
                // Verifica se a stringFinal não está vazia.
                if (! empty($stringFinal)) {
                    $stringFinal .= " e ";
                }
                // Varifica o numero para adicionar o complemento no plural ou singular.
                if ($numero > 1) {
                    $stringFinal .= "{$string} {$this->complementoCentavo[1]}";
                } else {
                    $stringFinal .= "{$string} {$this->complementoCentavo[0]}";
                }
            }
        }

        // Remove os espaços em brancos duplos.
        $stringFinal = str_ireplace('  ', ' ', $stringFinal);
        // Remove os espaços em branco Inicio e Fim da String.
        $stringFinal = trim($stringFinal);
        // Adiciona a primera letra maiuscula e o complemento do texto.
        $stringFinal = ucfirst($stringFinal);
        
        return $stringFinal;
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Pega o valor por extenso para um número com uma casa decimal. (0-9)
     * Retorna a string correspondente ao numero passado.
     * 
     * @param  string $numero
     * @return string
     */
    private function umDigito($numero)
    {
        return $this->numeros['UmNove'][$numero];
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Pega o valor por extenso para um número com duas casa decimal. (01-99)
     * Retorna a string correspondente ao numero passado.
     * 
     * @param string $numero
     * @return string
     */
    private function doisDigitos($numero)
    {
        $arrayNumero = $numero;
        
        // Quebra em array o numero a ser trabalhado.
        if (! is_array($arrayNumero)) {
            $arrayNumero = str_split($arrayNumero);
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
            return $this->numeros['DezDezenove'][$arrayNumero[self::POSICAO_DOIS]];
        }
        // Trabalha com array de números de vinte a noveta.        
        $prefixo = $this->numeros['VinteNoventa'][$arrayNumero[self::POSICAO_UM]];
        // Verifica se o numero seguinte é diferente de zero.
        if ($arrayNumero[self::POSICAO_DOIS] == 0) {
             return $prefixo;
        }
        // Monta a string completando o ultimo digito restante.
        $string = "{$prefixo} e {$this->umDigito($arrayNumero[self::POSICAO_DOIS])}";

        return $string;
    }
    
    //--------------------------------------------------------------------------
    
    /**
     * Pega o valor por extenso para um número com três casa decimal. (001-999)
     * Retorna a string correspondente ao numero passado.
     * 
     * @param array/string $numero
     * @return string
     */
    private function tresDigitos($numero)
    {
        $arrayNumero = $numero;
        
        // Quebra em array o numero a ser trabalhado.
        if (! is_array($arrayNumero)) {
            $arrayNumero = str_split($arrayNumero);
        }
        // Validação: Todos números zerados.
        if ($arrayNumero[self::POSICAO_UM] == 0 &&
            $arrayNumero[self::POSICAO_DOIS] == 0 && 
            $arrayNumero[self::POSICAO_TRES] == 0) {
            return '';
        }
        // Validação se o primeiro numero estiver zerado.
        if ($arrayNumero[self::POSICAO_UM] == 0) {
            // Remove a primeira posição do array.
            unset($arrayNumero[self::POSICAO_UM]);
            // Ordena as chaves do array.
            $arrayNumero = array_values($arrayNumero);
            
            return $this->doisDigitos($arrayNumero);    
        }
        // Validação segunda e terceira posições zeradas. 
        if ($arrayNumero[self::POSICAO_DOIS] == 0 && $arrayNumero[self::POSICAO_TRES] == 0) {
            return $this->numeros['CemNovecentos'][$arrayNumero[self::POSICAO_UM]];
        } 
        
        $prefixo = $this->numeros['CemNovecentos'][$arrayNumero[self::POSICAO_UM]];
        // Verifica se o numero começa com o numero "um" para adicionar o "cento" no inicio da string.
        if ($arrayNumero[self::POSICAO_UM] == 1) {
            $prefixo = $this->numeros['CemNovecentos'][self::POSICAO_UM];
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