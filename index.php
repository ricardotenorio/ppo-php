<?php 
	require __DIR__ . "/vendor/autoload.php";

	use Ppo\Model\Repository\DisciplinaRepository;
	use Ppo\Model\Repository\AssuntoRepository;
	use Ppo\Model\Entity\Disciplina;
	use Ppo\Model\Entity\AbstractEntity;
	use Ppo\Model\Entity\Assunto;

	/*echo var_dump($disciplina->getData()) . "<br><br>";
	
	$arep = new AssuntoRepository();
	$drep = new DisciplinaRepository();	
	
	$disciplina = $drep->searchById(2);
	$assunto = new Assunto(null, "functions", $disciplina, array());
	$assunto2 = new Assunto(null, "variables", $disciplina, array());

	//$arep->save($assunto);
	//$arep->save($assunto2);

	$assuntos = $arep->searchByDisciplina($disciplina);

	echo '<pre>', var_dump($assuntos) , '<pre>';
	
	//$drep->save($disciplina);
	*/

	var_dump(date('Y-m-d'));