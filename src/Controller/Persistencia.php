<?php


namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;


class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;
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
        $tipo = 'success';
        if(!is_null($id) && $id !== false) {
            //atualizar
            $curso->setId($id);
            $this->entityManager->merge($curso);//merge->junta(une com o que ja tenho no banco)
            $this->defineMensagem($tipo, 'Curso atualizado com Sucesso');
        } else {
            //inserir
            $this->entityManager->persist($curso);
            $this->defineMensagem($tipo, 'Curso inserido com Sucesso');
        }
        $_SESSION['tipo_mensagem'] = 'success';
        $this->entityManager->flush();
        
        header('Location: /listar-cursos', true, 302);
    }
}