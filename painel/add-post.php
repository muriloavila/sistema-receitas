<?php
require_once '..\system\config.php';
require_once '..\system\database.php';

    session_start();
    if(!isset($_SESSION['login']) == true)
        header('Location:../index.php');
    else
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Adicionar Postagem</title>
</head>

<body>
	
	<h2>
		Adicionar Postagem | <a href="index.php" title="Voltar">Voltar</a>
	</h2>
	<hr>
    <?php
        if(isset($_POST['publicar'])){
            $form = array(
                'titulo'    => DBEscape(strip_tags(trim($_POST['titulo']))),
                'autor'     => DBEscape(strip_tags(trim($_POST['autor']))),
                'categoria' => DBEscape(strip_tags(trim($_POST['categoria']))),
                'status'    => DBEscape(strip_tags(trim($_POST['status']))),
                'data'      => date('Y:m:d H:i:s'),
                'conteudo'  => str_replace('\r\n', "\n", DBEscape(strip_tags(trim($_POST['conteudo']))))
            );

            if(empty($form['titulo'])){ echo "Preencha o campo Titulo";
            } elseif(empty($form['autor'])){ echo "Preencha o campo Autor";
            } elseif(empty($form['categoria'])){ echo "Preencha o campo Categoria";
            } elseif(empty($form['status'])) { echo "Preencha o campo Status";
            } elseif(empty($form['conteudo'])) { echo "Preencha o campo Conteudo";
            } else {
                $dbcheck = DBRead('receitas', "WHERE titulo = '{$form['titulo']}'");
                if($dbcheck){
                    echo "Desculpe mas ja exite uma receita com este Nome";
                } else {
                    if(DBCreate('receitas', $form)){
                        echo "Receita Salva com Sucesso";
                    } else {
                        echo "Desculpa mas ocorreu um erro";
                    }
                }
            }
        }
    ?>
	<form action="" method="post">

		<p>
			<label>Titulo</label><br>
			<input type="text" name="titulo">
		</p>

		<p>
			<label>Autor</label><br>
			<input type="text" name="autor">
		</p>

        <p>
            <label>Catgoria</label><br>
            <input type="text" name="categoria">
        </p>

		<p>
			<label>Status</label><br>
			
			<select name="status">
				<option value="1" selected>Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</p>

		<p>
			<label>Conteúdo</label><br>
			<textarea name="conteudo" cols="50" rows="15"></textarea>
		</p>

		<input type="submit" name="publicar" value="Publicar">
		
	</form>

</body>
</html>