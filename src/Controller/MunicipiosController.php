<?php

namespace GRE\Controller;

/**
 * Controller Municipios
 *
 */
class MunicipiosController extends AppController
{
    /**
     * Lista os municipios cadastrados
     * Devolve a resposta em JSON caso a requisição seja do tipo ajax.
     * 
     * @param int $ufId
     * @return void
     */
    public function listar($ufId = null)
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
            $this->viewBuilder()->setTemplate('ajax_listar');
            $municipios = $this->Municipios->listarPorUf($ufId);
            $this->set(compact('municipios'));
        } else {
            return $this->redirect('/');
        }
    }
}
