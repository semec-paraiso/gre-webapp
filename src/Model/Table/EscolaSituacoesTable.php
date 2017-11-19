<?php

namespace GRE\Model\Table;

/**
 * Repositório da entidade EscolaSituacao
 * 
 */
class EscolaSituacoesTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setDisplayField('nome');
    }
    
    /**
     * Obtém a lista de situações de funcionamento possíveis para a escola
     * ordenada pela campo `ordem`, excluindo-se os registros marcados como
     * `true` no campo `deleted`
     * 
     * @return array Array para popular select
     */
    public function getList() : array
    {
        return $this->find('list', [
            'fields' => [
                'EscolaSituacoes.id',
                'EscolaSituacoes.ordem',
                'EscolaSituacoes.nome',
                'EscolaSituacoes.deleted',
            ],
            'order' => [
                'EscolaSituacoes.ordem',
            ],
            'conditions' => [
                'EscolaSituacoes.deleted' => false,
            ],
        ])->toArray();
    }
}
