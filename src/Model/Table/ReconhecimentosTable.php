<?php

namespace GRE\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\Validation\Validator;
use GRE\Formatting\Date;
use GRE\Model\Entity\Reconhecimento;

/**
 * Repositório `Reconhecimentos`
 * 
 */
class ReconhecimentosTable extends Table
{
    /**
     * Instruções de inicialização da classe
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setEntityClass('Reconhecimento');
    }
    
    /**
     * Regras de validação default
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->requirePresence('curso', 'create', 'Informe o curso');
        $validator->requirePresence('ato', 'create', 'Informe o ato de reconhecimento');
        $validator->requirePresence('validade', 'create', 'Informe a data de validade do ato');
        
        $validator->notEmpty('curso',  'Informe o curso');
        $validator->notEmpty('ato', 'Informe o ato de reconhecimento');
        $validator->notEmpty('validade', 'Informe a data de validade');
        
        $validator->date('validade', 'ymd', 'Informe uma data válida');
        
        return $validator;
    }
    
    /**
     * Conversão de valores a serem salvos
     * 
     * @param Event $event
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return ArrayObject
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['validade'])) {
            $data['validade'] = Date::brToPhp($data['validade']);
        }
        return $data;
    }
    
    /**
     * Sobrescreve o método `get` para não considerar entidades deletadas
     * 
     * @param int $primaryKey
     * @param array $options
     * @return Reconhecimento
     */
    public function get($primaryKey, $options = array())
    {
        $defaultOptions = [
            'conditions' => [
                'Reconhecimentos.deleted' => false,
            ],
        ];
        $options = array_merge($defaultOptions, $options);
        
        return parent::get($primaryKey, $options);
    }
    
    /**
     * Define um Reconhecimento como excluído
     * 
     * @param Reconhecimento $reconhecimento
     * @return Reconhecimento | bool
     */
    public function setDeleted(Reconhecimento $reconhecimento)
    {
        $reconhecimento->deleted = true;
        return $this->save($reconhecimento);
    }
}
