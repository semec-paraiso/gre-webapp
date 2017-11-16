<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

/**
 * Helper para a construção de elementos Box
 * 
 */
class BoxHelper extends Helper
{
    /**
     * Outros helpers utilizados
     *
     * @var array
     */
    public $helpers = ['Html', 'Icon', 'Toolbar'];
    
    /**
     * Constroi o header da box
     * 
     * @param array $options
     * @return string
     */
    public function header(array $options = []) : string
    {
        $defaultOptions = [
            'text' => null,
            'icon' => null,
            'toolbar' => null,
        ];
        $options = array_merge($defaultOptions, $options);
        
        $output = '';
        
        if (is_string($options['icon'])) {
            $output = $this->Icon->render($options['icon']);
        }
        unset($options['icon']);
        
        if (is_string($options['text'])) {
            $output = trim("{$output}{$options['text']}");
            $output = $this->Html->tag('h3', $output, ['class' => 'box-title']);
        }
        unset($options['text']);
        
        if (is_array($options['toolbar'])) {
            $options['toolbar'] = $this->Toolbar->render($options['toolbar']);        
            $output .= $this->Html->tag('div', $options['toolbar'], ['class' => 'box-tools']);
        }
        unset($options['toolbar']);
        
        $options = $this->addClass($options, 'box-header');
        
        return $this->Html->tag('div', $output, $options);
    }
}
