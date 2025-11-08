<?php

namespace App\Controllers;

use App\Models\Produtos;

class ProdutosController {
    private $produtos;
    
    public function __construct() {
        $this->produtos = new Produtos();
    }
    
    public function index() {
        $produtos = $this->produtos->listarTodos();
        require_once '../app/Views/produtos.php';
    }
    
    public function promocoes() {
        $produtos = $this->produtos->listarPromocoes();
        require_once '../app/Views/promocoes.php';
    }
    
    public function detalhes($id) {
        $produto = $this->produtos->buscarPorId($id);
        if (!$produto) {
            header('Location: /produtos');
            exit;
        }
        require_once '../app/Views/produto-detalhes.php';
    }
    
    // Métodos para área administrativa
    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->produtos->setNome($_POST['nome'])
                    ->setPreco($_POST['preco'])
                    ->setPrecoPromocional($_POST['preco_promocional'] ?? null)
                    ->setDescricao($_POST['descricao'] ?? '')
                    ->setCategoria($_POST['categoria'])
                    ->setEstoque($_POST['estoque'] ?? 0);
                
                if (isset($_FILES['imagem'])) {
                    // Lógica para upload da imagem
                    $nomeArquivo = $this->uploadImagem($_FILES['imagem']);
                    $this->produtos->setImagem($nomeArquivo);
                }

                $this->produtos->criar();
                header('Location: /admin/produtos');
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
            }
        }
        
        require_once '../app/Views/admin/produto-form.php';
    }
    
    public function editar($id) {
        $produto = Product::buscarPorId($id);
        if (!$produto) {
            header('Location: /admin/produtos');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $produto->setNome($_POST['nome'])
                    ->setPreco($_POST['preco'])
                    ->setPrecoPromocional($_POST['preco_promocional'] ?? null)
                    ->setDescricao($_POST['descricao'] ?? '')
                    ->setCategoria($_POST['categoria'])
                    ->setEstoque($_POST['estoque'] ?? 0);
                
                if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                    $nomeArquivo = $this->uploadImagem($_FILES['imagem']);
                    $produto->setImagem($nomeArquivo);
                }
                
                $produto->atualizar();
                header('Location: /admin/produtos');
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
            }
        }
        
        require_once '../app/Views/admin/produto-form.php';
    }
    
    public function excluir($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $produto = Product::buscarPorId($id);
                if ($produto) {
                    // Lógica para excluir a imagem se existir
                    // Lógica para excluir o produto
                    header('Location: /admin/produtos');
                    exit;
                }
            } catch (\Exception $e) {
                $erro = $e->getMessage();
            }
        }
        header('Location: /admin/produtos');
        exit;
    }
    
    private function uploadImagem($arquivo) {
        $diretorioDestino = 'public/img/produtos/';
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (!in_array($extensao, $extensoesPermitidas)) {
            throw new \Exception('Tipo de arquivo não permitido');
        }
        
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoCompleto = $diretorioDestino . $nomeArquivo;
        
        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
            throw new \Exception('Falha ao fazer upload da imagem');
        }
        
        return $nomeArquivo;
    }
}