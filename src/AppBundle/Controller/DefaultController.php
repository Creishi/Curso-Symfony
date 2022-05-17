<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {

        //Capturar el repositorio de la Tabla contra la DB
        $taparepository = $this->getDoctrine()->getRepository('AppBundle:Tapa');
        //Consulta todas las tapas que coinciden con el top, con un el valor 1
        $tapas = $taparepository->findBy(
            array('top' => '1')
        );
        // replace this example code with whatever you need
        return $this->render('frontal/index.html.twig',array('tapas'=>$tapas));
    }

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig');
    }

    /**
     * @Route("/contactar/{sitios}", name="contactar")
     */
    public function contactarAction(Request $request,$sitios='todos')
    {
        // replace this example code with whatever you need
        return $this->render('frontal/bares.html.twig',array('sitio'=>$sitios));
    }

    /**
     * @Route("/tapa/{id}", name="tapa")
     */
    public function tapaAction(Request $request,$id=null)
    {
        if($id!=null){

        //Capturar el repositorio de la Tabla contra la DB
        $taparepository = $this->getDoctrine()->getRepository(Tapa::class);
        //Consulta todas las tapas que coinciden con el top, con un el valor 1
        $tapa = $taparepository->find($id);
        return $this->render('frontal/tapa.html.twig',array('tapa'=>$tapa));
        }else{
            return $this->redirectToRoute("homepage");
        }        
    }
}
