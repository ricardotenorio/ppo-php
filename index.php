<?php 
	require __DIR__ . "/vendor/autoload.php";

	use Ppo\Model\Repository\DisciplinaRepository;
	use Ppo\Model\Repository\AssuntoRepository;
	use Ppo\Model\Repository\UsuarioRepository;
	use Ppo\Model\Repository\ListaRepository;
	use Ppo\Model\Repository\PostagemRepository;
	use Ppo\Model\Repository\PermissaoRepository;
	use Ppo\Model\Entity\Permissao;
	use Ppo\Model\Entity\Disciplina;
	use Ppo\Model\Entity\AbstractEntity;
	use Ppo\Model\Entity\Assunto;
	use Ppo\Model\Entity\Usuario;
	use Ppo\Model\Entity\Lista;
	use Ppo\Model\Entity\Postagem;
	
	$arep = new AssuntoRepository();
	$drep = new DisciplinaRepository();	
	
	$disciplina = $drep->searchById(2);
	$assunto = new Assunto(null, "functions", $disciplina, array());
	//$assunto2 = new Assunto(null, "variables", $disciplina, array());

	$assunto = $arep->searchByNome("functions");
	
	//$drep->save($disciplina);

	$prep = new PermissaoRepository();
	//$permissao = new Permissao(null, "admin", array());
	//$prep->save($permissao);
	$permissao = $prep->searchByNome("admin");
	
	$urep = new UsuarioRepository();
	//$usuario = new Usuario(null, "admin", "admin@admin.com", "1234", null, $permissao);
	//$urep->save($usuario);
	$usuario = $urep->searchById(1);

	$posrep = new PostagemRepository();
	$postagem = new Postagem(null, "video", "youtube.com", "test", "just a test", 0, null, $usuario, $assunto);
	//$posrep->save($postagem);
	$postagem2 = new Postagem(null, "video", "youtube.com", "test n2", "just another test", 0,
		null, $usuario, $assunto);
	//$posrep->save($postagem2);

	$postagem = $posrep->searchById(5);
	$postagem2 = $posrep->searchById(6);

	$lrep = new ListaRepository();
	$lista = $lrep->searchById(11);

	//$lista = $lrep->searchById(1);
	$lista->removePostagem($postagem);
	$lista->addPostagem($postagem2);
	//echo '<pre>' , var_dump($lista) , '<pre>';
	$lrep->save($lista);
	
	//$lrep->save($lista);