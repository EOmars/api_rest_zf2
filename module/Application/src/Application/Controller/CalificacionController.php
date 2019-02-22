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
use Application\Entity\Alumno;
use Application\Entity\Materia;

class CalificacionController extends AbstractRestfulController {

    function get($id) {
        parent::get($id);
    }

    function getList() {
        $this->response->setStatusCode(405);

        return array(
            'content' => 'Method Not Allowed'
        );
    }

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

}
