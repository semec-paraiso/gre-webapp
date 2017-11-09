<?php

namespace GRE\Test\Formatting;

use Cake\TestSuite\TestCase;
use GRE\Formatting\Masker;

/**
 * Caso de teste para a classe GRE\Formatting\Masker
 */
class MaskerTest extends TestCase
{
    public function testMask()
    {
        $this->assertEquals(Masker::mask('00000000000', '###.###.###-##'), '000.000.000-00');
        $this->assertEquals(Masker::mask('00000000', '#####-###'), '00000-000');
    }
}
