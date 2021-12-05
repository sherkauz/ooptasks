<?php


    class Users extends Controller
    {
        public function __construct()
        {
          $this->userModel = $this->model('User');
        }
        
        public function index()
        {
            if(!isLoggedIn() ){
                redirect('users/login');
            }
            $users = $this->userModel->getUsers();
            $data = [
                'users' => $users
            ];
            return $this->view('users/index', $data);
        }


        public function login()
        {
            //Check for POST
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                // Process form
                // Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Process form
                $data = [
                    'login' => trim($_POST['login']),
                    'password' => trim($_POST['password']),
                    'login_err' => '',
                    'password_err' => '',
                ];

                // Validate email
                if ( empty($data['login']) ) {
                    $data['login_err'] = 'Please inform your login';
                }

                // Validate password
                if ( empty($data['password']) ) {
                    $data['password_err'] = 'Please inform your password';
                }

                //Make sure are empty
                if ( empty($data['login_err']) && empty($data['password_err']) ) {
                    // Validated
                    // Check and set logged in user
                    $userAuthenticated = $this->userModel->login($data['login'], $data['password']);
                    if ( $userAuthenticated) {
                        // Create session
                        $this->createUserSession($userAuthenticated);
                    } else {
                        $data = [
                            'login' => trim($_POST['login']),
                            'password' => '',
                            'login_err' => 'Email or Password are incorrect',
                            'password_err' => 'Email or Password are incorrect',
                        ];
                        $this->view('users/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('users/login',$data);
                }
            } else {
                // Init data
                $data = [
                    'login' => '',
                    'password' => '',
                    'login_err' => '',
                    'password_err' => '',
                ];
                // Load view
                $this->view('users/login', $data);
            }
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_mail']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }

        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('opers');
        }

        public function isLoggedIn()
        {
            if ( isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
                return true;
            } else {
                return false;
            }
        }

    }