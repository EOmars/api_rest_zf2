<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="escuela.t_materias"
 * )
 * @ORM\Entity
 */
class Materia {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name = "id_t_materias",type="integer")
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
     * @ORM\Column(name="activo", type="integer")
     */
    protected $activo;
    

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
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

    function setActivo($activo) {
        $this->activo = $activo;
    }

}
