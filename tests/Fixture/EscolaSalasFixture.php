<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `escola_salas`
 */
class EscolaSalasFixture extends TestFixture
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
        'nome' => [
            'type' => 'string',
            'lenght' => 20,
            'null' => false,
        ],
        'capacidade' => [
            'type' => 'integer',
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
     * Conjunto de dados para testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'escola_local_id' => 1,
            'nome' => 'NOME_1',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 2,
            'escola_local_id' => 1,
            'nome' => 'NOME_2',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 1,
        ),
        array(
            'id' => 3,
            'escola_local_id' => 2,
            'nome' => 'NOME_3',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 4,
            'escola_local_id' => 2,
            'nome' => 'NOME_4',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 1,
        ),
        array(
            'id' => 5,
            'escola_local_id' => 4,
            'nome' => 'NOME_5',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 6,
            'escola_local_id' => 4,
            'nome' => 'NOME_6',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 1,
        ),
        array(
            'id' => 7,
            'escola_local_id' => 5,
            'nome' => 'NOME_7',
            'capacidade' => 30,
            'created' => '2017-11-22 00:00:00',
            'modified' => '2017-11-22 00:00:00',
            'deleted' => 0,
        ),
    ];
}
