<?php

namespace GRE\Controller;

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
}
