<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `ufs`
 */
class UfsFixture extends TestFixture
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
        'inep_codigo' => [
            'type' => 'integer',
        ],
        'sigla' => [
            'type' => 'string',
            'lenght' => 2,
            'null' => false,
        ],
        'nome' => [
            'type' => 'string',
            'lenght' => 100,
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
     * Registros para testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'inep_codigo' => 11,
            'sigla' => 'S1',
            'nome' => 'NOME_1',
        ),
        array(
            'id' => 2,
            'inep_codigo' => 22,
            'sigla' => 'S2',
            'nome' => 'NOME_2',
        ),
        array(
            'id' => 3,
            'inep_codigo' => 33,
            'sigla' => 'S3',
            'nome' => 'NOME_3',
        ),
    ];
}
