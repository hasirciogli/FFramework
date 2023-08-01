<?php 

namespace app\middlewares;
use app\route\Router;

class AuthMiddleware {

    /**
     * @param mixed ...$pArgs
     * @return bool
     */
    public function handle(...$pArgs): bool {
        echo "LDP ye giremezsiniz.";
        Router::Route("/", 3);
        return false;
    }

    /**
     * @return bool
     */
    public function IsAuthed() : bool {
        
        return true;
    }


    /**
     * @return bool
     */
    public function IsAdmin() : bool {
        
        return true;
    }
}

?>