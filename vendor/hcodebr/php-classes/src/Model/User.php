<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model{

	const SESSION = "User";   //nome da sessão.

	public static function login($login, $password)
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

		//print_r($data);

		if (password_verify($password, $data["despassword"]) === true)         //- faz um verific. e retorna um boolean.
		{
			$user = new User();

			#$user->setiduser($data["iduser"]);
			#$user->setidperson($data["idperson"]);
			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();  //iniciando uma sessão e passando como dados, os mesmos $data;

			return $user;
			
		} else {
			throw new \Exception("Usuário ou Senha Inválido.");
		}


	}#fim function login.

	public static function verfifylogin($inadmin = true)
	{

		if (
			!isset($_SESSION[User::SESSION])                //verifica se a sessão foi criada.
			||
			!$_SESSION[User::SESSION]                       //verifica se está vazia.
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0   //verifica se existe um id na sessão.
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin //verifica se é admin.
		) {
			header("Location: /admin/login");
			exit;

		}

	}#fim function verfifylogin


	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

}



 ?>