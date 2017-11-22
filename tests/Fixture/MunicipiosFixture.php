<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `municipios`
 */
class MunicipiosFixture extends TestFixture
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
        'uf_id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'inep_codigo' => [
            'type' => 'integer',
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
     * Registros a serem considerados nos testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'uf_id' => 1,
            'inep_codigo' => 11111,
            'nome' => 'NOME_1',
        ),
        array(
            'id' => 2,
            'uf_id' => 3, 
            'inep_codigo' => 22222,
            'nome' => 'NOME_2',
        ),
        array(
            'id' => 3,
            'uf_id' => 2,
            'inep_codigo' => 33333,
            'nome' => 'NOME_3',
        ),
        array(
            'id' => 4,
            'uf_id' => 2, 
            'inep_codigo' => 44444,
            'nome' => 'NOME_4',
        ),
        array(
            'id' => 5,
            'uf_id' => 2, 
            'inep_codigo' => 55555,
            'nome' => 'NOME_5',
        ),
    ];
}
