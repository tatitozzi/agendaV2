<?php
// POST - Analisa se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $apelido = filter_input(INPUT_POST, 'apelido');
    $email = filter_input(INPUT_POST, 'email');
    $numero = filter_input(INPUT_POST, 'numero');

} else if (!isset($id)) {// Caso ID não possua nenhum valor, seta um valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
}

try { //CONEXÃO com o BD
    $conexao = new PDO("mysql:host=localhost;dbname=id5469055_lista", "id5469055_opt", "123456");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    //echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
                echo "<script>
             alert ('Erro na conexão:' . $erro->getMessage() .'!');
           </script>";
}

//CREATE/UPDATE - Salva dados do formulário no BD
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE pessoa SET nome=?, apelido=?, email=?, numero=? WHERE id = ?");
            $stmt->bindParam(5, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO pessoa (nome, apelido, email, numero) VALUES (?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $apelido);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $numero);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {//atualizar para SWEET ALERT
                //echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
            echo "<script>
             alert ('Dados cadastrados com sucesso!');
           </script>";
                $id = null;
                $nome = null;
                $apelido = null;
                $email = null;
                $numero = null;
            } else {//atualizar para SWEET ALERT
                //echo "<p class=\"bg-danger\">Erro ao tentar efetivar cadastro</p>";
                 echo "<script>
             alert ('Erro ao tentar efetivar cadastro');
           </script>";
            }
        } else {//atualizar para SWEET ALERT
            //echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
             echo "<script>
                     alert ('Não foi possível executar a declaração sql');
                   </script>";
        }
    } catch (PDOException $erro) {//atualizar para SWEET ALERT
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
                       //      echo "<script>
                //     alert (' . $erro->getMessage() ');
                 //  </script>";
    }
}

//UPDATE - recebe as informações para inserir no formulário
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE id = ?");
        //$stmt = $conexao->prepare("SELECT * FROM pessoa as p, telefones as t WHERE p.id = ? && t.pessoa = p.id");'
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $apelido = $rs->apelido;
            $email = $rs->email;
            $numero = $rs->numero;
        } else {//atualizar para SWEET ALERT
            //echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
                     echo "<script>
                     alert ('Não foi possível executar a declaração sql');
                   </script>";
        }
    } catch (PDOException $erro) {//atualizar para SWEET ALERT
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
         // echo "<script>
          //           alert ('Erro: ' . $erro->getMessage() . ');
            //       </script>";
    }
}

//DELETE - deleta item da tabela(BD) conforme ID
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM pessoa WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {//atualizar para SWEET ALERT
            echo "<script>
                     alert ('Contato excluído com sucesso!');
                   </script>";
            //echo "<p class=\"bg-success\">Contato foi excluído com êxito</p>";
            
            $id = null;
        } else {//atualizar para SWEET ALERT
            //echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
                        echo "<script>
                     alert ('Erro: Não foi possível executar a declaração sql');
                   </script>";
        }
    } catch (PDOException $erro) {//atualizar para SWEET ALERT
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</a>";
        // echo "<script>
          //           alert ('Erro: ' . $erro->getMessage() . ');
             //      </script>";
    }
}