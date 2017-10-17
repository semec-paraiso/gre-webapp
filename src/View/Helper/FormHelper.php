<?php

namespace GRE\View\Helper;

/**
 * Herança do FormHelper com inclusão de melhorias
 * 
 */
class FormHelper extends \Cake\View\Helper\FormHelper
{
    /**
     * Outros helpers utilizados
     *
     * @var array
     */
    public $helpers = ['Html', 'Url', 'Button'];

    /**
     * Reescrita do método `submit()` para acréscimo de melhorias
     *
     * @param string $caption
     * @param array $options
     * @return string
     */
    public function submit($caption = 'Salvar', array $options = array())
    {
        $defaultOptions = [
            'style' => 'primary',
            'text'  => $caption,
            'type'  => 'submit',
            'icon'  => 'salvar',
        ];
        $options = array_merge($defaultOptions, $options);
        
        return $this->Button->render($options);
    }
    
    /**
     * Exibe um select com opções booleanas (default: 0 => Não; 1 => Sim)
     * 
     * @param string $fieldName
     * @param array $options
     * @return string
     */
    public function yesOrNo(string $fieldName, array $options = []) : string
    {
        $defaultOptions = [
            'options' => [
                0 => 'Não',
                1 => 'Sim',
            ],
        ];
        $options['type'] = 'select';
        $options = array_merge($defaultOptions, $options);
        
        return $this->input($fieldName, $options);
    }
}
