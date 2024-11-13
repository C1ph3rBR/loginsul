-- Use o banco de dados desejado
USE SeuBancoDeDados;

-- Criar a tabela Usuarios
CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name NVARCHAR(255) NOT NULL,
    password NVARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cpf NVARCHAR(255) NOT NULL UNIQUE,
    ativo BIT NOT NULL,
    status_usr SMALLINT NOT NULL,
    superior INT,
    matricula NVARCHAR(255) NOT NULL
);

-- Inserir dados de teste na tabela Usuarios
INSERT INTO Usuarios (name, password, created_at, updated_at, cpf, ativo, status_usr, superior, matricula)
VALUES 
('Alice Silva', 'senhaSegura123', NOW(), NOW(), '123.456.789-01', 1, 1, NULL, 'MTR12345'),
('Bruno Fernandes', 'outraSenhaSegura456', NOW(), NOW(), '987.654.321-00', 1, 2, 1, 'MTR12346'),
('Carla Souza', 'senhaFortissima789', NOW(), NOW(), '321.654.987-00', 1, 3, 1, 'MTR12347'),
('Daniel Rocha', '123senhaSegura', NOW(), NOW(), '654.321.987-00', 1, 1, 2, 'MTR12348'),
('Eduardo Lima', 'senhaForte321', NOW(), NOW(), '567.123.456-78', 0, 2, 2, 'MTR12349');



-- Criar a tabela permissoes (caso não exista)
CREATE TABLE IF NOT EXISTS permissoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sistema NVARCHAR(255) NOT NULL,
    usuario NVARCHAR(255) NOT NULL,
    tem_permissao BIT NOT NULL,
    data_alteracao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir dados na tabela permissoes
INSERT INTO permissoes (sistema, usuario, tem_permissao, data_alteracao)
VALUES 
('Sistema A', 'MTR12345', 0, NOW()),
('Sistema B', 'MTR12346', 1, NOW()),
('Sistema A', 'MTR12347', 0, NOW()),
('Sistema B', 'MTR12348', 1, NOW()),
('Sistema A', 'MTR12349', 0, NOW());

