<?php

namespace GRE\Model\Table;

/**
 * Repositório EscolaLocalTipos
 * 
 */
class EscolaLocalTiposTable extends Table
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
     * Obtém os tipos de local de funcionamento da escola
     * 
     * @return array Array formatado para popular selects
     */
    public function getList()
    {
        return $this->find('list', [
            'fields' => [
                'EscolaLocalTipos.id',
                'EscolaLocalTipos.ordem',
                'EscolaLocalTipos.nome',
            ],
            'order' => [
                'EscolaLocalTipos.ordem',
            ],
        ])->toArray();
    }
}
