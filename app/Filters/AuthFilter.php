<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $currentUri = strtolower(uri_string());

        if($session && $session->has('name')){

            $role = strtolower($session->get('role'));

            if($currentUri === "login"){
                return redirect("Home::index");
            }

            $allowedRoles = ["admin", "manager"];
            
            if (str_contains($currentUri, "settings") && !in_array($role, $allowedRoles)) {
                log_message('debug', 'Redirecting to Home::index due to restricted access to settings.');
                return redirect("Home::index");
            }
            
        }else{

            $allowedLinksForNonUsers = ["login", "login/acceptdata"];

            if(!in_array($currentUri, $allowedLinksForNonUsers)){
                return redirect("AuthController::login");
            }

        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}
