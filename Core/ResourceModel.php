<?php
namespace mvc\Core;

use mvc\Core\ResourceModelInterface;
use mvc\Config\Database;

class ResourceModel implements ResourceModelInterface
 {
    private $table;
    private $id;
    private $model;

    public function _init( $table, $id, $model ) {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save( $model ) {
        $str = $this->model->getProperties();
        $keys = '';
        $values = '';
        foreach ( $str as $key => $value ) {
            $keys .= $key.', ';
            $values .= "'".$value."', " ;
        }

        $sql = 'INSERT INTO ' .$this->table. ' ('.trim( $keys, ', ' ).') VALUES ('.trim( $values, ', ' ). ')';
        $req = Database::getBdd()->prepare( $sql );
        return $req->execute();
    }

    public function delete( $id ) {
        $sql = 'DELETE FROM '.$this->table. ' WHERE '.$this->id .' = ?;';
        $req = Database::getBdd()->prepare( $sql );
        return $req->execute( [$id] );

    }

    public function show( $id ) {
        $sql = 'SELECT * FROM ' .$this->table. ' WHERE '.$this->id. ' = ?;';
        $req = Database::getBdd()->prepare( $sql );
        $req->execute( [$id] );
        return $req->fetch();
    }

    public function showAll() {
        $sql = 'SELECT * FROM '.$this->table.';';
        $req = Database::getBdd()->prepare( $sql );
        $req->execute();
        return $req->fetchAll();
    }

    public function edit( $id ) {
        $str = $this->model->getProperties();
        $update = '';
        foreach ( $str as $key => $value ) {
            $update .= $key . " = '" . $value . "', ";

        }
        $sql = 'UPDATE '.$this->table.' SET '.trim( $update, ', ' ) . ' WHERE '.$this->id . ' = ?;';
        $req = Database::getBdd()->prepare( $sql );

        return $req->execute( [$id] );
    }
}
