<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `predio_ocupacao_formas`
 */
class PredioOcupacaoFormasFixture extends TestFixture
{
    /**
     * Campos da tabela
     *
     * @var array
     */
    public $fields = [
        'id' => [
            'type' => 'integer',
        ],
        'ordem' => [
            'type' => 'integer',
        ],
        'nome' => [
            'type' => 'string',
            'lenght' => 40,
        ],
        'created' => [
            'type' => 'datetime',
        ],
        'modified' => [
            'type' => 'datetime',
        ],
        'deleted' => [
            'type' => 'integer',
        ],
        '_constraints' => [
            'primary' => [
                'type' => 'primary',
                'columns' => ['id'],
            ]
        ]
    ];
    
    /**
     * Conjunto de registros para testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'ordem' => 3,
            'nome' => 'NOME_1',
            'created' => '2017-11-19 15:01:01',
            'created' => '2017-11-19 15:01:01',
            'deleted' => 0,
        ),
        array(
            'id' => 2,
            'ordem' => 2,
            'nome' => 'NOME_2',
            'created' => '2017-11-19 15:02:02',
            'created' => '2017-11-19 15:02:02',
            'deleted' => 0,
        ),
        array(
            'id' => 3,
            'ordem' => 1,
            'nome' => 'NOME_3',
            'created' => '2017-11-19 15:03:03',
            'created' => '2017-11-19 15:03:03',
            'deleted' => 1,
        ),
        array(
            'id' => 4,
            'ordem' => 1,
            'nome' => 'NOME_4',
            'created' => '2017-11-19 15:03:03',
            'created' => '2017-11-19 15:03:03',
            'deleted' => 0,
        ),
    ];
}
