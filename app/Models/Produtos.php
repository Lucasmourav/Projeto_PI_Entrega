<?php

namespace App\Models;

class Produtos {
    private $id;
    private $nome;
    private $preco;
    private $precoPromocional;
    private $descricao;
    private $categoria;
    private $imagem;
    private $estoque;
    private $created_at;
    private $updated_at;
    
    private $db;
    
    public function __construct() {
        // Configuração do banco
    }
    
    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    
    public function getPreco() {
        return $this->preco;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
        return $this;
    }
    
    public function getPrecoPromocional() {
        return $this->precoPromocional;
    }
    
    public function setPrecoPromocional($preco) {
        $this->precoPromocional = $preco;
        return $this;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }
    
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }
    
    public function getImagem() {
        return $this->imagem;
    }
    
    public function setImagem($imagem) {
        $this->imagem = $imagem;
        return $this;
    }
    
    public function getEstoque() {
        return $this->estoque;
    }
    
    public function setEstoque($quantidade) {
        $this->estoque = $quantidade;
        return $this;
    }
    
    // Métodos de negócio
    public function criar() {
        if (empty($this->nome) || empty($this->preco)) {
            throw new \Exception("Nome e preço são obrigatórios");
        }
        
        // INSERT INTO produtos 
        // (nome, preco, preco_promocional, descricao, categoria, imagem, estoque, created_at)
        // VALUES (:nome, :preco, :preco_promocional, :descricao, :categoria, :imagem, :estoque, NOW())
        
        return true;
    }
    
    public function atualizar() {
        if (empty($this->id)) {
            throw new \Exception("ID do produto não definido");
        }
        
        // UPDATE produtos SET ... WHERE id = :id
        
        return true;
    }
    
    public static function buscarPorId($id) {
        // SELECT * FROM produtos WHERE id = :id LIMIT 1
        return null;
    }
    
    public static function listarTodos() {
        // SELECT * FROM produtos ORDER BY nome
        
        // Simulação de produtos para desenvolvimento
        return [
            [
                'id' => 1,
                'nome' => 'Morangos do Amor',
                'preco' => 15.00,
                'precoPromocional' => 8.00,
                'imagem' => 'produtos1.png'
            ],
            [
                'id' => 2,
                'nome' => 'Abacaxi do Amor',
                'preco' => 12.00,
                'precoPromocional' => 8.00,
                'imagem' => 'produtos2.png'
            ],
            [
                'id' => 3,
                'nome' => 'Uva do Amor',
                'preco' => 16.00,
                'precoPromocional' => 8.00,
                'imagem' => 'produtos3.png'
            ]
        ];
    }
    
    public static function listarPromocoes() {
        // SELECT * FROM produtos WHERE preco_promocional IS NOT NULL AND preco_promocional < preco
        return [];
    }
    
    public function baixarEstoque($quantidade) {
        if ($this->estoque < $quantidade) {
            throw new \Exception("Estoque insuficiente");
        }
        
        $this->estoque -= $quantidade;
        return $this->atualizar();
    }
    
    public function estaEmPromocao() {
        return !empty($this->precoPromocional) && $this->precoPromocional < $this->preco;
    }
}