<?php

/**
 * Usuario.php
 * Modelo simples para representar usuários do sistema.
 * Campos principais: id, nome, email, senha, created_at, updated_at
 * Observações:
 *  - setSenha() faz hash usando password_hash
 *  - métodos de persistência/consulta estão como exemplos/commented placeholders
 */

namespace App\Models;

use App\Db\BancoDeDados;

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
        $this->db = BancoDeDados::getInstance()->getConnection();
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
        $stmt = $this->db->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();
        if (!$row) { return false; }
        if (!password_verify($senha, $row['senha'])) { return false; }
        $this->id = (int)$row['id'];
        $this->nome = $row['nome'];
        $this->email = $row['email'];
        $this->senha = $row['senha'];
        return true;
    }
    
    public function criar() {
        // Validações básicas
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            throw new \Exception("Todos os campos são obrigatórios");
        }
        
        // Em um cenário real, salvaria no banco:
        // INSERT INTO usuarios (nome, email, senha, created_at) 
        // VALUES (:nome, :email, :senha, NOW())
        $stmt = $this->db->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':senha' => $this->senha,
        ]);
        $this->id = (int)BancoDeDados::getInstance()->lastInsertId();
        return true;
    }
    
    public function atualizar() {
        if (empty($this->id)) {
            throw new \Exception("ID do usuário não definido");
        }
        
        // UPDATE usuarios 
        // SET nome = :nome, email = :email, updated_at = NOW()
        // WHERE id = :id
        $stmt = $this->db->prepare('UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id');
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':id' => $this->id,
        ]);
        return true;
    }
    
    public static function buscarPorEmail($email) {
        // SELECT * FROM usuarios WHERE email = :email LIMIT 1
        $db = BancoDeDados::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT id, nome, email, senha, created_at, updated_at FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();
        if (!$row) { return null; }
        $u = new self();
        $u->id = (int)$row['id'];
        $u->nome = $row['nome'];
        $u->email = $row['email'];
        $u->senha = $row['senha'];
        $u->created_at = $row['created_at'];
        $u->updated_at = $row['updated_at'];
        return $u;
    }
    
    public static function listarTodos() {
        // SELECT * FROM usuarios ORDER BY nome
        $db = BancoDeDados::getInstance()->getConnection();
        $stmt = $db->query('SELECT id, nome, email, created_at, updated_at FROM usuarios ORDER BY nome');
        $res = [];
        while ($row = $stmt->fetch()) {
            $u = new self();
            $u->id = (int)$row['id'];
            $u->nome = $row['nome'];
            $u->email = $row['email'];
            $u->created_at = $row['created_at'];
            $u->updated_at = $row['updated_at'];
            $res[] = $u;
        }
        return $res;
    }
}