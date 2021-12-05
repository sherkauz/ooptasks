<?php
    class Tasks extends Controller
    {
        public function __construct()
        {
          $this->userModel = $this->model('User');
          $this->taskModel = $this->model('Task');
        }


        public function add()
        {
            //Check for POST
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                // Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Process form
                $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'task' => trim($_POST['task']),
                'status' => 'In process',
                'name_err' => '',
                'email_err' => '',
                'task_err' => '',
                ];

                // Validate email
                if ( empty($data['email']) ) {
                    $data['email_err'] = 'Please inform your email';
                } 

                // Validate Name
                 if ( empty($data['name']) ) {
                    $data['name_err'] = 'Please inform your name';
                 }

                 // Validate Password
                 if ( empty($data['task']) ) {
                    $data['task_err'] = 'Please inform your task';
                 }

                 //Make sure errors are empty
                 if ( empty($data['name_err']) && empty($data['email_err']) && empty($data['task_err']) ) {

                     if ( $this->taskModel->add($data) ) {
                         flash('register_success','Task has been added successfully!');
                         redirect('pages/addtask');
                         //$this->login();
                         //redirect('posts/login');
                     } else {
                         die ('Something went wrong');
                     }
                 } else{
                     // Load view with errors
                     $this->view('pages/addtask',$data);
                 }
            } else {
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'task' => '',
                    'status' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'task_err' => ''
                ];

                // Load view
                $this->view('pages/index', $data);
            }
        }

        public function alter($id)
        { 
            if(isset($_POST['toactive'])){
                $this->taskModel->alterToActive($id);
                flash('user_message', "Status of Task has been changed.");
                redirect('opers');
            }else{
                die('Something went wrong.');
            }
        }

        public function edit($id)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                // Sanitize POST Array
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'task' => trim($_POST['task']),
                    'id_err' => '',
                    'name_err' => '',
                    'email_err' => ''
                ];

                // Validate email
                if ( empty($data['email']) ) {
                    $data['email_err'] = 'Please inform your email';
                } 

                // Validate Name
                 if ( empty($data['name']) ) {
                    $data['name_err'] = 'Please inform your name';
                 }

                 // Validate Password
                 if ( empty($data['task']) ) {
                    $data['task_err'] = 'Please inform your task';
                 }

                // Make sure no errors
                if ( empty($data['name_err']) && empty($data['email_err']) && empty($data['task_err']) ){
                    // Validated
                    if( $this->taskModel->updateTask($data) ){
                        flash('user_message', 'Task Updated');
                        redirect('opers');
                    } else{
                        die('Something went wrong');
                    }
                } else {
                    // Load the view
                    $this->view('tasks/edit', $data);
                }

            } else{
                // Get existing post from model
                $tasks = $this->taskModel->getTaskById($id);

                $data = [
                    'id' => $tasks->id,
                    'name' => $tasks->name,
                    'email' => $tasks->email,
                    'task' => $tasks->task,
                    'name_err' => '',
                    'email_err' => '',
                    'task_err' => ''
                 ];

                $this->view('pages/edittask', $data);
             }

        }
    }