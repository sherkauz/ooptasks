<?php


class Opers extends Controller
{
   public function __construct()
   {
      if(!isLoggedIn() ){
         redirect('users/login');
      }
      $this->taskModel = $this->model('Task');
      $this->userModel = $this->model('User');
   }

   public function index()
    {
       $tasks = $this->taskModel->getUnactiveTasks();
       $data = [
          'getTasks' => $tasks
       ];
       $this->view('opers/index', $data);
    }

    public function delete($id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST') {
            
            if( $this->taskModel->deleteTask($id) ){
                flash('user_message', 'The task has been removed with success!');
                redirect('opers');
            } else {
                flash('user_message', 'Something wen wrong');
                redirect('opers');
            }
        
        } else {
            redirect('opers');
        }
    }
}