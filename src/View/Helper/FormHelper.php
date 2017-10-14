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
}
