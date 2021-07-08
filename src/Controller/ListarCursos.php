<?php


namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;
use Doctrine\Common\Persistence\ObjectRepository;


class ListarCursos extends ControllerComHtml implements InterfaceControladorRequisicao
{
    /**
    * @var \Doctrine\Common\Persistence\ObjectRepository
    */
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }

    
    public function processaRequisicao(): void
    {
        
        echo $this->renderizaHtml('cursos/listar-cursos.php',[
            'cursos' => $this->repositorioCursos->findAll(),
            'titulo' => 'Lista de Cursos',
        ]);
        
    }
}