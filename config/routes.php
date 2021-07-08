<?php

use Alura\Cursos\Controller\{
    Exclusao,
    ListarCursos,
    Persistencia,
    FormularioInsercao,
    FormularioEdicao
};

//devolve as rotas para o index.php

return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso'=>FormularioInsercao::class,
    '/salvar-curso'=> Persistencia::class,
    '/excluir-curso'=> Exclusao::class,
    '/alterar-curso'=> FormularioEdicao::class
];
