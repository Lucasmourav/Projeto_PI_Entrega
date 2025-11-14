<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuariosController {
    private $usuario;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->usuario = new Usuario();
    }

    public function index() {
        header('Location: /login');
        exit;
    }

    public function login() {
        $erro_login = '';
        $sucesso_cadastro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';

            if ($acao === 'login') {
                $email = trim($_POST['email_login'] ?? '');
                $senha = $_POST['senha_login'] ?? '';

                try {
                    if ($email === '' || $senha === '') {
                        throw new \Exception('Informe e-mail e senha.');
                    }

                    if (!$this->usuario->autenticar($email, $senha)) {
                        throw new \Exception('E-mail ou senha incorretos.');
                    }

                    $_SESSION['usuario'] = $email;
                    $_SESSION['user_id'] = 1; // Placeholder
                    global $BASE;
                    header('Location: ' . $BASE . '/');
                    exit;
                } catch (\Exception $e) {
                    $erro_login = $e->getMessage();
                }
            } elseif ($acao === 'cadastro') {
                $nome  = trim($_POST['nome_cadastro'] ?? '');
                $email = trim($_POST['email_cadastro'] ?? '');
                $senha = $_POST['senha_cadastro'] ?? '';

                try {
                    if ($nome === '' || $email === '' || $senha === '') {
                        throw new \Exception('Preencha todos os campos para se cadastrar.');
                    }

                    if (Usuario::buscarPorEmail($email)) {
                        throw new \Exception('E-mail já cadastrado.');
                    }

                    $this->usuario
                        ->setNome($nome)
                        ->setEmail($email)
                        ->setSenha($senha)
                        ->criar();

                    $sucesso_cadastro = 'Cadastro realizado com sucesso! Agora você pode entrar.';
                } catch (\Exception $e) {
                    $erro_login = $e->getMessage();
                }
            }
        }

        // Torna a variável $BASE (definida no front controller) disponível para a view
        global $BASE; 
        require_once '../app/Views/login.php';
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        global $BASE;
        header('Location: ' . $BASE . '/');
        exit;
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        try {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            if ($nome === '' || $email === '' || $senha === '') {
                throw new \Exception('Todos os campos são obrigatórios.');
            }

            if (Usuario::buscarPorEmail($email)) {
                throw new \Exception('E-mail já cadastrado.');
            }

            $this->usuario
                ->setNome($nome)
                ->setEmail($email)
                ->setSenha($senha)
                ->criar();

            $_SESSION['sucesso'] = 'Cadastro realizado. Faça login.';
            global $BASE;
            header('Location: ' . $BASE . '/login');
            exit;
        } catch (\Exception $e) {
            $_SESSION['erro'] = $e->getMessage();
            global $BASE;
            header('Location: ' . $BASE . '/login');
            exit;
        }
    }
}
