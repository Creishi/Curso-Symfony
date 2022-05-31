<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


use AppBundle\Entity\Categoria;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

    /**
     * @Route("/api")
     */

class ApiController extends Controller
{
    
    function catToArray($categoria)
    {
        $categoriaArray=array();
        $categoriaArray['id']=$categoria->getId();
        $categoriaArray['nombre']=$categoria->getNombre();
        $categoriaArray['descripcion']=$categoria->getDescripcion();
        return $categoriaArray;
    }

    function catsToArray($categorias)
    {
        $categoriasArray=array();
        foreach ($categorias as $categoria) {
            $categoriasArray[]=$this->catToArray($categoria);
        }
        return $categoriasArray;
    }

    /**
     * @Route("/listarCategorias", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();
        $categoriasArray=array();

        foreach ($categorias as $categoria) {
            $categoriaArray=array();
            $categoriaArray['id']=$categoria->getId();
            $categoriaArray['nombre']=$categoria->getNombre();
            $categoriaArray['descripcion']=$categoria->getDescripcion();
            $categoriasArray[]=$categoriaArray;
        }
        $response = new JsonResponse($categoriasArray);
        
        return $response;
    }

    /**
     * @Route("/insertarCategoria/{nombre}/{descripcion}", methods={"POST"})
     */
    public function insertarCategoriaAction($nombre="",$descripcion="")
    {
        if (strlen($nombre)>0) {
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            $categoria->setDescripcion($descripcion);
            $categoria->setFoto("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            $response = new JsonResponse($this->catToArray($categoria));
            return $response;
        }
        throw new BadRequestHttpException("Falta nombre", null, 400);
    }
}
?>