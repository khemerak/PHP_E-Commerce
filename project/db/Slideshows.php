<?php 
require_once 'Base.php';
class Slideshows extends Base {
    protected $table = 'slideshows';
    protected function getPrimaryKey() {
        return 'id';
    }
    public function findById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':id', $id);
        $statements->execute();
        return $statements->fetch(PDO::FETCH_ASSOC);
    }
    public function createSlideshow($image_path, $caption, $slide_order) {
        $data = [
            'image_path' => $image_path,
            'caption' => $caption,
            'slide_order' => $slide_order
        ];
        return $this->insert($data);
    }
    public function updateSlideshow($id, $image_path = null, $caption = null, $slide_order = null) {
        $data = [];
        if ($image_path !== null) $data['image_path'] = $image_path;
        if ($caption !== null) $data['caption'] = $caption;
        if ($slide_order !== null) $data['slide_order'] = $slide_order;
        
        if (!empty($data)) {
            return $this->update($id, $data);
        }
        return false;
    }
    public function deleteSlideshow($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':id', $id);
        return $statements->execute();
    }
    public function searchByCaption($caption) {
        $query = "SELECT * FROM {$this->table} WHERE caption LIKE :caption ORDER BY slide_order ASC";
        $statements = $this->db->prepare($query);
        $searchTerm = "%{$caption}%";
        $statements->bindParam(':caption', $searchTerm);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll($limit = 10, $offset = 0) {
        $query = "SELECT * FROM {$this->table} ORDER BY slide_order ASC LIMIT :limit OFFSET :offset";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statements->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSlideshowCount() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        $result = $statements->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>