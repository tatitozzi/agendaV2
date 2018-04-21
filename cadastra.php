<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastrar .:. Listar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets/style/buefy.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets/style/bulma-docs.min.css" />
        <link rel="stylesheet" href="assets/style/sweet-alert.css">
        <script src="assets/js/sweet-alert.js"></script>
        <script src="assets/js/navbar.js"></script>
        <script src="assets/js/jquery-1.9.1.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="assets/style/table.css" />
        <script type="text/javascript" src="assets/js/vueStart.js"></script>
        <script src='assets/js/vue.min.js'></script>
        <script src='assets/js/index.js'></script>    
                  
</head>


<header>
<nav class="navbar is-transparent">
    <div class="navbar-brand">
      <a class="navbar-item" href="index.html">
        <img src="assets/images/contato.png" alt="Agenda" width="150">
      </a>
      <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  
    <div id="navbarExampleTransparentExample" class="navbar-menu">
      <div class="navbar-start">
        <!--
        <a class="navbar-item" href="/">
          Início
        </a>
      -->
      
        <div class="navbar-item has-dropdown is-hoverable">
      <!--
          <a class="navbar-link" href="/">
            Contatos
          </a>
          <div class="navbar-dropdown is-boxed">
            <a class="navbar-item" href="cadastra.html">
              Cadastrar
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" href="cadastra.html">
              Listar
            </a>
          </div>
        -->
        </div>
      </div>
  
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="field is-grouped">
            <p class="control">
              <a class="bd-tw-button button" href="cadastra.php#listar">
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
                <a class="bd-tw-button button" href="cadastra.php#cadastra">
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
</header>
<!-- FINAL CABEÇALHO -->

<?php
require_once 'crud.php'; // Inclui o arquivo do crud
?>

<body>
<!--Início TAB -->
<div id="app" class="container is-fluid">

<section>
  <b-tabs position="is-centered" class="block">
      <b-tab-item label="Cadastrar">
        
      <h3 id="cadastra" class="title is-4 is-spaced bd-anchor-title">
        <span class="bd-anchor-name">
          Novo cadastro
        </span>
        <a class="bd-anchor-link" href="#cadastra">
        </a>
      </h3> 

<div id="app" class="container">
  <section class="is-fluid">

  <!--- CADASTRAR -->
  <div class="row is-fluid">
    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
      <div class="panel panel-default">
      <!--VALUE recebe valor que está no BD (editar)  -->
      <div class="is-fluid">
          <input type="hidden" name="id" value="<?php
            echo (isset($id) && ($id != null || $id != "")) ? $id : ''; ?>" />
                
      <div class="form-group">
          <label for="nome label" class="label git is-normal">Nome: </label>
          <b-field> 
            <input type="text" name="nome" placeholder="Nome" value="<?php
              echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : ''; ?>" class="input" required />
              
          </b-field> 
          <label for="apelido" class="label git is-normal">Apelido: </label>
          <div class="col-md-4">
              <input type="text" name="apelido" value="<?php
                echo (isset($apelido) && ($apelido != null || $apelido != "")) ? $apelido : ''; ?>" class="input" required/>
          </div>
      </div>
      
      <div class="form-group">
          <label for="email" class="label git is-normal">E-mail: </label>
          <div class="col-md-4">
              
              <input type="email" name="email" value="<?php
              echo (isset($email) && ($email != null || $email != "")) ? $email : '';?>" class="input" required />
              
      </div>
          <label for="numero" class="label git is-normal">Telefones: </label>
          <div class="field is-grouped">
              <input type="tel" name="numero" value="<?php
               echo (isset($numero) && ($numero != null || $numero != "")) ? $numero : ''; ?>" class="input" placeholder="XXX-XXX-XXX" maxlength="15" required />
              <p class="control">
                <a class="button is-info is-primary" disabled>+</a>
              </p>
          </div>
          <br>
      </div>
    </div>
          <div class="field is-grouped-left">
            <div class="clearfix">
                <div class="control">
                  <button type="submit" class="button is-primary" /> Salvar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
  <!--- FINAL CADASTRAR -->
</section>
</div>

      </b-tab-item>
        <b-tab-item label="Listar">
      
      <!--- LISTAR -->
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
    <?php //READ - pega os dados do BD e mostra na tabela
      try {
          $stmt = $conexao->prepare("SELECT * FROM pessoa");
          $stmt->execute(["id"=>1]);
          if ($stmt->execute()) {
              while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {?>
              <tr>
                <td><?php echo $rs->id; ?></td>
                <td><?php echo $rs->nome; ?></td>
                <td><?php echo $rs->apelido; ?></td>
                <td><?php echo $rs->email; ?></td>
                <td><?php echo $rs->numero; ?></td>
                <td><center>

                  <a href="?act=upd&id=<?php echo $rs->id;?>" class="button is-success"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                  <a href="?act=del&id=<?php echo $rs->id; ?>" onclick="return confirm('Deseja excluir?')" class="button is-danger is-outlined" ><span class="delete-forever"></span> Excluir</a>
              </center>
              </td>
              </tr>
              <?php
          }
      } else {//atualizar para SWEET ALERT
         // echo "Erro: Não foi possível recuperar os dados do banco de dados";
             echo "<script>
             alert ('Não foi possível recuperar os dados do banco de dados');
           </script>";
      }
    } catch (PDOException $erro) {
      echo "Erro: " . $erro->getMessage();
    }?>


    </tbody>
    </table>
      <!--- LISTAR -->    
      
      </b-tab-item>
    </b-tabs>
</section>
</div>
<!--Final TAB -->

  <script>
    //Habilita função do TAB
    Vue.use(Buefy.default)
    const app = new Vue()
    app.$mount('#app')
  </script>
  
  <script type="text/javascript">
$(window).load(function(){

$("#btnShowAlert").click(function() {
    sweetAlert(
        "Teste!", "Funciona!", "success"
    );
});

});

</script>
 
  <a id="btnShowAlert">
    Teste SweetAlert
</a>

</body>
<footer class="hero is-medium">
            <div class="container ">
              <div class="content has-text-centered">
                <p>
                  <strong>Optativa II - Utilização de Tecnologia emergentes no desenvolvimento de aplicações cliente servidor modernas</strong> - BSI/15
                </p>
              </div>
            </div>
          </div>  
          </footer>
</html>