<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="escuela.t_calificaciones"
 * )
 * @ORM\Entity
 */
class Calificacion {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name = "id_t_calificaciones",type="integer")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="calificacion", type="decimal")
     */
    protected $calificacion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fecha_registro", type="date")
     */
    protected $fechaRegistro;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Alumno", inversedBy="calificaciones")
     * @ORM\JoinColumn(name="id_t_usuarios", referencedColumnName="id_t_usuarios")
     */
    protected $alumno;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Materia")
     * @ORM\JoinColumn(name="id_t_materias", referencedColumnName="id_t_materias")
     */
    protected $materia;
    
    function getId() {
        return $this->id;
    }

    function getCalificacion() {
        return $this->calificacion;
    }
    
    function getFechaRegistro(){
        return $this->fechaRegistro;
    }

    function getAlumno() {
        return $this->alumno;
    }

    function getMateria() {
        return $this->materia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCalificacion($calificacion) {
        $this->calificacion = $calificacion;
    }

    function setAlumno($alumno) {
        $this->alumno = $alumno;
    }

    function setMateria($materia) {
        $this->materia = $materia;
    }

    function setFechaRegistro($fecha){
        $this->fechaRegistro = $fecha;
    }

}
