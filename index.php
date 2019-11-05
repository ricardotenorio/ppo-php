<?php 
	require __DIR__ . "/vendor/autoload.php";

	use Ppo\Model\Repository\DisciplinaRepository;
	use Ppo\Model\Entity\Disciplina;
	use Ppo\Model\Entity\AbstractEntity;

	//echo var_dump($disciplina->getData()) . "<br><br>";
	
	
	$drep = new DisciplinaRepository();
	
	
	$disciplina = $drep->searchById(1);
	$drep->delete($disciplina);
	
	echo var_dump($disciplina) . "<br>";
	
	//$drep->save($disciplina);