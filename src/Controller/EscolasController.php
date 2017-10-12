<?php

namespace GRE\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

class EscolasController extends AppController
{
    public function index()
    {
        return $this->redirect(['action' => 'listar']);
    }

    public function listar()
    {
        $escolas = $this->paginate($this->Escolas->listar(['search' => $this->request->query]));
        $this->set(compact('escolas'));
    }

    public function identificacaoVisualizar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }

}
