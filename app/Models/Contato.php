<?php

namespace App\Models;

class Contato {
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $mensagem;
    private $status;
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
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$this->email) {
            throw new \Exception("Email inválido");
        }
        return $this;
    }
    
    public function getTelefone() {
        return $this->telefone;
    }
    
    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/[^0-9]/', '', $telefone);
        return $this;
    }
    
    public function getMensagem() {
        return $this->mensagem;
    }
    
    public function setMensagem($mensagem) {
        $this->mensagem = trim($mensagem);
        return $this;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
    
    // Métodos de negócio
    public function enviar() {
        if (empty($this->nome) || empty($this->email) || empty($this->mensagem)) {
            throw new \Exception("Nome, email e mensagem são obrigatórios");
        }
        
        // INSERT INTO contatos 
        // (nome, email, telefone, mensagem, status, created_at)
        // VALUES (:nome, :email, :telefone, :mensagem, 'novo', NOW())
        
        // Aqui poderia ter um envio de email para notificar o administrador
        
        return true;
    }
    
    public static function buscarPorId($id) {
        // SELECT * FROM contatos WHERE id = :id LIMIT 1
        return null;
    }
    
    public static function listarTodos($status = null) {
        // SELECT * FROM contatos WHERE status = :status ORDER BY created_at DESC
        return [];
    }
    
    public function responder($resposta) {
        if (empty($resposta)) {
            throw new \Exception("Resposta não pode estar vazia");
        }
        
        $this->status = 'respondido';
        
        // UPDATE contatos SET status = 'respondido', updated_at = NOW() WHERE id = :id
        
        // Aqui poderia ter um envio de email com a resposta para o contato
        
        return true;
    }
}