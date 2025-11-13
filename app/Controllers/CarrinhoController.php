<?php

/**
 * CarrinhoController.php
 * Controlador responsável pelas ações do carrinho de compras.
 *
 * Responsabilidades principais:
 * - Inicializar o carrinho ligado à sessão/usuário
 * - Expor métodos para listar, adicionar, atualizar, remover itens e limpar o carrinho
 * - Responder tanto requisições síncronas quanto via AJAX
 *
 * Observação: este arquivo recebeu apenas documentação (comentários) para facilitar
 * a manutenção; não foram alteradas as regras de negócio.
 */

namespace App\Controllers;

use App\Models\Carrinho;

class CarrinhoController {
    private $carrinho;
    
    public function __construct() {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        $this->carrinho = new Carrinho($userId);
    }
    
    public function index() {
        $itens = $this->carrinho->getItems();
        $total = $this->carrinho->getTotal();
        require_once '../app/Views/carrinho.php';
    }
    
    public function adicionar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /produtos');
            exit;
        }
        
        try {
            $produtoId = $_POST['produto_id'] ?? null;
            $quantidade = (int)($_POST['quantidade'] ?? 1);
            
            if (!$produtoId || $quantidade <= 0) {
                throw new \Exception('Dados inválidos');
            }
            
            $this->cart->adicionarItem($produtoId, $quantidade);
            
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Produto adicionado ao carrinho',
                    'total_itens' => count($this->carrinho->getItems())
                ]);
                exit;
            }
            
            header('Location: /carrinho');
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
            header('Location: /produtos');
            exit;
        }
    }
    
    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /carrinho');
            exit;
        }
        
        try {
            $produtoId = $_POST['produto_id'] ?? null;
            $quantidade = (int)($_POST['quantidade'] ?? 0);
            
            if (!$produtoId) {
                throw new \Exception('Produto não identificado');
            }
            
            $this->cart->atualizarQuantidade($produtoId, $quantidade);
            
            if (isset($_POST['ajax'])) {
                $itens = $this->carrinho->getItems();
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'total' => $this->carrinho->getTotal(),
                    'quantidade_item' => $quantidade,
                    'total_itens' => count($itens)
                ]);
                exit;
            }
            
            header('Location: /carrinho');
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
            header('Location: /carrinho');
            exit;
        }
    }
    
    public function remover() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /carrinho');
            exit;
        }
        
        try {
            $produtoId = $_POST['produto_id'] ?? null;
            
            if (!$produtoId) {
                throw new \Exception('Produto não identificado');
            }
            
            $this->carrinho->removerItem($produtoId);
            
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Item removido do carrinho',
                    'total' => $this->carrinho->getTotal(),
                    'total_itens' => count($this->carrinho->getItems())
                ]);
                exit;
            }
            
            header('Location: /carrinho');
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
            header('Location: /carrinho');
            exit;
        }
    }
    
    public function limpar() {
        $this->carrinho->limpar();
        
        if (isset($_POST['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Carrinho esvaziado'
            ]);
            exit;
        }
        
        header('Location: /carrinho');
        exit;
    }
}