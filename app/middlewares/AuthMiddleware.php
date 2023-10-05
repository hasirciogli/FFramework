<?php 

namespace app\middlewares;
use app\route\Router;

class AuthMiddleware {

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