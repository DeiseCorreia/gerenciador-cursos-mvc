<?php


namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;




class ListarCursos  implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
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
            'cursos' => $this->repositorioDeCursos->findAll(),
            'titulo' => 'Lista de Cursos',
        ]);

        
    }
}