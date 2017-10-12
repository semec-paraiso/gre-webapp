<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

/**
 * Helper para a construção de List Groups
 * 
 */
class ListGroupHelper extends Helper
{   
    /**
     * Outros helpers utilizados
     *
     * @var array
     */
    public $helpers = ['Html', 'Icon'];

    /**
     * Constroi e retorna o HTML de um item do list group
     * 
     * @param array $options
     * @return string
     */
    protected function _renderItem(array $options = []) : string
    {
        $defaultOptions = [
            'class'  => '',
            'text'   => '',
            'url'    => '#',
            'icon'   => null,
            'active' => false,
            'escape' => false,
        ];
        $options = array_merge($defaultOptions, $options);
        
        $options = $this->addClass($options, 'list-group-item');
        
        if ($options['active']) {
            $options = $this->addClass($options, 'active');
        }
        unset($options['active']);
        
        $url = $options['url'];
        unset($options['url']);
        
        $icon = '';
        if ($options['icon'] !== null && is_string($options['icon'])) {
            $icon = $this->Icon->render($options['icon']);
        }
        unset($options['icon']);
        
        $text = trim("{$icon} {$options['text']}");
        unset($options['text']);
        
        return $this->Html->link($text, $url, $options);
    }
    
    /**
     * Constroi e retorna o HTML do list group
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $defaultOptions = [
            'class' => '',
            'items' => [],
        ];
        $options = array_merge($defaultOptions, $options);
        
        $options = $this->addClass($options, 'list-group');
        
        $items = '';
        
        foreach ($options['items'] as $item) {
            $items .= $this->_renderItem($item);
        }
        unset($options['items']);
        
        return $this->Html->tag('nav', $items, $options);
    }
}
