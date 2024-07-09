<?php
namespace Controllers;

use Models\User;
class CheckUserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function checkUser($id) {
        $result = $this->user->findById($id);
        if ($result->num_rows > 0) {
            return ['status' => 'success', 'message' => 'User found'];
        } else {
            return ['status' => 'error', 'message' => 'Ссылка на голосование недоступна, свяжитесь с нами по телефону'];
        }
    }
}
?>
