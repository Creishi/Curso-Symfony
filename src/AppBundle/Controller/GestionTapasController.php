<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;
use AppBundle\Form\categoriaType;
use AppBundle\Form\ingredienteType;
use AppBundle\Form\tapaType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
     * @Route("/gestionTapas")
     */

class GestionTapasController extends Controller
{
    /**
     * @Route("/nuevaTapa", name="nuevaTapa")
     */
    public function nuevaTapaAction(Request $request)
    {

        $tapa = new Tapa;

        //Construyendo el formulario
        $form = $this->createForm(tapaType::class, $tapa);
        //Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity Tapa
            $tapa = $form->getData();
            $fotoFile=$tapa->getFoto();
            $fileName = md5(uniqid()).'.'.$fotoFile->guessExtension();
            //Mover el fichero a un directorio
            $fotoFile->move(
                $this->getParameter('tapaImg_directory'),
                $fileName);
            $tapa->setFoto($fileName);
            $tapa->setFechaCreacion(new \DateTime());
            //Almacenar nueva tapa
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($tapa);
            $eM->flush();

            return $this->redirectToRoute('tapa', array('id' => $tapa->getId()));
        }
        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaTapa.html.twig',array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCaAction(Request $request)
    {
        $categoria = new Categoria;

        //Construyendo el formulario
        $form = $this->createForm(categoriaType::class, $categoria);
        //Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity Tapa
            $categoria = $form->getData();
            $fotoFile=$categoria->getFoto();
            $fileName = md5(uniqid()).'.'.$fotoFile->guessExtension();
            //Mover el fichero a un directorio
            $fotoFile->move(
                $this->getParameter('tapaImg_directory'),
                $fileName);
            $categoria->setFoto($fileName);
            //Almacenar nueva categoria 
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($categoria);
            $eM->flush();

            return $this->redirectToRoute('categoria', array('id' => $categoria->getId()));
        }
        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaCategoria.html.twig',array(
            "form" => $form->createView()
        ));       
    }

       /**
     * @Route("/nuevoIngrediente", name="nuevoIngrediente")
     */
    public function nuevoIngreAction(Request $request)
    {
        $ingrediente = new Ingrediente;

        //Construyendo el formulario
        $form = $this->createForm(ingredienteType::class, $ingrediente);
        //Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity Ingrediente
            $ingrediente = $form->getData();
            
            //Almacenar nuevo ingrediente
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($ingrediente);
            $eM->flush();

            return $this->redirectToRoute('ingrediente', array('id' => $ingrediente->getId()));
        }
        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevoIngrediente.html.twig',array(
            "form" => $form->createView()
        ));       
    }
}