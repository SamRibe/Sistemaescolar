<?php
$mysqli = new mysqli("localhost", "username", "password", "database");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$action = $_GET['action'];

if ($action == 'register') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Registro realizado com sucesso.']);
    } else {
        echo json_encode(['error' => 'Erro ao registrar usuário.']);
    }
    $stmt->close();
} elseif ($action == 'login') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $mysqli->prepare("SELECT nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nome, $senhaHash);
        $stmt->fetch();
        
        if (password_verify($senha, $senhaHash)) {
            echo json_encode(['success' => 'Login realizado com sucesso.', 'nome' => $nome]);
        } else {
            echo json_encode(['error' => 'Senha incorreta.']);
        }
    } else {
        echo json_encode(['error' => 'E-mail não encontrado.']);
    }
    $stmt->close();
} elseif ($action == 'cadastrarTurma') {
    $nome = $_POST['nome'];
    $stmt = $mysqli->prepare("INSERT INTO turmas (nome) VALUES (?)");
    $stmt->bind_param("s", $nome);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Turma cadastrada com sucesso.']);
    } else {
        echo json_encode(['error' => 'Erro ao cadastrar turma.']);
    }
    $stmt->close();
} elseif ($action == 'listarTurmas') {
    $result = $mysqli->query("SELECT id, nome FROM turmas");
    $turmas = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($turmas);
}

$mysqli->close();
?>
