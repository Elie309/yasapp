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
                return redirect("HomeController::index");
            }


            if (str_contains($currentUri, "employee") && !in_array($role, ["admin"])) {
                return redirect("Settings\SettingsController::index")->with("errors", ["Unauthorized access"]);
            }

            if(str_contains($currentUri, "locations/add") && !in_array($role, ["admin", "manager"])){
                return redirect("Settings\LocationController::index")->with("errors", ["Unauthorized access"]);
            }

            if(str_contains($currentUri, "currencies") && !in_array($role, ["admin"])){
                return redirect("Settings\SettingsController::index")->with("errors", ["Unauthorized access"]);
            }
            


            
        }else{

            $allowedLinksForNonUsers = ["login", "login/acceptdata"];

            if(!in_array($currentUri, $allowedLinksForNonUsers)){
                return redirect("Auth\AuthController::login");
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
