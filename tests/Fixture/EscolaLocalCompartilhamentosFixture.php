<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `escola_local_compartilhamentos`
 */
class EscolaLocalCompartilhamentosFixture extends TestFixture
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
        'escola_local_id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'escola_id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'created' => [
            'type' => 'datetime',
            'null' => false,
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
            ],
        ],
    ];
    
    /**
     * Conjunto de registros para testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'escola_local_id' => 1,
            'escola_id' => 2,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 0,
        )
    ];
}
