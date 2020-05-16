<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;               //- para definir rotas.
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {   //aqui são definidas as rotas. Neste caso "/" é a raiz.

	$page = new Page();       //chama a classe Page. Esta classe posso o construct e o destruct, que são executados assim que instanciada a classe. Dentro do construct chama o header, e no destruct chama o footer.

	$page->setTpl("index");   //chama o método que tras o body html.

});

$app->get('/admin', function() {   //aqui são definidas as rotas. Neste caso "/" é a raiz.

	$page = new PageAdmin();       //chama a classe Page. Esta classe posso o construct e o destruct, que são executados assim que instanciada a classe. Dentro do construct chama o header, e no destruct chama o footer.

	$page->setTpl("index");   //chama o método que tras o body html.

});

$app->get('/admin/login', function() {   //aqui são definidas as rotas. Neste caso "/" é a raiz.

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false,
		]);       //chama a classe Page. Esta classe posso o construct e o destruct, que são executados assim que instanciada a classe. Dentro do construct chama o header, e no destruct chama o footer.

	$page->setTpl("login");   //chama o método que tras o body html.

});

$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

});

$app->run();                  //aqui chama as rotas.

 ?>