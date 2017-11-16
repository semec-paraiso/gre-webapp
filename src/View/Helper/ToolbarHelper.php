<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

/**
 * Helper para a construção de toolbars
 */
class ToolbarHelper extends Helper
{
    /**
     * Outros helpers utilizados
     *
     * @var array
     */
    public $helpers = ['Html', 'ButtonGroup'] ;
    
    /**
     * Constroi o HTML de uma toolbar
     * 
     * @param array $options
     * @return string
     */
    public function render(array $options = []) : string
    {
        $defaultOptions = [
            'groups'  => [],
            'options' => [],
        ];
        $options = array_merge($defaultOptions, $options);
        
        $groups  = $options['groups'];
        $options = $options['options'];
        
        $options = $this->addClass($options, 'btn-toolbar');
        
        $groupsHtml = '';
        
        foreach ($groups as $group) {
            $groupsHtml .= $this->ButtonGroup->render($group);
        }
        
        return $this->Html->tag('div', $groupsHtml, $options);
    }
}
