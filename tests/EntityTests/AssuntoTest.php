<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ppo\Model\Entity\Assunto;
use Ppo\Model\Entity\Disciplina;

class AssuntoTest extends TestCase
{
    public function testAddAssunto(): void
    {
        $disciplina = new Disciplina(12, 'math', array());
        $assunto = new Assunto(11, 'calculus', $disciplina, array());

        $disciplina->addAssunto($assunto);

        $this->assertContains($assunto, $disciplina->getAssuntos());
    }
}