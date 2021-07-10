<?php

namespace Alura\Cursos\Controller;

class Deslogar implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        session_destroy();//destroi a sessao atual do usuário
        header('Location: /login');
    }
}