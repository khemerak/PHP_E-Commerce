<?php
require_once 'base.php';

class Category extends Base {
    protected $table = "categories";
    
    protected function getPrimaryKey() {
        return "category_id";
    }
    
    public function findByName($name) {
        $query = "SELECT * FROM {$this->table} WHERE name = :name";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':name', $name);
        $statements->execute();
        return $statements->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createCategory($name, $description = null) {
        $data = [
            'name' => $name,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($data);
    }
    
    public function updateCategory($category_id, $name, $description = null) {
        $data = [
            'name' => $name,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->update($category_id, $data);
    }
    
    public function deleteCategory($category_id) {
        $query = "DELETE FROM {$this->table} WHERE category_id = :category_id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(":category_id", $category_id);
        return $statements->execute();
    }
    
    public function getCategoryCount() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function getAllCategories($limit = null, $offset = null) {
        $query = "SELECT * FROM {$this->table} ORDER BY name ASC";
        if ($limit !== null && $offset !== null) {
            $query .= " LIMIT :limit OFFSET :offset";
        }
        $statements = $this->db->prepare($query);
        if ($limit !== null && $offset !== null) {
            $statements->bindParam(':limit', $limit, PDO::PARAM_INT);
            $statements->bindParam(':offset', $offset, PDO::PARAM_INT);
        }
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function searchCategories($searchTerm) {
        $query = "SELECT * FROM {$this->table} WHERE category_id LIKE :search OR name LIKE :search";
        $statements = $this->db->prepare($query);
        $searchParam = "%" . $searchTerm . "%";
        $statements->bindParam(':search', $searchParam);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function checkCategoryExists($name) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE name = :name";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':name', $name);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>