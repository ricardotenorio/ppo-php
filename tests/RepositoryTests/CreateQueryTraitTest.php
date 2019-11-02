<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CreateQueryTraitTest extends TestCase
{
    use Ppo\Model\Repository\CreateQueryTrait;

    public function testValidInsertQuery(): void
    {
        $entityName = 'usuario';
        $data = array('id' => 1, 'nome' => 'test', 'email' => 'test@test.com', 'senha' => '$$$$', 'data_criacao' => '01-01-1970', 'permissao_id' => 1);
        $query = 'INSERT INTO usuario (nome, email, senha, data_criacao, permissao_id) VALUES (:nome, :email, :senha, :data_criacao, :permissao_id)';
        
        $this->assertEquals($query, $this->insertQuery($entityName, $data));
    }

    public function testValidDeleteQuery(): void
    {
        $entityName = 'permissao';
        $conditions = array('id' => 1,'nome' => 'admin');
        $query = 'DELETE FROM permissao WHERE id = :id AND nome = :nome';

        $this->assertEquals($query, $this->deleteQuery($entityName, $conditions));
    }

    public function testValidUpdateQuery(): void
    {
        $entityName = 'permissao';
        $data = array('nome' => 'admin');
        $conditions = array('id' => 12);
        $query = 'UPDATE permissao SET nome = :nome';
        $query2 = $query . ' WHERE id = :id';

        $this->assertEquals($query, $this->updateQuery($entityName, $data, array()));
        $this ->assertEquals($query2, $this->updateQuery($entityName, $data, $conditions));
    }

    public function testValidSelectQuery(): void
    {
        $entityName = 'permissao';
        $joinTables = array('usuario' => array('permissao.id', 'usuario.id'));
        $conditions = array('permissao.id' => 1);
        $query = 'SELECT permissao.* FROM permissao';
        $query2 = $query . ' JOIN usuario ON permissao.id = usuario.id';
        $query3 = $query2 . ' WHERE permissao.id = :permissao.id';

        $this->assertEquals($query, $this->selectQuery($entityName));
        $this->assertEquals($query2, $this->selectQuery($entityName, $joinTables));
        $this->assertEquals($query3, $this->selectQuery($entityName, $joinTables, $conditions));
    }
}