
<?php
// Turn off all error reporting
error_reporting(0);

/*function __autoload($class_name){
    require_once 'classes/' . $class_name . '.php';
}*/
require_once 'classes/Chamado.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bloqueador</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>Contatos</h1>
    <p>Realize aqui o cadastro dos telefones permitidos no aplicativo bloqueador.</p>
</div>
<a href='index.php?acao=sair'>Sair</a>
<div class="col-md-6 col-md-offset-3">
    <?php
    $chamado = new Chamado();

    if(isset($_GET['cadastrar'])){
        $nome = $_GET['form-name'];
        $telefone = $_GET['form-telefone'];


        $chamado->setNome($nome);
        $chamado->setTelefone($telefone);


        $confirma = $chamado->insert();
        if($confirma==1){
            echo 'inserido com sucesso';
        }else{
            echo "Erro: Houve uma falha ao inserir o registro na base de dados. " . " <br> " . " Por favor, contatar o suporte.";
        }
    }

    if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){
        $id = $_GET['id'];
        if($chamado->deletar($id)){
            echo "registro deletado com sucesso";
        };
    }


    if(isset($_GET['atualizar'])){
        $id = $_GET['id'];
        $nome = $_GET['form-name'];
        $telefone = $_GET['form-telefone'];

        $chamado->setNome($nome);
        $chamado->setTelefone($telefone);

        if($chamado->update($id)){
            echo "Registro atualizado com sucesso";
        }else{
            echo "Erro: Houve uma falha ao atualizar o registro na base de dados. " . " <br> " . " Por favor, contatar o suporte.";
        }

    }
    ?>


    <?php

    $user;
    $senha; 





	if (isset($_GET['acao']) && $_GET['acao'] == 'sair') {
        $user = '0';
	}


	if ($_GET['login'] == 'login') {
		
		$user = $_GET['form-user'];
		$senha = $_GET['form-Senha'];

		$cont = 0;
        $chamado->validaLogin($user, $senha);

	    foreach($chamado->validaLogin($user, $senha) as $val) {
	        $cont = $val['cont'];
	    }

	    if ($cont > 0) {
	    	$user = $_GET['form-user'];
	    }else{
	    	echo "ATENÇÃO! usuário ou senha inválidos!";
	    	$user = '0';
	    }


	}

    if($user == '0' || !isset($user)){
    	
    	//echo "faz o login menino!";

	?>
    <form action="" id="login-form" class="form-horizontal" role="form" method="get">
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Login</label>

            <div class="col-lg-10">
                <input type="text" class="form-control required" id="user" name="form-user" placeholder="Login"/>
            </div>
        </div>

        <div class="form-group">
            <label for="tel" class="col-lg-2 control-label">Senha</label>

            <div class="col-lg-10">
                <input type="tel" class="form-control" id="senha" name="form-Senha" placeholder="Senha">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-success" name="login" id="login" value="login">Entrar</button>
            </div>
        </div>
    </form>
    <br><br><br>


	<?php
    }else if(isset($_GET['acao']) && $_GET['acao']== 'editar'){
            $id = $_GET['id'];
            $chamado->findId($id);

            foreach($chamado->findId($id) as $val) {
                $id = $val['id'];
                $nome = $val['nome'];
                $telefone = $val['telefone'];
            }
    ?>
            <form action="" id="contact-form" class="form-horizontal" role="form" method="get">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Nome</label>
                    <div class="col-lg-10">
                        <input type="text" value="<?php echo $nome; ?>" class="form-control required" id="name" name="form-name" placeholder="Nome" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Telefone</label>
                    <div class="col-lg-10">
                        <input type="tel" value="<?php echo $telefone; ?>" class="form-control required" id="telefone" name="form-telefone" placeholder="Telefone" />
                    </div>
                </div>
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-block" name="atualizar">Atualizar</button>
                    </div>
                </div>
            </form>
            <table class="table table-hover">

		        <thead>
		        <tr>
		            <th>#</th>
		            <th>Nome:</th>
		            <th>Telefone:</th>

		        </tr>
		        </thead>
		        <?php
		        foreach($chamado->findall() as $value): ?>
		            <tbody>
		            <tr>
		                <td><?php echo ($value['id']); ?></td>
		                <td><?php echo ($value['nome']); ?></td>
		                <td><?php echo ($value['telefone']); ?></td>
		                <td>
		                    <?php echo "<a href='index.php?acao=editar&id=" . $value['id'] . "' >editar</a>"; ?>
		                    <?php echo "<a href='index.php?acao=deletar&id=" . $value['id'] . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
		                </td>
		            </tr>
		            <?php endforeach; ?>
		            </tbody>
		    </table>
    <?php
        }else {
            ?>


            <form action="" id="contact-form" class="form-horizontal" role="form" method="get">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Nome</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control required" id="name" name="form-name" placeholder="Nome"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tel" class="col-lg-2 control-label">Telefone</label>

                    <div class="col-lg-10">
                        <input type="tel" class="form-control" id="telelefone" name="form-telefone" placeholder="Telefone">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-success" name="cadastrar">Enviar</button>
                    </div>
                </div>
            </form>
            <br><br><br>
		    <table class="table table-hover">

		        <thead>
		        <tr>
		            <th>#</th>
		            <th>Nome:</th>
		            <th>Telefone:</th>

		        </tr>
		        </thead>
		        <?php
		        foreach($chamado->findall() as $value): ?>
		            <tbody>
		            <tr>
		                <td><?php echo ($value['id']); ?></td>
		                <td><?php echo ($value['nome']); ?></td>
		                <td><?php echo ($value['telefone']); ?></td>
		                <td>
		                    <?php echo "<a href='index.php?acao=editar&id=" . $value['id'] . "' >editar</a>"; ?>
		                    <?php echo "<a href='index.php?acao=deletar&id=" . $value['id'] . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
		                </td>
		            </tr>
		            <?php endforeach; ?>
		            </tbody>
		    </table>
        <?php
        }
    ?>
</div>
</body>
</html>