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
        $model = new JsonModel();
        $model->setVariables(["hola" => "mundo"]);
        return $model;
    }

    function get($id) {
        $response = new JsonModel();
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        $alumno = $objectManager->find('Application\Entity\Alumno', (int) $id);
        if (empty($alumno)) {
            $this->response->setStatusCode(404);
        } else {
            $data = $this->toArray($alumno);
            if ($data)
                $data[] = ['promedio' => $this->getPromedio($alumno->getCalificaciones())];
            $response->setVariables($data);
        }

        return $response;
    }

    function getList() {
        $this->response->setStatusCode(405);
        return (new JsonModel())->setVariables(['content' => 'Method Not Allowed']);
    }

    protected function toArray(Alumno $alumno) {
        $respuesta = [];
        foreach ($alumno->getCalificaciones() as $calificacion) {

            $respuesta[] = [
                'id_t_usuario' => $alumno->getId(),
                'nombre' => $alumno->getNombre(),
                'apellido' => $alumno->getApPaterno() . " " . $alumno->getApMaterno(),
                'materia' => $calificacion->getMateria()->getNombre(),
                'calificacion' => $calificacion->getCalificacion(),
                'fecha_registro' => $calificacion->getFechaRegistro() ? $calificacion->getFechaRegistro()->format('Y-d-m') : null
            ];
        }

        return $respuesta;
    }

    function getPromedio($calificaciones) {
        $sum = 0;
        foreach ($calificaciones as $calificacion) {
            $sum += $calificacion->getCalificacion();
        }
        return $calificaciones->count() ? number_format($sum / $calificaciones->count(), 2) : 0;
    }

}
