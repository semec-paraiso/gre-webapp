<?php

namespace GRE\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\Validation\Validator;
use GRE\Formatting\Date;

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
}
