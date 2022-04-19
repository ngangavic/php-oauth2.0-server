<?php

class User extends Database
{

    private $db;

    public $email;
    public $password;

    public function __construct()
    {
        $this->db = new Database();
    }

    function AddUser()
    {
        $clientId = substr(md5(strstr($this->email, '@', true)), 0, 50);
        $clientSecret = substr(md5($this->email), 0, 50);
        $password = md5($this->password);
        $data = $this->db->Insert(
            "INSERT INTO `oauth_users`(`username`, `password`,`email`) VALUES (:username,:password,:email)",
            ["username" => $this->email, "password" => $password, "email" => $this->email]
        );
        $data = $this->db->Insert(
            "INSERT INTO `oauth_clients`(`client_id`, `client_secret`,`user_id`) VALUES (:client_id,:client_secret,:user_id)",
            ["client_id" => $clientId, "client_secret" => $clientSecret, "user_id" => $this->email]
        );
    }

    function Login()
    {
        $data = $this->db->Select("SELECT * FROM `oauth_users` WHERE `username`=:username AND `password`=:password ", ["username" => $this->email, "password" => md5($this->password)]);
        if ($data) {
            $_SESSION['email'] = $this->email;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function GetTokens()
    {
        $data = $this->db->Select("SELECT * FROM `oauth_access_tokens` WHERE `user_id`=:userid", ["userid" => $_SESSION['email']]);
        return  $data;
    }

    function GetSecrets()
    {
        return $this->db->Select("SELECT * FROM `oauth_clients` WHERE `user_id`=:userid", ["userid" => $_SESSION['email']]);
    }
}
