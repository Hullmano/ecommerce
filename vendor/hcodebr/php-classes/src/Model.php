<?php 

namespace Hcode;

class Model {

	private $values = [];

	public function __call($name, $args)              //__call - retorna o médoto que foi chamado. Neste caso: getiduser ou setiduser.
	{

		$method = substr($name, 0, 3);                //obtém a partir da posição 0, os 3 próximos caracteres.
		$fieldname = substr($name, 3, strlen($name)); //strlen - retorna a qtdde de caract. Neste caso o substr obtém a partir da pos. 3 até o último caract.

		switch ($method) {							  //qdo qqer método que é invocado, a funct. __call é chamada, qdo entra no switch, é testado se é um get ou set.
			case 'get':
				return $this->values[$fieldname];
			break;

			case 'set':
				$this->values[$fieldname] = $args[0]; //neste caso pega o valor armazendo em $fieldname(ex. iduser) e atribui o val. que está em $args[0].
			break;
		} 

	}#fim function __call

	public function setData($data = array())
	{
		foreach ($data as $key => $value) {
			$this->{"set".$key}($value);   //{"set"."nomeDeCadaCampoDaTabela"(Ex:iduser)}($value["valorDoCampoNaTabela"]); Corresponde assim a uma chamada de método.
		}
	}#fim function setData

	public function getValues()
	{
		return $this->values;
	}

}

 ?>