<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;

class User {

	public static function login($login, $password = "1")
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0)
		{
			throw new \Exception("Usuário ou Senha Inválido.");  //aqui uma "\", pq o Exception vem da raiz.
			
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)         //- faz um verific. e retorna um boolean.
		{
			$user = new User();
			
		} else {
			throw new \Exception("Usuário ou Senha Inválido.");
		}


	}

}



 ?>