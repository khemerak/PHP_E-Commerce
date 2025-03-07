<?php
require_once 'base.php';

class Product extends Base {
    protected $table = "products";
    
    protected function getPrimaryKey() {
        return "product_id";
    }
    
    public function findById($id) {
        $query = "SELECT * FROM {$this->table} WHERE product_id = :id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':id', $id);
        $statements->execute();
        return $statements->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createProduct($name, $description, $price, $stock_quantity, $image = null) {
        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'image' => $image,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($data);
    }
    
    public function updateProduct($product_id, $name, $description, $price, $stock_quantity, $image = null) {
        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'image' => $image,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->update($product_id, $data);
    }
    
    public function deleteProduct($product_id) {
        $query = "DELETE FROM {$this->table} WHERE product_id = :product_id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(":product_id", $product_id);
        return $statements->execute();
    }
    
    public function getProductCount() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function getAllProducts($limit = null, $offset = null) {
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
    
    public function checkProductExists($name) {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE name = :name";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':name', $name);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>