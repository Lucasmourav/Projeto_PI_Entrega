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

    public function ensureUsuariosTabela() {
        $sql = "CREATE TABLE IF NOT EXISTS `usuarios` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `nome` VARCHAR(191) NOT NULL,
            `email` VARCHAR(191) NOT NULL,
            `senha` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `idx_usuarios_email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $this->conn->exec($sql);
    }

    public function ensureProdutosTabela() {
        $sql = "CREATE TABLE IF NOT EXISTS `produtos` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `nome` VARCHAR(255) NOT NULL,
            `preco` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `preco_promocional` DECIMAL(10,2) NULL,
            `descricao` TEXT NULL,
            `categoria` VARCHAR(100) NULL,
            `imagem` VARCHAR(255) NULL,
            `estoque` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_produtos_nome` (`nome`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $this->conn->exec($sql);
    }

    public function seedUsuarioPadrao() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM usuarios");
        $row = $stmt->fetch();
        if ((int)$row['total'] === 0) {
            $senha = password_hash('1234', PASSWORD_DEFAULT);
            $ins = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
            $ins->execute([':n' => 'Administrador', ':e' => 'admin@doceria.com', ':s' => $senha]);
        }
    }

    public function seedProdutosPadrao() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM produtos");
        $row = $stmt->fetch();
        if ((int)$row['total'] === 0) {
            $sql = "INSERT INTO produtos (nome, preco, preco_promocional, descricao, categoria, imagem, estoque) VALUES
                ('Bolo de Chocolate', 39.90, NULL, 'Bolo feito com cacau 70%', 'Bolos', 'bolo_chocolate.jpg', 20),
                ('Brigadeiro Gourmet', 2.50, NULL, 'Brigadeiro com granulado belga', 'Doces', 'brigadeiro.jpg', 200),
                ('Torta de Limão', 54.90, 49.90, 'Torta artesanal com merengue', 'Tortas', 'torta_limao.jpg', 10)";
            $this->conn->exec($sql);
        }
    }
}