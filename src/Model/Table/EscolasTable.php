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
    
    public function listar(array $options = [])
    {
        $result = $this->find('all', [
            'contain' => [
                'EscolaSituacoes',
            ],
            'order' => [
                'Escolas.nome_curto ASC',
            ]
        ]);
        
        if (isset($options['search']['nome'])) {
            $result = $this->_filterResult($result, 'Escolas.nome_longo', $options['search']['nome']);
        }
        
        return $result;
    }
}
