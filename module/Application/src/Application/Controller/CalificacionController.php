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
use Application\Entity\AlumnoController;
use Application\Entity\Materia;

class CalificacionController extends AbstractRestfulController {

    function get($id) {
        $this->response->setStatusCode(405);
        return (new JsonModel())->setVariables(['content' => 'Method Not Allowed']);
    }

    function getList() {
        $data = [];
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        $calificaciones = $objectManager->getRepository('Application\Entity\Calificacion')
                ->findAll();

        foreach ($calificaciones as $calificacion) {
            $data[] = $this->toArray($calificacion);
        }

        return (new JsonModel())->setVariables($data);
    }

    /**
     * Registra una nueva calificacion
     * @param array $data
     * @return JsonModel
     */
    function create($data) {
        $response = new JsonModel();
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        $calificacion = new Calificacion();
        $alumno = $objectManager->find('Application\Entity\Alumno', (int) $data['alumno']);
        $materia = $objectManager->find('Application\Entity\Materia', (int) $data['materia']);

        $calificacion
                ->setCalificacion((int) $data['calificacion'])
                ->setAlumno($alumno)
                ->setMateria($materia)
                ->setFechaRegistro(new \DateTime("now"));
        try {
            $objectManager->persist($calificacion);
            $objectManager->flush();
            $this->response->setStatusCode(201);
            $response->setVariables(['success' => 'ok', 'msg' => 'calificacion registrada']);
        } catch (\Exception $e) {
            $this->response->setStatusCode(400);
            $response->setVariables(['success' => 'error', 'msg' => $e->getMessage()]);
        }
        return $response;
    }

    function update($id, $data) {
        $response = new JsonModel();
        $objectManager = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        $calificacion = $objectManager->find('Application\Entity\Calificacion', (int) $id);

        if (empty($calificacion)) {
            $this->response->setStatusCode(400);
            $response->setVariables(['success' => 'error', 'msg' => 'La calificacion no existe']);
        } else {
            $calificacion->setCalificacion($data['calificacion']);
            $objectManager->flush();
            $this->response->setStatusCode(202);
            $response->setVariables(['success' => 'ok', 'msg' => 'Calificacion actualizada']);
        }
        return $response;
    }

    private function toArray($calificacion) {
        return [
            'id_t_usuario' => $calificacion->getAlumno()->getId(),
            'nombre' => $calificacion->getAlumno()->getNombre(),
            'apellido' => trim($calificacion->getAlumno()->getApPaterno() . ' ' . $calificacion->getAlumno()->getApMaterno()),
            'materia' => $calificacion->getMateria()->getNombre(),
            'calificaion' => $calificacion->getCalificacion(),
            'fecha_registro' => $calificacion->getFechaRegistro() ? $calificacion->getFechaRegistro()->format('Y-d-m') : null
        ];
    }

}
