<?php

namespace GRE\Model\Table;

/**
 * Repositório `EscolaLocalCompartilhamentos`
 */
class EscolaLocalCompartilhamentosTable extends Table
{
    /**
     * Filtros aplicáveis
     *
     * @var array
     */
    protected $_filters = [
        'escola_local_id' => 0,
    ];

    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config = [])
    {
        parent::initialize($config);

        $this->belongsTo('Escolas');
    }

}
