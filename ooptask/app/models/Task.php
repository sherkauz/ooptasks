<?php
    require_once APP_ROOT.'/libraries/Pagination.php';
    class Task{

        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function add($data)
        {
            $this->db->query('INSERT INTO tasks (name, email, task, status) values (:name, :email, :task, :status)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':task', $data['task']);
            $this->db->bind(':status', $data['status']);
            // Execute
            if ( $this->db->execute() ) {
                return true;
            } else {
                return false;
            }
        }

        public function getTasks($sort = 'name')
        {
            $this->db->query('SELECT * FROM tasks ORDER BY '.$sort.' ASC');
            return $this->db->resultSet();
    
        }

        public function getUnactiveTasks()
        {
            $this->db->query("SELECT * FROM tasks WHERE status = 'In process'");
            return $this->db->resultSet();
    
        }

        public function deleteTask($id)
        {
            $this->db->query('DELETE FROM tasks where id = :id');
            // Bind values
            $this->db->bind(':id', $id);
        
            // Execute
            if( $this->db->execute() ){
                return true;
            } else {
                return false;
            }
        }

        public function getTaskById($id)
        {
            $this->db->query('SELECT * FROM tasks WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            return $this->db->single();
        }

        public function alterToActive($id)
        {
            $this->db->query("UPDATE tasks SET status = 'active' where id = :id");
           // Bind values
           $this->db->bind(':id', $id);

            if( $this->db->execute() ){
                return true;
            } else {
                return false;
            }
        }

        public function updateTask($data)
       {
           $this->db->query('UPDATE tasks SET name = :name, email = :email, task = :task where id = :id');
           // Bind values
           $this->db->bind(':id', $data['id']);
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':email', $data['email']);
           $this->db->bind(':task', $data['task']);

           // Execute
           if( $this->db->execute() ){
               return true;
           } else {
               return false;
           }
       }

    }