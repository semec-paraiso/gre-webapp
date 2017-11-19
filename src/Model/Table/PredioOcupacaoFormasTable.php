<?php

namespace GRE\Model\Table;

/**
 * Repositório PredioOcupacaoFormas
 * 
 */
class PredioOcupacaoFormasTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->setDisplayField('nome');
    }
    
    /**
     * Obtém a lista de formas de ocupação de prédio escolar ordenado pelo campo
     * `nome`, excluindo os registro cujo campo `deleted` tiver o valor `true`
     * 
     * @return array Array para popular selects
     */
    public function getList()
    {
        return $this->find('list', [
            'fields' => [
                'PredioOcupacaoFormas.id',
                'PredioOcupacaoFormas.ordem',
                'PredioOcupacaoFormas.nome',
                'PredioOcupacaoFormas.deleted',
            ],
            'order' => [
                'PredioOcupacaoFormas.ordem',
            ],
            'conditions' => [
                'PredioOcupacaoFormas.deleted' => false,
            ],
        ])->toArray();
    }
}
