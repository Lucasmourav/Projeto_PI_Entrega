<?php

/**
 * BancoDeDados.php
 * Classe singleton responsável por criar e expor uma conexão PDO com o
 * banco MySQL usado pelo projeto.
 *
 * Responsabilidades:
 *  - Instanciar e manter uma única conexão PDO
 *  - Fornecer métodos utilitários simples: prepare, beginTransaction, commit,
 *    rollback e lastInsertId
 *
 * Observações:
 *  - As credenciais e o nome do banco estão atualmente hard-coded aqui
 *    (localhost / Projeto_PI_Entrega / root / ''). Para produção, mova
 *    essas configurações para variáveis de ambiente ou um arquivo seguro.
 *  - A classe foi apenas documentada; não alterei a lógica de conexão.
 */

namespace App\Db;

class BancoDeDados {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $host = 'localhost';
        $dbname = 'Projeto_PI_Entrega';
        $user = 'root';
        $pass = '';
        
        try {
            $this->conn = new \PDO(
                "mysql:host={$host};dbname={$dbname};charset=utf8",
                $user,
                $pass,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (\PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
    
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->conn->beginTransaction();
    }
    
    public function commit() {
        return $this->conn->commit();
    }
    
    public function rollback() {
        return $this->conn->rollBack();
    }
}