<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `distritos`
 */
class DistritosFixture extends TestFixture
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
        'municipio_id' => [
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
            'municipio_id' => 1, // Rio Branco (AC)
            'inep_codigo' => 11111,
            'nome' => 'Rio Branco',
        ),
        array(
            'id' => 2,
            'municipio_id' => 3, // Palmas (TO)
            'inep_codigo' => 22222,
            'nome' => 'Palmas',
        ),
        array(
            'id' => 3,
            'municipio_id' => 3, // Palmas (TO)
            'inep_codigo' => 33333,
            'nome' => 'Buritirana',
        ),
        array(
            'id' => 4,
            'municipio_id' => 3, // Palmas (TO)
            'inep_codigo' => 44444,
            'nome' => 'Taquaruçu',
        ),
    ];
}
