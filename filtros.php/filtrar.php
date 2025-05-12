<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "trabalhos");

// Arrays para os selects
$cursos = ['t.i', 'quimica', 'rh', 'adm'];
$series = ['primeiro', 'segundo', 'terceiro'];
$blocos = ['A', 'B'];

// Captura os filtros
$filtroCurso = $_GET['curso'] ?? '';
$filtroSerie = $_GET['serie'] ?? '';
$filtroTema = $_GET['tema'] ?? '';
$filtroBloco = $_GET['bloco'] ?? '';
$filtroNome = $_GET['nome'] ?? '';
$filtroOds = $_GET['tema_ods'] ?? '';

// Query com filtros
$query = "SELECT * FROM trabalhos WHERE 1=1";
if ($filtroCurso) $query .= " AND curso = '" . $conn->real_escape_string($filtroCurso) . "'";
if ($filtroSerie) $query .= " AND serie = '" . $conn->real_escape_string($filtroSerie) . "'";
if ($filtroTema) $query .= " AND tema_ods LIKE '%" . $conn->real_escape_string($filtroTema) . "%'";
if ($filtroBloco) $query .= " AND bloco = '" . $conn->real_escape_string($filtroBloco) . "'";
if ($filtroNome) $query .= " AND nome LIKE '%" . $conn->real_escape_string($filtroNome) . "%'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Filtro de Trabalhos</title>
</head>
<body>


    <div class="container">
        <h1>Filtrar Trabalhos</h1>

        <form method="GET">
            <div>
                <label>Curso:</label>
                <select name="curso">
                    <option value="">Todos</option>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso ?>" <?= $filtroCurso == $curso ? 'selected' : '' ?>>
                            <?= strtoupper($curso) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Série:</label>
                <select name="serie">
                    <option value="">Todas</option>
                    <?php foreach ($series as $serie): ?>
                        <option value="<?= $serie ?>" <?= $filtroSerie == $serie ? 'selected' : '' ?>>
                            <?= ucfirst($serie) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Bloco:</label>
                <select name="bloco">
                    <option value="">Todos</option>
                    <?php foreach ($blocos as $bloco): ?>
                        <option value="<?= $bloco ?>" <?= $filtroBloco == $bloco ? 'selected' : '' ?>>
                            <?= $bloco ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Nome do Aluno:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($filtroNome) ?>">
            </div>

            <div style="grid-column: span 2;">
                <label>Tema (ODS):</label>
                <input type="text" name="tema" value="<?= htmlspecialchars($filtroTema) ?>">
            </div>

            <button type="submit">Filtrar</button>
        </form>

        <h2>Resultados:</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <h3><?= $row['titulo'] ?></h3>
                    <p><strong>Curso:</strong> <?= strtoupper($row['curso']) ?></p>
                    <p><strong>Série:</strong> <?= ucfirst($row['serie']) ?></p>
                    <p><strong>Bloco:</strong> <?= $row['bloco'] ?></p>
                    <p><strong>Aluno:</strong> <?= htmlspecialchars($row['nome']) ?></p>
                    <p><strong>ODS:</strong> <?= htmlspecialchars($row['tema_ods']) ?></p>
                    <p><strong>RM:</strong> <?= htmlspecialchars($row['rm']) ?></p>
                    <p><strong>Orientador:</strong> <?= htmlspecialchars($row['orientador']) ?></p>
                    <p><strong>Posição no Ranking:</strong> <?= $row['posicao'] ?? '—' ?></p>
                    <p><?= nl2br(htmlspecialchars($row['descricao'])) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum trabalho encontrado com os filtros selecionados.</p>
        <?php endif; ?>
    </div>

    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 20px;
}
.container {
    background: white;
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px #ccc;
}
h1 {
    text-align: center;
    color: #333;
}
form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 30px;
}
form label {
    font-weight: bold;
}
form select, form input[type="text"] {
    padding: 8px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 6px;
}
button {
    grid-column: span 2;
    padding: 10px;
    background-color: #3498db;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
button:hover {
    background-color: #2980b9;
}
.card {
    background: #fafafa;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
}
.card h3 {
    margin: 0 0 10px;
    color: #2c3e50;
}
.card p {
    margin: 5px 0;
}
</style>
</body>
</html>
