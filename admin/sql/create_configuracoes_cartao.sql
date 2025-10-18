CREATE TABLE IF NOT EXISTS configuracoes_cartao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('encontrista', 'equipe') NOT NULL UNIQUE,
    largura_mm INT NOT NULL,
    altura_mm INT NOT NULL,
    imagem_fundo VARCHAR(255) DEFAULT NULL,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
