<?php

namespace GRE\Model\Table;

use Cake\Validation\Validator;

use Cake\ORM\Query;
use GRE\Model\Entity\EscolaLocal;

/**
 * Repositório da entidade `EscolaLocal`
 * 
 */
class EscolaLocaisTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setEntityClass('EscolaLocal');
        
        $this->setDisplayField('nome');
        
        $this->belongsTo('Escolas');
        $this->belongsTo('EscolaLocalTipos');
        $this->belongsTo('PredioOcupacaoFormas');
        
        $this->hasMany('EscolaSalas');
        $this->hasMany('EscolaLocalCompartilhamentos');
    }
    
    /**
     * Regras de validação default
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->requirePresence('nome', 'create', 'Informe o nome do local');
        $validator->requirePresence('predio_ocupacao_forma_id', 'create', 'Informe a forma de ocupação');
        $validator->requirePresence('escola_local_tipo_id', 'create', 'Informe o tipo do local');
        
        $validator->notEmpty('nome', 'Informe o nome do local');
        $validator->notEmpty('predio_ocupacao_forma_id', 'Informe a forma de ocupação');
        $validator->notEmpty('escola_local_tipo_id', 'Informe o tipo do local');
                
        return $validator;
    }

    /**
     * Obtém o local da escola especificado pela chave primária
     * 
     * @param int $primaryKey
     * @param array $options
     * @return \GRE\Model\Entity\EscolaLocal
     */
    public function get($escolaLocalId, $options = array()) 
    {
        $defaultOptions = [
            'contain' => [
                'Escolas',
            ],
            'fields' => [
                'Escolas.id',
                'Escolas.nome_curto',
                'EscolaLocais.nome',
                'EscolaLocais.id',
                'EscolaLocais.predio_ocupacao_forma_id',
                'EscolaLocais.escola_local_tipo_id',
            ],
            'conditions' => [
                'EscolaLocais.deleted' => false,
            ]
        ];
        $options = array_merge($defaultOptions, $options);
        
        return parent::get($escolaLocalId, $options);
    }
    
    /**
     * Define o local de funcionamento como excluído
     * 
     * @param EscolaLocal $escolaLocal
     * @return bool
     */
    public function setDeleted(EscolaLocal $escolaLocal)
    {
        $escolaLocal->deleted = true;
        return $this->save($escolaLocal);
    }
    
    /**
     * Obtém a lista de locais da escola especificadas
     * 
     * @param int $escolaId
     * @return array Lista para ser usada em selects
     */
    public function getList(int $escolaId) : array
    {
        return $this->find('list', [
            'conditions' => [
                'EscolaLocais.escola_id' => $escolaId,
                'EscolaLocais.deleted' => false,
            ],
        ])->toArray();
    }
}
