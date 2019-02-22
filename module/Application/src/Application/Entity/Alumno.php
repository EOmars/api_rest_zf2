<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="escuela.t_alumnos"
 * )
 * @ORM\Entity
 */
class Alumno {
    
    public function __construct()
    {
        $this->calificaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name = "id_t_usuarios",type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string")
     */
    protected $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ap_paterno", type="string")
     */
    protected $apPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="ap_materno", type="string")
     */
    protected $apMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="integer")
     */
    protected $activo;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Calificacion", mappedBy="alumno")
     */
    protected $calificaciones;
    
    function getCalificaciones(){
        return $this->calificaciones;
    }    
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApPaterno() {
        return $this->apPaterno;
    }

    function getApMaterno() {
        return $this->apMaterno;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApPaterno($apPaterno) {
        $this->apPaterno = $apPaterno;
    }

    function setApMaterno($apMaterno) {
        $this->apMaterno = $apMaterno;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }



}
