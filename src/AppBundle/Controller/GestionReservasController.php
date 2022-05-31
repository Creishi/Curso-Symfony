<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\reservaType;

    /**
     * @Route("/reservas")
     */

class GestionReservasController extends Controller
{
    /**
     * @Route("/nueva/{id}", name="nuevaReserva")
     */
    public function nuevaReservaAction(Request $request,$id=null)
    {
        if($id){
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id);
        }else{
            $reserva = new Reserva;
        }
        

        //Construyendo el formulario
        $form = $this->createForm(reservaType::class, $reserva);
        //Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity Tapa
            $usuario=$this->getUser();
            $reserva->setUsuario($usuario);
            //Almacenar nueva tapa
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($reserva);
            $eM->flush();

            return $this->redirectToRoute('reservas');
        }
        // replace this example code with whatever you need
        return $this->render('gestion/nuevaReserva.html.twig',array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/reservas", name="reservas")
     */
    public function reservasAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Reserva::class);
        $reservas = $repository->findBy(
            ['usuario' => $this->getUser()]
        );
        return $this->render('gestion/reservas.html.twig',array("reservas"=>$reservas));
    }

    /**
     * @Route("/borrar/{id}", name="borrarReserva")
     */
    public function borrarReservaAction(Request $request,$id=null)
    {
        if ($id) {
            //Busqueda de la reserva
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id);
            //Borrado
            $em = $this->getDoctrine()->getManager();
            $em->remove($reserva);
            $em->flush();
        }
        return $this->redirectToRoute('reservas');
    }
}
?>