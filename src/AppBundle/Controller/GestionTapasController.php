<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;
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
            $tapa->setFoto("");
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
}