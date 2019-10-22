<?php 
	require __DIR__ . "/source/model/dao/database/database.php";

	var_dump(Database::getInstance());
	echo '<br>' . Database::getError()->getMessage();
