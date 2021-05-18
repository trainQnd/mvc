<?php
namespace mvc\Models;

use mvc\Core\Model;

class TaskModel extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $created_at;
    protected $updated_at;

    public function __construct() {
        $this->id = '';
        $this->title = '';
        $this->description = '';
        $this->created_at = '';
        $this->updated_at = '';

    }

    public function setId( $id ) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setTitle( $title ) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription( $description ) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setCreatedAt( $created_at ) {
        $this->created_at = $created_at;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setUpdatedAt( $updated_at ) {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
