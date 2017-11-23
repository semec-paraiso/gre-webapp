<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `reconhecimentos`
 */
class ReconhecimentosFixture extends TestFixture
{
    /**
     * Campos da tabela
     *
     * @var array
     */
    public $fields = [
        'id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'escola_id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'curso' => [
            'type' => 'string',
            'lenght' => 60,
            'null' => false,
        ],
        'ato' => [
            'type' => 'string',
            'lenght' => 60,
            'null' => false,
        ],
        'validade' => [
            'type' => 'date',
            'null' => false,
        ],
        'created' => [
            'type' => 'datetime',
        ],
        'modified' => [
            'type' => 'datetime',
        ],
        'deleted' => [
            'type' => 'integer',
            'null' => false,
        ],
        '_constraints' => [
            'primary' => [
                'type' => 'primary',
                'columns' => ['id'],
            ]
        ]
    ];
    
    /**
     * Conjunto de registros para os testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'escola_id' => 1,
            'curso' => 'CURSO_1',
            'ato' => 'ATO_1',
            'validade' => '2017-11-22',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 2,
            'escola_id' => 1,
            'curso' => 'CURSO_2',
            'ato' => 'ATO_2',
            'validade' => '2017-11-22',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 3,
            'escola_id' => 1,
            'curso' => 'CURSO_3',
            'ato' => 'ATO_3',
            'validade' => '2017-11-22',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 1,
        ),
        array(
            'id' => 4,
            'escola_id' => 2,
            'curso' => 'CURSO_4',
            'ato' => 'ATO_4',
            'validade' => '2017-11-22',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 1,
        ),
    ];
}
