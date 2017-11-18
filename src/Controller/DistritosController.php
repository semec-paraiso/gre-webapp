<?php

namespace GRE\Controller;

/**
 * Controller Distritos
 * 
 */
class DistritosController extends AppController
{
    /**
     * Lista os distritos cadastrados
     * Devolve uma resposta em JSON caso a requisição seja do tipo ajax.
     * 
     * @param int $municipioId
     * @return void
     */
    public function listar($municipioId = null)
    {
        if ($this->request->is('ajax')) {
            return $this->_ajaxListar($municipioId);
        }
    }
    
    /**
     * Prepara a resposta para a requisição ajax
     * 
     * @param int $municipioId
     */
    protected function _ajaxListar($municipioId)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->viewBuilder()->setTemplate('ajax_listar');
        $distritos = $this->Distritos->listarPorMunicipio($municipioId);
        $this->set(compact('distritos'));
    }
}
