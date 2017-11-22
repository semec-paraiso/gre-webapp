<?php

namespace GRE\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture para a tabela `escola_situacoes`
 */
class EscolaSituacoesFixture extends TestFixture
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
            'lenght' => 30,
        ],
        'descricao' => [
            'type' => 'text',
        ],
        '_webapp_css_class' => [
            'type' => 'string',
            'lenght' => 20,
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
            'ordem' => 1,
            'nome' => 'NOME_1',
            'descricao' => 'DESC_1',
            '_webapp_css_class' => 'CSS_1',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 2,
            'ordem' => 3,
            'nome' => 'NOME_2',
            'descricao' => 'DESC_2',
            '_webapp_css_class' => 'CSS_2',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 0,
        ),
        array(
            'id' => 3,
            'ordem' => 4,
            'nome' => 'NOME_3',
            'descricao' => 'DESC_3',
            '_webapp_css_class' => 'CSS_3',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 1,
        ),
        array(
            'id' => 4,
            'ordem' => 2,
            'nome' => 'NOME_4',
            'descricao' => 'DESC_4',
            '_webapp_css_class' => 'CSS_4',
            'created' => '0000-00-00 00:00:00',
            'modified' => '0000-00-00 00:00:00',
            'deleted' => 0,
        ),
    ];
}
