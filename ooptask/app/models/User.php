<?php

    class User{

        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function login($login,$password)
        {
            $this->db->query('SELECT * from users where name = :name');
            $this->db->bind(':name', $login);
            $row = $this->db->single();

            $hashed_password = $row->password;
            if ( password_verify($password,$hashed_password) ) {
                return $row;
            } else {
                return false;
            }
        }
}