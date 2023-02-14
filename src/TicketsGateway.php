<?php

class TicketsGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM ticket";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $row["estatus"] = (bool) $row["estatus"]?'Abierto':'Cerrado';
            
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function create(array $data): string
    {
        $sql = "INSERT INTO ticket (user, descripcion)
                VALUES (:name, :description)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":name", $data["user"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["descripcion"] ?? 0, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $this->conn->lastInsertId();
    }
    
    public function get(string $id)
    {
        $sql = "SELECT *
                FROM ticket
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data !== false) {
            $data["estatus"] = (bool) $data["estatus"]?'Abierto':'Cerrado';
        }
        
        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE ticket
                SET update_at = :update, estatus = :estatus
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":update", $new["update"] ?? $current["update"], PDO::PARAM_STR);
        $stmt->bindValue(":estatus", $new["estatus"] ?? $current["estatus"], PDO::PARAM_INT);        
        
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM ticket
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}











