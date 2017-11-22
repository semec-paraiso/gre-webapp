<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `escola_local_tipos`
 */
class EscolaLocalTiposFixture extends TestFixture
{
    /**
     * Campos ta tabela
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
            'lenght' => 60,
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
            'ordem' => 2,
            'nome' => 'NOME_1',
        ),
        array(
            'id' => 2,
            'ordem' => 4,
            'nome' => 'NOME_2',
        ),
        array(
            'id' => 3,
            'ordem' => 1,
            'nome' => 'NOME_3',
        ),
        array(
            'id' => 4,
            'ordem' => 3,
            'nome' => 'NOME_4',
        ),
    ];
}
