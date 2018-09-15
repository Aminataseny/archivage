<?php


namespace AppBundle\Redirection;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_SUPER_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('admin_index'));
        } 
        elseif (in_array('ROLE_DIRECTEUR', $rolesTab, true)) {  
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('directeur_index'));
        } 
        elseif (in_array('ROLE_SECRETAIRE', $rolesTab, true)) {
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('secretaire_index'));
        } 
        elseif (in_array('ROLE_COMPTABLE', $rolesTab, true)) {
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('comptable_index'));
        }
        elseif (in_array('ROLE_TECHNICIEN', $rolesTab, true)) {
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('technicien_index'));
        } 
        elseif (in_array('ROLE_ACHAT', $rolesTab, true)) {
            // c'est un utilisaeur lambda : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('achat_index'));
        }
        else {
            $redirection = $this->redirectToRoute('default_index');
        }

        return $redirection;

    }
}