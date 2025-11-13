
-- Schema do banco de dados para o projeto "Projeto_PI_Entrega"
-- Banco: Projeto_PI_Entrega
-- Arquivo gerado automaticamente pelo assistente
USE `Projeto_PI_Entrega`;

-- Tabela de usuários
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(191) NOT NULL,
	`email` VARCHAR(191) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE KEY `idx_usuarios_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de produtos
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de contatos (mensagens enviadas pelo site)
DROP TABLE IF EXISTS `contatos`;
CREATE TABLE `contatos` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(191) NOT NULL,
	`email` VARCHAR(191) NOT NULL,
	`telefone` VARCHAR(30) NULL,
	`mensagem` TEXT NOT NULL,
	`status` ENUM('novo','lido','respondido','arquivado') NOT NULL DEFAULT 'novo',
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `idx_contatos_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de carrinhos
DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE `carrinhos` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT UNSIGNED NOT NULL,
	`total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
	`status` ENUM('ativo','finalizado','cancelado') NOT NULL DEFAULT 'ativo',
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `idx_carrinhos_user` (`user_id`),
	CONSTRAINT `fk_carrinhos_user` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Itens do carrinho
DROP TABLE IF EXISTS `itens_carrinho`;
CREATE TABLE `itens_carrinho` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`carrinho_id` INT UNSIGNED NOT NULL,
	`produto_id` INT UNSIGNED NOT NULL,
	`quantidade` INT NOT NULL DEFAULT 1,
	`preco_unitario` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
	`subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `idx_itens_carrinho_carrinho` (`carrinho_id`),
	KEY `idx_itens_carrinho_produto` (`produto_id`),
	CONSTRAINT `fk_itens_carrinho_carrinho` FOREIGN KEY (`carrinho_id`) REFERENCES `carrinhos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `fk_itens_carrinho_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Observações:
-- 1) `subtotal` em `itens_carrinho` pode ser calculado na aplicação como quantidade * preco_unitario.
-- 2) Ajuste os tipos e tamanhos (VARCHAR) conforme necessário para seu uso real.
-- 3) Se quiser triggers para manter `carrinhos.total` sincronizado com a soma dos subtotais, posso adicionar um exemplo de trigger.

-- Fim do schema
