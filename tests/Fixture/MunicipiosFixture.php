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
            'uf_id' => 1, // Acre
            'inep_codigo' => 11111,
            'nome' => 'Rio Branco',
        ),
        array(
            'id' => 2,
            'uf_id' => 3, // Amazonas
            'inep_codigo' => 22222,
            'nome' => 'Manaus',
        ),
        array(
            'id' => 3,
            'uf_id' => 2, // Tocantins
            'inep_codigo' => 33333,
            'nome' => 'Palmas',
        ),
        array(
            'id' => 4,
            'uf_id' => 2, // Tocantins
            'inep_codigo' => 4444,
            'nome' => 'Gurupi',
        ),
        array(
            'id' => 5,
            'uf_id' => 2, // Tocantins
            'inep_codigo' => 55555,
            'nome' => 'Araguaína',
        ),
    ];
}
