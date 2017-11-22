<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `escola_locais`
 */
class EscolaLocaisFixture extends TestFixture
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
        'nome' => [
            'type' => 'string',
            'lenght' => 100,
            'null' => false,
        ],
        'escola_local_tipo_id' => [
            'type' => 'integer',
            'null' => false,
        ],
        'predio_ocupacao_forma_id' => [
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
     * Conjunto de registros para os testes
     *
     * @var array
     */
    public $records = [
        array(
            'id' => 1,
            'escola_id' => 1,
            'nome' => 'NOME_1',
            'escola_local_tipo_id' => 1,
            'predio_ocupacao_forma_id' => 1,
            'created' => '2017-11-21 00:00:00',
            'modified' => '2017-11-21 00:00:00',
            'deleted' => 0,  
        ),
        array(
            'id' => 2,
            'escola_id' => 1,
            'nome' => 'NOME_2',
            'escola_local_tipo_id' => 2,
            'predio_ocupacao_forma_id' => 2,
            'created' => '2017-11-21 00:00:00',
            'modified' => '2017-11-21 00:00:00',
            'deleted' => 1,  
        ),
        array(
            'id' => 3,
            'escola_id' => 1,
            'nome' => 'NOME_3',
            'escola_local_tipo_id' => 3,
            'predio_ocupacao_forma_id' => 3,
            'created' => '2017-11-21 00:00:00',
            'modified' => '2017-11-21 00:00:00',
            'deleted' => 0,  
        ),
        array(
            'id' => 4,
            'escola_id' => 2,
            'nome' => 'NOME_4',
            'escola_local_tipo_id' => 1,
            'predio_ocupacao_forma_id' => 1,
            'created' => '2017-11-21 00:00:00',
            'modified' => '2017-11-21 00:00:00',
            'deleted' => 0,  
        ),
        array(
            'id' => 5,
            'escola_id' => 2,
            'nome' => 'NOME_5',
            'escola_local_tipo_id' => 1,
            'predio_ocupacao_forma_id' => 1,
            'created' => '2017-11-21 00:00:00',
            'modified' => '2017-11-21 00:00:00',
            'deleted' => 0,  
        ),
    ];
}
