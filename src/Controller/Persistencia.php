<?php


namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;


class Persistencia implements InterfaceControladorRequisicao
{
    private \Doctrine\ORM\EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
                ->getEntityManager();
    }

    
    public function processaRequisicao(): void
    {   
        //filtrar dados
        $descricao = filter_input(
            INPUT_POST, 
            'descricao',
            FILTER_SANITIZE_STRING
        );
        //pegar dados do formulario
        //$descricao = $_POST['descricao'];

        //montar modelo curso
        $curso = new Curso();
        $curso->setDescricao($_POST['descricao']);

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if(!is_null($id) && $id !== false) {
            //atualizar
            $curso->setId($id);
            $this->entityManager->merge($curso);//merge->junta(une com o que ja tenho no banco)
        } else {
            //inserir
            $this->entityManager->persist($curso);
        }
        $this->entityManager->flush();
        
        header('Location: /listar-cursos', true, 302);
    }
}