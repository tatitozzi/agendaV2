<?php

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $apelido = filter_input(INPUT_POST, 'apelido');
    $email = filter_input(INPUT_POST, 'email');
    $telefones = filter_input(INPUT_POST, 'telefones');
} else if (!isset($id)) {
// Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
}

// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=agenda", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
}

// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE pessoa SET nome=?, apelido=?, email=?, telefones=? WHERE id = ?");
            $stmt->bindParam(10, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO pessoa (nome, apelido, email, telefones) VALUES (?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $apelido);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $telefones);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
                $id = null;
                $nome = null;
                $apelido = null;
                $email = null;
                $telefones = null;

            } else {
                echo "<p class=\"bg-danger\">Erro ao tentar efetivar cadastro</p>";
            }
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}

// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM pessoa, telefones"); //alterar!!!
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $apelido = $rs->apelido;
            $email = $rs->email;
            $numero = $rs->numero;

        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}

// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM pessoa WHERE id = ?"); // alterar!! ()
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<p class=\"bg-success\">Registro foi excluído com êxito</p>";
            $id = null;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</a>";
    }
}

?>

<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cadastrar .:. Listar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets\style\buefy.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets\style\bulma-docs.min.css" />
        <script src="main.js"></script>
    </head>
    <body>
        <divclass="is-info">
                <nav class="navbar is-transparent">
                        <div class="navbar-brand">
                          <a class="navbar-item" href="//">
                            <img src="assets\images\contato.png" alt="Agenda" width="135"> Telefônica
                          </a>
                          <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                            <span></span>
                            <span></span>
                            <span></span>
                          </div>
                        </div>
                      
                        <div id="navbarExampleTransparentExample" class="navbar-menu">
                          <div class="navbar-start">
                            <a class="navbar-item" href="/">
                              Início
                            </a>
                            <div class="navbar-item has-dropdown is-hoverable">
                              <a class="navbar-link" href="/">
                                Contatos
                              </a>
                              <div class="navbar-dropdown is-boxed">
                                <a class="navbar-item" href="/">
                                  Cadastrar
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="/">
                                  Listar
                                </a>
                              </div>
                            </div>
                          </div>
                      
                          <div class="navbar-end">
                            <div class="navbar-item">
                              <div class="field is-grouped">
                                <p class="control">
                                  <a class="bd-tw-button button" data-social-network="Login" data-social-action="tweet" data-social-target="http://localhost:4000"target="_blank" href="https://twitter.com/intent/tweet?text=Bulma:%20a%20modern%20CSS%20framework%20based%20on%20Flexbox&amp;hashtags=bulmaio&amp;url=http://localhost:4000&amp;via=jgthms">
                                    <span class="icon">
                                      <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="#FFFFFF" d="M9,5V9H21V5M9,19H21V15H9M9,14H21V10H9M4,9H8V5H4M4,19H8V15H4M4,14H8V10H4V14Z" />
                                    </svg>
                                    </span>
                                    <span>
                                      Listar
                                    </span>
                                  </a>
                                </p>
                                <p class="control">
                                    <a class="bd-tw-button button" data-social-network="Login" data-social-action="tweet" data-social-target="http://localhost:4000"target="_blank" href="https://twitter.com/intent/tweet?text=Bulma:%20a%20modern%20CSS%20framework%20based%20on%20Flexbox&amp;hashtags=bulmaio&amp;url=http://localhost:4000&amp;via=jgthms">
                                      <span class="icon">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
                   <path fill="#FFFFFF" d="M15,14C12.33,14 7,15.33 7,18V20H23V18C23,15.33 17.67,14 15,14M6,10V7H4V10H1V12H4V15H6V12H9V10M15,12A4,4 0 0,0 19,8A4,4 0 0,0 15,4A4,4 0 0,0 11,8A4,4 0 0,0 15,12Z" />
                </svg>
                                      </span>
                                      <span>
                                        Cadastrar
                                      </span>
                                    </a>
                                  </p>
                
                              </div>
                            </div>
                          </div>
                        </div>
                      </nav>
                
        </div>

    <div id="app" class="container">

        <section>
            <b-tabs position="is-centered" class="block">
                <b-tab-item label="Cadastrar">
                <!--- CADASTRAR -->
  
                  <h3 id="cadastra" class="title is-4 is-spaced bd-anchor-title">
                    <span class="bd-anchor-name">
                      Novo cadastro
                    </span>
                    <a class="bd-anchor-link" href="#cadastra">
                    </a>
                  </h3> 

                  
                  <div id="app" class="container bd-footer-stars">
                      <section class="container is-fluid">

</section>
</div>

<form action="?act=save" method="POST">

<input type="hidden" name="id" value="<?php
// Preenche o id no campo id com um valor "value"
echo (isset($id) && ($id != null || $id != "")) ? $id : '';

?>" />
	
<div class="item" >
    <label class="label git is-normal" >Nome: </label>
  <b-field> 
    <input class="name input" id="nome"  placeholder="Nome" type="text" 
    value="<?php
    // Preenche o nome no campo nome com um valor "value"
    echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';

    ?>">
  </b-field>
 </div>

 <div class="item" >
    <label class="label" >Apelido: </label>  
  <b-field> 
      <b-input class="nickname" id="apelido" placeholder="apelido" type="text" value="<?php
    // Preenche o nome no campo apelido com um valor "value"
    echo (isset($apelido) && ($apelido != null || $apelido != "")) ? $apelido : '';

    ?>">></b-input>
    </b-field>
   </div>

   <div class="item " >
      <label class="label" >E-mail: </label>
      <b-field> 
         <b-input class="email field has-addons has-addons-left" id="email" placeholder="nome@mail.com" 
         type="email" value="<?php
    // Preenche o nome no campo email com um valor "value"
    echo (isset($email) && ($email != null || $email != "")) ? $email : '';

    ?>">></b-input>
      </b-field>
     </div>
      <br>
      
     <div class="field is-grouped component component-phone">
        <label class="label" for="">Telefones: </label>
         <div class="item"> </div> 
            <p class="control is-expanded">
              <input class="numero input" id="numero" type="text" type="tel" placeholder="XXX-XXX-XXX" maxlength="12"
              value="<?php
              // Preenche o nome no campo nome com um valor "value"
              echo (isset($numero) && ($numero != null || $numero != "")) ? $numero : '';

              ?>">
              
            </p>
            <p class="control">
              <a class="button is-info is-primary">
                +
              </a>
            </p>
        </div>

          <br>                                 
    <div class="field is-grouped is-grouped-right">
        <p class="control">
          <a class="enviar-dados button is-primary" type="submit">
            Salvar
          </a>
        </p>
        <p class="control">
          <a class="button is-light" type="reset">
            Cancelar
          </a>
        </p>
      </div>

    </form>
                 <!--- CADASTRAR -->
              </b-tab-item>
              
                <b-tab-item label="Listar">
              
              <!--- LISTAR -->
              <link rel="stylesheet" type="text/css" media="screen" href="assets\style\table.css" />              

              <table>
                <caption>Contatos</caption>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Apelido</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefones</th>
                    <th scope="col">Ação</th>
                  </tr>
                </thead>
                <tbody>
					 <?php
 
                               /**
                                 *  Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                                 */
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM pessoa inner join telefones on pessoa.id = telefones.pessoa");
                                  
                                    

                                    
                                    $stmt->execute(["id"=>1]);
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

                                            ?><tr>
                                                <td><?php echo $rs->id; ?></td>
                                                <td><?php echo $rs->nome; ?></td>
                                                <td><?php echo $rs->apelido; ?></td>
                                                <td><?php echo $rs->email; ?></td>
                                                <td><?php echo $rs->numero; ?></td>
                                                <td><center>
                                            <a href="?act=upd&id=<?php echo $rs->id; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                                            <a href="?act=del&id=<?php echo $rs->id; ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                                        </center>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            } catch (PDOException $erro) {
                                echo "Erro: " . $erro->getMessage();
                            }

                            ?>
				
				
                </tbody>
              </table>



              <!--- LISTAR -->    
              
              </b-tab-item>
            </b-tabs>
    </section>
    </div>​


        
        <script src='assets/vue.min.js'></script>
        <script src='assets/index.js'></script>
        <script>
            Vue.use(Buefy.default);

                var app = new Vue();
                
                app.$mount('#app');
               
        </script>

<script async type="text/javascript" src="../js/bulma.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {

// Get all "navbar-burger" elements
var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

 // Add a click event on each of them
 $navbarBurgers.forEach(function ($el) {
   $el.addEventListener('click', function () {

     // Get the target from the "data-target" attribute
     var target = $el.dataset.target;
     var $target = document.getElementById(target);

     // Toggle the class on both the "navbar-burger" and the "navbar-menu"
     $el.classList.toggle('is-active');
     $target.classList.toggle('is-active');

   });
 });
}

});
</script>


    </body>
    </html>