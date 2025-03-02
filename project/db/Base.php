<?php
require_once __DIR__ . '/db_connections.php';
abstract class Base
{
    protected $db;
    protected $table;
    public function __construct()
    {
        $database = new Database_Conntections();
        $this->db = $database->connect();
    }
    public function selectAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $statements = $this->db->prepare($query);
        $statements->execute();
        return $statements->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$this->getPrimaryKey()} = :id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':id', $id);
        $statements->execute();
        return $statements->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $statements = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $statements->bindValue(":$key", $value);
        }
        return $statements->execute();
    }
    public function update($id, $data)
    {
        $set_parts = [];
        foreach (array_keys($data) as $key) {
            $set_parts[] = "$key = :$key";
        }
        $set_string = implode(', ', $set_parts);

        $query = "UPDATE {$this->table} SET $set_string WHERE {$this->getPrimaryKey()} = :id";
        $statements = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $statements->bindValue(":$key", $value);
        }
        $statements->bindValue(':id', $id);

        return $statements->execute();
    }
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE {$this->getPrimaryKey()} = :id";
        $statements = $this->db->prepare($query);
        $statements->bindParam(':id', $id);
        return $statements->execute();
    }
    abstract protected function getPrimaryKey();
}
?>