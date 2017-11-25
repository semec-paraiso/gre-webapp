<?php

namespace GRE\Model\Table;

use Cake\ORM\Query;

/**
 * Repositório da entidade Distrito
 * 
 */
class DistritosTable extends Table
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
        
        $this->belongsTo('Municipios');
    }
    
    /**
     * Retorna a relação de Distritos relacionados ao município especificado
     * 
     * @param int $municipioId
     * 
     * @return Query
     */
    public function listarPorMunicipio($municipioId) : Query
    {        
        return $this->find('all', [
            'fields' => [
                'Distritos.id',
                'Distritos.inep_codigo',
                'Distritos.nome',
            ],
            'order' => [
                'Distritos.nome ASC',
            ],
            'conditions' => [
                'Distritos.municipio_id' => (int) $municipioId,
            ],
        ]);
    }
}
