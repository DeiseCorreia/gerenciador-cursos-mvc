<?php

use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\FormularioInsercao;

//devolve as rotas para o index.php

return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso'=>FormularioInsercao::class,
    '/salvar-curso'=> Persistencia::class
];
