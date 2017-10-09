<?php

namespace GRE\Model\Table;

class EscolasTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->belongsTo('EscolaSituacoes', [
            'foreignKey' => 'situacao_id',
            'propertyName' => 'escola_situacao',
        ]);
    }
    
    public function listar()
    {
        return $this->find('all', [
            'contain' => [
                'EscolaSituacoes',
            ],
            'order' => [
                'Escolas.nome_curto ASC',
            ]
        ]);
    }
}
