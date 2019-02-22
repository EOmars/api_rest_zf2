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
use Application\Entity\Alumno;

class AlumnoController extends AbstractRestfulController {

    public function indexAction() {
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $user = new \Application\Entity\Alumno();
        $user->setNombre('Marco Pivetta');
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $user = new \Application\Entity\Alumno();
        $model = new JsonModel();
        $model->setVariables(["hola" => "mundo"]);
        return $model;
    }

    public function get($id) {
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        $alumno = $objectManager->find('Application\Entity\Alumno', $id);

        return (new JsonModel())->setVariables($this->toArray($alumno));
    }

    protected function toArray(Alumno $alumno) {
        $respuesta = [];
        $promedio = $this->getPromedio($alumno->getCalificaciones());
        foreach ($alumno->getCalificaciones() as $calificacion) {
            
            $respuesta[] = [
                'id_t_usuario' => $alumno->getId(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApPaterno() . " " . $alumno->getApMaterno(),
                'materia' => $calificacion->getMateria()->getNombre(),
                'calificacion' => $calificacion->getCalificacion(),                
                'fecha_registro' => $calificacion->getFechaRegistro(),
                'promedio' => $promedio
            ];
        }

        return $respuesta;
    }

    protected function getPromedio($calificaciones) {
        $sum = 0;
        foreach($calificaciones as $calificacion){
            $sum += $calificacion->getCalificacion();
        }        
        return number_format($sum / $calificaciones->count() , 2);
    }

}
