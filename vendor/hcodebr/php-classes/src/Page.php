<?php 

namespace Hcode;

use Rain\Tpl;          //- para desenha templates(padrões). Chama html indicados e parâmetros, como variáveis.

class Page 
{
	private $tpl;
	private $options = []; 
	private $defaults = [
		"data"=>[]
	];

	//como no template eu preciso passar var.(key => value), criamos arrays($opts = array()) para passar as mesmas. Mas caso este array venha vazio, criamos o array $default[data[]] com valores de default. Então fazemos um merge dos 2 arrays, caso um ñ substitua o outro, as inf. serão somadas em um outra array $options.
	public function __construct($opts = array())
	{
			$this->options = array_merge($this->defaults, $opts);

		// config
		$config = array(
						"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",       //DOCUMENT_ROOT-retorna a raiz.
						"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
						"debug"         => false // set to false to improve the speed
					   );

		Tpl::configure( $config );

		// create the Tpl object
		$this->tpl = new Tpl;

		// assign a variable
		$this->setData($this->options["data"]);

		$this->tpl->draw("header");  //desenha o header do html.
	}

	private function setData($data = array())
	{
		foreach ($data as $key => $value) 
		{
			$this->tpl->assign($key, $value);
		}	
	}

	public function setTpl($name, $data = array(), $returnHTML = false)  
	{
		$this->setData($data);       //desenha o body do html.

		return $this->tpl->draw($name, $returnHTML);
	}

	public function __destruct()
	{
		$this->tpl->draw("footer"); //desenha o footer do html.
	}

}

 ?>