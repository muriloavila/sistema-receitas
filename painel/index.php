<?php
require_once '..\system\config.php';
require_once '..\system\database.php';

    session_start();
        if(!isset($_SESSION['login']) == true)
        header('Location:../index.php');
    else
    if(isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['action']) && !empty($_GET['id']) ){
        $id = DBEscape(strip_tags(trim($_GET['id'])));
        echo $_GET['action'];
        switch($_GET['action']){
            case 1:
                DBUpDate('receitas', array('status' => 1), "id = '{$id}'");

                break;
            case 2:
                DBUpDate('receitas', array('status' => 0), "id = '{$id}'");

                break;
            case 3:
                DBDelete('receitas', "id = '{$id}'");
                break;
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Gerenciar Postagens</title>
</head>

<body>
	
	<h2>
		Gerenciar Postagens | <a href="add-post.php" title="Adicionar">Adicionar</a> |
        <a href="../index.php" title="Voltar a Pagina Principal">Voltar a Pagina Principal</a>

	</h2>
    <?php
        $posts = DBRead('receitas', 'ORDER BY data DESC');
        if(!$posts)
            echo "<h2>Nenhuma Postagem Encontrada</h2>";
        else
            foreach($posts as $post):
    ?>
	<hr>
	<h2>
		<a href="..single.php?id=<?php echo $post['id']; ?>" title='#'>
			<?php echo $post['titulo']; ?>
		</a>
	</h2>

	<p>
		por <b><?php echo $post['autor']; ?></b>
		em <b><?php echo date('d/m/Y', strtotime($post['data'])); ?></b> |
		Visitas <b><?php echo $post['visitas']; ?></b>
        Categoria<b><?php echo $post['categoria']; ?></b>
	</p>

	<p>
        <?php if(!$post['status']){
            echo '<a href="?action=1&&id='.$post['id'].'"title="Ativar">Ativar</a> |';
        } else {
            echo '<a href="?action=2&&id='.$post['id'].'" title="Desativar">Desativar</a> |';
        }?>
		<a href="edit-post.php?id=<?php echo $post['id']?>" title="Editar">Editar</a> |
		<a href="?action=3&&id=<?php echo $post['id'];  ?>" title="Deletar">Deletar</a>
	</p>
<?php endforeach; ?>
</body>
</html>