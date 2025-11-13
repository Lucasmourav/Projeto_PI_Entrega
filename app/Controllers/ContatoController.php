<?php

namespace App\Controllers;

use App\Models\Contato;

class ContatoController {
    private $contato;
    
    public function __construct() {
        $this->contato = new Contato();
    }
    
    public function index() {
        require_once '../app/Views/contato.php';
    }
    
    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contato');
            exit;
        }
        
        try {
            $this->contato->setNome($_POST['nome'])
                ->setEmail($_POST['email'])
                ->setTelefone($_POST['telefone'] ?? '')
                ->setMensagem($_POST['mensagem']);
            
            $this->contato->enviar();
            
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Mensagem enviada com sucesso!'
                ]);
                exit;
            }
            
            $_SESSION['sucesso'] = 'Mensagem enviada com sucesso!';
            header('Location: /contato');
            exit;
            
        } catch (\Exception $e) {
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
            
            $_SESSION['erro'] = $e->getMessage();
            header('Location: /contato');
            exit;
        }
    }
    
    // Métodos para área administrativa
    public function listar() {
        $status = $_GET['status'] ?? null;
        $mensagens = Contact::listarTodos($status);
        require_once '../app/Views/admin/contatos-lista.php';
    }
    
    public function visualizar($id) {
        $mensagem = Contact::buscarPorId($id);
        if (!$mensagem) {
            header('Location: /admin/contatos');
            exit;
        }
        require_once '../app/Views/admin/contato-detalhes.php';
    }
    
    public function responder($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/contatos');
            exit;
        }
        
        try {
            $mensagem = Contact::buscarPorId($id);
            if (!$mensagem) {
                throw new \Exception('Mensagem não encontrada');
            }
            
            $resposta = $_POST['resposta'] ?? '';
            if (empty($resposta)) {
                throw new \Exception('A resposta não pode estar vazia');
            }
            
            $mensagem->responder($resposta);
            
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Resposta enviada com sucesso!'
                ]);
                exit;
            }
            
            $_SESSION['sucesso'] = 'Resposta enviada com sucesso!';
            header('Location: /admin/contatos');
            exit;
            
        } catch (\Exception $e) {
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
            
            $_SESSION['erro'] = $e->getMessage();
            header('Location: /admin/contatos');
            exit;
        }
    }
}