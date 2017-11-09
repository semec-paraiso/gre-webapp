<?php

namespace GRE\Test\Formatting;

use Cake\TestSuite\TestCase;
use GRE\Formatting\Date;

/**
 * Caso de teste para a classe GRE\Formatting\Date
 */
class DateTest extends TestCase
{
    /**
     * Testes para o método brToPhp()
     */
    public function testBrToPhp()
    {
        $this->assertEquals(Date::brToPhp('22/05/1986'), '1986-05-22');
    }
}
