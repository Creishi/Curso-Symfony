<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Usuario;
use AppBundle\Form\usuarioType;
use AppBundle\Repository\TapaRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Query;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller

{
    /**
     * @Route("/{currentPage}", name="homepage")
     */
    public function homeAction(Request $request, $currentPage = 1)
    {
        //$numTapas=3;
        //Capturar el repositorio de la Tabla contra la DB
        $taparepository = $this->getDoctrine()->getRepository(Tapa::class);
        //Consulta todas las tapas que coinciden con el top, con un el valor 1
        $tapas = $taparepository->findBy(
            array('top' => '1')
        );
        /*$query = $this->$taparepository->createQueryBuilder('t')
            ->where('t.top= 1')
            ->setFirstResult($numTapas*($pagina-1))
            ->setMaxResults(3)
            ->getQuery();
            $tapas = $query->getResult();*/
            
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

    /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function categoriaAction(Request $request,$id=null)
    {
        if($id!=null){

        //Capturar el repositorio de la Tabla contra la DB
        $categoriarepository = $this->getDoctrine()->getRepository(Categoria::class);
        //Consulta todas las tapas que coinciden con el top, con un el valor 1
        $categoria = $categoriarepository->find($id);
        return $this->render('frontal/categoria.html.twig',array('categoria'=>$categoria));
        }else{
            return $this->redirectToRoute("homepage");
        }        
    }

    /**
     * @Route("/ingrediente/{id}", name="ingrediente")
     */
    public function ingredienteAction(Request $request,$id=null)
    {
        if($id!=null){

        //Capturar el repositorio de la Tabla contra la DB
        $ingredienterepository = $this->getDoctrine()->getRepository(Ingrediente::class);
        //Consulta todas las tapas que coinciden con el top, con un el valor 1
        $ingrediente = $ingredienterepository->find($id);
        return $this->render('frontal/ingrediente.html.twig',array('ingrediente'=>$ingrediente));
        }else{
            return $this->redirectToRoute("homepage");
        }        
    }

    /**
     * @Route("/nuevoUsuario/", name="nuevoUsuario")
     */
    public function nuevoUsuarioAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $usuario = new Usuario;

        //Construyendo el formulario
        $form = $this->createForm(usuarioType::class, $usuario);
        //Recogemos la información
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);

            //3b) $username=$email
            $usuario->setUsername($usuario->getEmail());

            //3b) $roles
            $usuario->setRoles(array('ROLE_USER'));

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();


            return $this->redirectToRoute('login');
        }
        // replace this example code with whatever you need
        return $this->render('frontal/registro.html.twig',array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/login/", name="login")
     */

    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        //get the error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        //last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontal/login.html.twig', array(
            'last_Username' => $lastUsername,
            'error' => $error,
        ));
    }
}
