<?php

namespace App\Models;

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $created_at;
    private $updated_at;
    
    // Conexão com o banco (pode ser injetada via construtor em um cenário real)
    private $db;
    
    public function __construct() {
        // Aqui você configuraria a conexão real com o banco
        // $this->db = new PDO(...);
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
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function setSenha($senha) {
        // Sempre hash a senha antes de salvar
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        return $this;
    }
    
    // Métodos de negócio
    public function autenticar($email, $senha) {
        // Em um cenário real, verificaria no banco
        // SELECT * FROM usuarios WHERE email = :email LIMIT 1
        
        if ($email === "teste@doceria.com" && $senha === "1234") {
            return true;
        }
        return false;
    }
    
    public function criar() {
        // Validações básicas
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            throw new \Exception("Todos os campos são obrigatórios");
        }
        
        // Em um cenário real, salvaria no banco:
        // INSERT INTO usuarios (nome, email, senha, created_at) 
        // VALUES (:nome, :email, :senha, NOW())
        
        return true;
    }
    
    public function atualizar() {
        if (empty($this->id)) {
            throw new \Exception("ID do usuário não definido");
        }
        
        // UPDATE usuarios 
        // SET nome = :nome, email = :email, updated_at = NOW()
        // WHERE id = :id
        
        return true;
    }
    
    public static function buscarPorEmail($email) {
        // SELECT * FROM usuarios WHERE email = :email LIMIT 1
        return null; // Retornaria um objeto User se encontrado
    }
    
    public static function listarTodos() {
        // SELECT * FROM usuarios ORDER BY nome
        return []; // Retornaria array de objetos User
    }
}