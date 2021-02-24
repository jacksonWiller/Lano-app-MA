<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;




class SecurityController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $helper)
    {
        return $this->render('security/login.html.twig', [
            'error' => $helper->getLastAuthenticationError()
            ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() : void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/cadastro", name="cadastro")
     */
    public function register(UserPasswordEncoderInterface $password_encoder, Request $request)
    {
        $usuario = new Usuario;
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            $usuario->setEmail($request->request->get('usuario')['email']);
            $usuario->setRoles(['ROLE_USER']);
            $password = $password_encoder->encodePassword($usuario, $request->request->get('user')['password']['first']);
            $usuario->setNome($request->request->get('usuario')['nome']);
            $usuario->setPerfil($request->request->get('usuario')['perfil']);         
            $usuario->setPassword($password);
            
            $entityManager->persist($usuario);
            $entityManager->flush();

            $this->loginUserAutomatically($usuario, $password);

            return $this->redirectToRoute('user_inde');
        }
        return $this->render('security/cadastro.html.twig',['form'=>$form->createView()]);
    }

    private function loginUserAutomatically($usuario, $password)
    {
        $token = new UsernamePasswordToken(
            $usuario,
            $password,
            'main', // security.yaml
            $usuario->getRoles()
        );
        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main',serialize($token));
    }
}
