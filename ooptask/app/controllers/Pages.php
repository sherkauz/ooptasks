<?php


    class Pages extends Controller
    {

       public function index()
       {
          if( isLoggedIn() ) {
             redirect('posts');
          }
          
          $this->taskModel = $this->model('Task');

          if (isset($_POST['submit'])) {
               $sort = $_POST['sort'];
               $pagination = new Pagination('tasks', $sort);
               $tasks = $pagination->get_data();
               $pages = $pagination->get_pagination_number();
          }else{
               $pagination = new Pagination('tasks');
               $tasks = $pagination->get_data();
               $pages = $pagination->get_pagination_number();
          }

          $data = [
              'getTasks' => $tasks,
              'pages' => $pages,
              'pagination' => $pagination
          ];

          $this->view('pages/index', $data);
       }

       public function addtask()
       {
          $data = [
              'title' => 'Adding a task',
              'description' => 'You can add without authorization'
          ];
          $this->view('pages/addtask',$data);
       }
    } 