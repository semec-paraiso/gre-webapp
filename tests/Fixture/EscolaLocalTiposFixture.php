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
            'nome' => 'Prédio escolar',
        ),
        array(
            'id' => 2,
            'ordem' => 4,
            'nome' => 'Salas de Empresa',
        ),
        array(
            'id' => 3,
            'ordem' => 1,
            'nome' => 'Casa do professor',
        ),
        array(
            'id' => 4,
            'ordem' => 3,
            'nome' => 'Outros',
        ),
    ];
}
