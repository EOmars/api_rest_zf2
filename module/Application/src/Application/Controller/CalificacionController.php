<?php

/**
 * RestFul Alumno y calificaciones
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Application\Entity\Calificacion;

class CalificacionController extends AbstractRestfulController {

    function get($id) {
        parent::get($id);
    }
    
    function getList(){  
        $this->response->setStatusCode(405);

        return array(
            'content' => 'Method Not Allowed'
        );
        
    }
    
    
    function create($data) {
        return (new JsonModel())->setVariables($data);
        
    }
    
    

}
