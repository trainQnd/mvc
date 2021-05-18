<?php
namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class TasksController extends Controller {
    private $taskRepository;
    private $task;

    public function __construct() {
        $this->task = new TaskModel;
        $this->taskRepository = new TaskRepository( $this->task );
    }

    public function index() {
        $d['tasks'] = $this->taskRepository->showAll();
        $this->set( $d );
        $this->render( 'index' );
    }

    public function create() {
        if ( isset( $_POST['title'] ) ) {
            $this->task->setTitle( $_POST['title'] );
            $this->task->setDescription( $_POST['description'] );
            $this->task->setCreatedAt( date( 'Y-m-d H:i:s' ) );
            $this->task->setUpdatedAt( date( 'Y-m-d H:i:s' ) );

            if ( $this->taskRepository->add( $model ) ) {
                header( 'Location: ' . WEBROOT . 'tasks/index' );
            }
        }

        $this->render( 'create' );
    }

    public function edit( $id ) {
        $d['task'] = $this->taskRepository->show( $id );

        if ( isset( $_POST['title'] ) ) {
            $this->task->setTitle( $_POST['title'] );
            $this->task->setDescription( $_POST['description'] );
            $this->task->setCreatedAt( date( 'Y-m-d H:i:s' ) );
            $this->task->setUpdatedAt( date( 'Y-m-d H:i:s' ) );

            if ( $this->taskRepository->edit( $id ) ) {
                header( 'Location: ' . WEBROOT . 'tasks/index' );
            }
        }
        $this->set( $d );
        $this->render( 'edit' );
    }

    public function delete( $id ) {
        if ( $this->taskRepository->delete( $id ) ) {
            header( 'Location: ' . WEBROOT . 'tasks/index' );
        }
    }
}