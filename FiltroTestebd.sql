USE trabalhos;

DROP TABLE IF EXISTS trabalhos;


CREATE TABLE IF NOT EXISTS trabalhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    curso ENUM('t.i', 'quimica', 'rh', 'adm'),
    serie ENUM('primeiro', 'segundo', 'terceiro'),
    bloco ENUM('A', 'B'),
    nome VARCHAR(255),
    tema_ods VARCHAR(255),
    descricao TEXT,
    rm VARCHAR(255),
    orientador VARCHAR(255),
    posicao VARCHAR(255),
    UNIQUE (titulo, curso, serie)
    
);


INSERT IGNORE INTO trabalhos (titulo, curso, serie, bloco, nome, rm, tema_ods, orientador, descricao, posicao) VALUES
('Reciclagem Sustentável', 'quimica', 'primeiro', 'A', 'Ana Silva', '23078', 'ODS 12 - Consumo e produção responsáveis', 'Prof. João', 'Projeto sobre reutilização de materiais no laboratório.', 'primeiro'),
('Sistema Web Escolar', 't.i', 'terceiro', 'B', 'Carlos Souza', '22221', 'ODS 4 - Educação de qualidade', 'Prof. Maria', 'Aplicação web para organização de conteúdos escolares.', 'terceiro lugar'),
('Campanha de Saúde Mental', 'rh', 'segundo', 'A', 'Beatriz Lima', '23232', 'ODS 3 - Saúde e bem-estar', 'Prof. Carlos', 'Ação de conscientização nas escolas.', 'quinto lugar'),
('Plano de Negócio Sustentável', 'adm', 'terceiro', 'B', 'João Pereira', '4533', 'ODS 8 - Trabalho decente e crescimento econômico', 'Prof. Ana', 'Modelo de negócio com foco em sustentabilidade.', 'décimo lugar'),
('Automação de Tarefas', 't.i', 'segundo', 'A', 'Lucas Mendes', '23078', 'ODS 9 - Indústria, inovação e infraestrutura', 'Prof. Marcos', 'Script para automação de tarefas administrativas.', 'quarto lugar'),
('Automação de java', 't.i', 'terceiro', 'B', 'Luqueta', '23078', 'ODS 9 - Indústria, inovação e infraestrutura', 'Prof. Marcos', 'programa foda', 'ultimo lugar'),
('Qualquer coisa', 't.i', 'terceiro', 'B', 'Angelo, guilherme, summerfileld', '33333', 'ODS 7 - sexualidade bla bla', 'Prof. guilherme', 'java', 'quinto lugar');

