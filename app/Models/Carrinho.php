<?php

/**
 * Carrinho.php
 * Modelo que representa o carrinho de compras de um usuário.
 * A classe mantém itens em memória (array) e calcula o total.
 * Métodos principais: adicionarItem, removerItem, atualizarQuantidade, limpar, salvar
 * Observação: a implementação atual mantém os itens em memória e contém
 * comentários indicando onde integrar com o banco de dados.
 */

namespace App\Models;

class Carrinho {
    private $id;
    private $userId;
    private $items = [];
    private $total = 0;
    private $created_at;
    private $updated_at;
    
    private $db;
    
    public function __construct($userId = null) {
        $this->userId = $userId;
        // Configuração do banco e inicialização do carrinho
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function getItems() {
        return $this->items;
    }
    
    public function getTotal() {
        return $this->total;
    }
    
    // Métodos de negócio
    public function adicionarItem($produtoId, $quantidade = 1) {
        // Busca o produto
        $produto = Produtos::buscarPorId($produtoId);
        if (!$produto) {
            throw new \Exception("Produto não encontrado");
        }
        
        // Verifica estoque
        if ($produto->getEstoque() < $quantidade) {
            throw new \Exception("Quantidade indisponível");
        }
        
        // Adiciona ou atualiza item no carrinho
        if (isset($this->items[$produtoId])) {
            $this->items[$produtoId]['quantidade'] += $quantidade;
        } else {
            $this->items[$produtoId] = [
                'produto' => $produto,
                'quantidade' => $quantidade,
                'preco' => $produto->estaEmPromocao() ? $produto->getPrecoPromocional() : $produto->getPreco()
            ];
        }
        
        $this->atualizarTotal();
        return true;
    }
    
    public function removerItem($produtoId) {
        if (isset($this->items[$produtoId])) {
            unset($this->items[$produtoId]);
            $this->atualizarTotal();
        }
        return true;
    }
    
    public function atualizarQuantidade($produtoId, $quantidade) {
        if (!isset($this->items[$produtoId])) {
            throw new \Exception("Item não encontrado no carrinho");
        }
        
        if ($quantidade <= 0) {
            return $this->removerItem($produtoId);
        }
        
        $produto = $this->items[$produtoId]['produto'];
        if ($produto->getEstoque() < $quantidade) {
            throw new \Exception("Quantidade indisponível");
        }
        
        $this->items[$produtoId]['quantidade'] = $quantidade;
        $this->atualizarTotal();
        return true;
    }
    
    private function atualizarTotal() {
        $this->total = 0;
        foreach ($this->items as $item) {
            $this->total += $item['preco'] * $item['quantidade'];
        }
    }
    
    public function limpar() {
        $this->items = [];
        $this->total = 0;
        return true;
    }
    
    public function salvar() {
        if (empty($this->userId)) {
            throw new \Exception("Usuário não identificado");
        }
        
        // Salva o carrinho no banco de dados
        // INSERT/UPDATE na tabela carrinho e itens_carrinho
        
        return true;
    }
    
    public static function buscarCarrinhoPorUsuario($userId) {
        // SELECT * FROM carrinho WHERE user_id = :user_id AND status = 'ativo'
        return new Carrinho($userId);
    }
}