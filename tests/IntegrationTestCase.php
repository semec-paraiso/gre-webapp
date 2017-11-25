<?php

namespace GRE\Test;

/**
 * Melhorias na classe \Cake\TestSuite\IntegrationTestCase
 */
class IntegrationTestCase extends \Cake\TestSuite\IntegrationTestCase
{
    /**
     * Configura a requisição para simular uma requisição ajax
     * 
     * @param array $data
     * @return void
     */
    protected function configAjaxRequest(array $data = [])
    {
        $ajaxConfig = [
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest'
            ],
        ];
        $data = array_merge($ajaxConfig, $data);
        return $this->configRequest($data);
    }
}
