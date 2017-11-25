<?php

namespace GRE\Model\Entity;

use Cake\I18n\Date;

/**
 * Entidade `Reconhecimento`
 * 
 */
class Reconhecimento extends Entity
{
    /**
     * Data de hoje
     * Será utilizada para verificar se o reconhecimento está vencido
     *
     * @var Date
     */
    protected $_today;
    
    /**
     * Construtor
     * Detine a data de hoje automaticamente
     * 
     * @param array $properties
     * @param array $options
     */
    public function __construct(array $properties = array(), array $options = array())
    {
        parent::__construct($properties, $options);
        $this->setToday(Date::today());
    }
    
    /**
     * Define a data de hoje
     * 
     * @param Date $today
     */
    public function setToday(Date $today)
    {
        $this->_today = $today;
    }
    
    /**
     * Obtém a data de hoje definida na entidade
     * 
     * @return Date
     */
    public function getToday() : Date
    {
        return $this->_today;
    }
    
    /**
     * Verifica se a data de vencimento do Reconhecimento é menor que a data
     * atual definida no sistema
     * 
     * @return bool
     */
    public function vencido() : bool
    {
        if (!$this->validade) {
            return true; 
        } 
        return $this->getToday()->gt($this->validade); 
    }
}
