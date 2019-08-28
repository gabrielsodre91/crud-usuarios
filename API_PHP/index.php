<?php

use App\Model\InicializarBanco;
use App\Model\Conexao;
use App\Model\UsuarioDAO;
use App\Model\Usuario;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "vendor/autoload.php";

// INICIALIZAR O BANCO DE DADOS
InicializarBanco::criarBanco();


// ROTAS
$app = new \Slim\App;

$app->post('/usuario/insert', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();

    $retorno = new stdClass();
    
    try {
        if(!isset($params['nome']) || !isset($params['email']) || !isset($params['telefone'])){
            throw new Exception("Dados inválidos.");
        } else {
            $usuario = new Usuario();
            $usuario->setNome($params['nome']);
            $usuario->setEmail($params['email']);
            $usuario->setTelefone($params['telefone']);
        }
    
        UsuarioDAO::insert($usuario);

        $retorno->erro = 0;
        $retorno->mensagem = "Usuário salvo com sucesso!";
    } catch (Exception $e){
        $retorno->erro = 1;
        $retorno->mensagem = $e->getMessage();
    }

    // APENAS PRA SIMULAR O CARREGAMENTO NO LOCALHOST
    sleep(1);

    $response->getBody()->write(json_encode($retorno));

    return $response;
});

$app->post('/usuario/update', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();

    $retorno = new stdClass();

    try {
        if(!isset($params['id']) || !isset($params['nome']) || !isset($params['email']) || !isset($params['telefone'])){
            throw new Exception("Dados inválidos.");
        } else {
            $usuario = new Usuario();
            $usuario->setId($params['id']);
            $usuario->setNome($params['nome']);
            $usuario->setEmail($params['email']);
            $usuario->setTelefone($params['telefone']);
        }
    
        UsuarioDAO::update($usuario);

        $retorno->erro = 0;
        $retorno->mensagem = "Usuário atualizado com sucesso!";
    } catch (Exception $e){
        $retorno->erro = 1;
        $retorno->mensagem = $e->getMessage();
    }

    // APENAS PRA SIMULAR O CARREGAMENTO NO LOCALHOST
    sleep(1);

    $response->getBody()->write(json_encode($retorno));

    return $response;
});

$app->post('/usuario/delete', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();

    $retorno = new stdClass();

    try {
        if(!isset($params['id'])){
            throw new Exception("Dados inválidos.");
        } else {
            $usuario = new Usuario();
            $usuario->setId($params['id']);
        }
    
        UsuarioDAO::delete($usuario);

        $retorno->erro = 0;
        $retorno->mensagem = "Usuário excluído com sucesso!";
    } catch (Exception $e){
        $retorno->erro = 1;
        $retorno->mensagem = $e->getMessage();
    }

    // APENAS PRA SIMULAR O CARREGAMENTO NO LOCALHOST
    sleep(1);

    $response->getBody()->write(json_encode($retorno));

    return $response;
});

$app->post('/usuario/read', function (Request $request, Response $response, array $args) {
    $retorno = new stdClass();
    
    try {
        $retorno->usuarios = UsuarioDAO::read();

        $retorno->erro = 0;
        $retorno->mensagem = "Listagem realizada com sucesso!";
    } catch (Exception $e){
        $retorno->erro = 1;
        $retorno->mensagem = $e->getMessage();
    }

    // APENAS PRA SIMULAR O CARREGAMENTO NO LOCALHOST
    sleep(1);

    $response->getBody()->write(json_encode($retorno));

    return $response;
});

$app->post('/usuario/readOne', function (Request $request, Response $response, array $args) {
    $params = $request->getParsedBody();

    $retorno = new stdClass();
    
    try {
        if(!isset($params['id'])){
            throw new Exception("Dados inválidos.");
        } else {
            $usuario = new Usuario();
            $usuario->setId($params['id']);
        }

        $retorno->usuarios = UsuarioDAO::readOne($usuario);

        $retorno->erro = 0;
        $retorno->mensagem = "Listagem realizada com sucesso!";
    } catch (Exception $e){
        $retorno->erro = 1;
        $retorno->mensagem = $e->getMessage();
    }

    // APENAS PRA SIMULAR O CARREGAMENTO NO LOCALHOST
    sleep(1);

    $response->getBody()->write(json_encode($retorno));

    return $response;
});

// CONFIGURAÇÕES SLIM
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();