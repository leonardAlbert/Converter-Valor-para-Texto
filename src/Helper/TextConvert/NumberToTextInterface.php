<?php

namespace Helper\TextConvert;

interface NumberToTextInterface
{
	/**
	 * Array de nomes com números por extenso.
	 *
   	 * @type array
	 */
	protected $numbers;

	/**
	 *
	 */
	protected $complementsNumbersPlural;

	/**
	 *
	 */
	protected $complementsNumbersSingular;

	/**
	 * Metodo responsavel de validar se o numero informado é valido para ser convertido.
	 *
   	 * @params String $number
	 */
	public function validNumber($number);

	/**
	 * Metodo responsavel de tratar o numero depois da virgula.
	 *
   	 * @params String $number
	 */
	public function treatAfterComma($number);

	/**
	 * Metodo responsavel de tratar o numero antes da virgula.
	 *
   	 * @params String $number
	 */
	public function treatBeforeComma($number);

	/**
	 *
	 */
	public function treatOneDigit();

	/**
	 *
	 */
	public function treatTwoDigit();

	/**
	 *
	 */
	public function treatThreeDigit();

	/**
	 *
	 */
	public function ();

	/**
	 *
	 */
	public function ();
}
