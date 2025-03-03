<?php
require_once 'base.php';
class User extends Base {
    protected $table = "users";
    protected function getPrimaryKey() {
        return "user_id";
    }
    public function findByUsername($username) {
        $query = "SELECT * FROM {$this->table} WHERE username = :username";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':username', $username);
        $statements->execute();
        return $statements->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role' => 'customer'
        ];
        return $this->insert($data);
    }
    public function updatePassword($user_id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $data = ['password' => $hashed_password];
        return $this->update($user_id, $data);
    }
    public function deleteUser($user_id) {
        $query = "DELETE FROM {$this->table} WHERE user_id = :user_id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(":user_id", $user_id);
        return $statements->execute();
    }
    public function checkAdmin($username) {
        $user = $this->findByUsername($username);
        if ($user && isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }
    public function verifyPasswordMatch($password, $confirm_password) {
        return $password === $confirm_password;
    }
    public function getUserCount() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getAllUsers() {
        $query = "SELECT * FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchUsers($searchTerm) {
        $query = "SELECT * FROM {$this->table} WHERE user_id LIKE :search OR username LIKE :search";
        $statements = $this->db->prepare($query);
        $searchParam = "%" . $searchTerm . "%";
        $statements->bindParam(':search', $searchParam);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>