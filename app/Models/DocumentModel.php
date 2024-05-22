<?php namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content'];

    public function addDocument($data)
    {
        return $this->insert($data);
    }
/*
    public function search($keyword)
    {
        // Perhatikan penulisan method dan query di bawah ini
        return $this->db->query("SELECT *, MATCH(title, content) AGAINST(? IN BOOLEAN MODE) AS relevance FROM documents WHERE MATCH(title, content) AGAINST(? IN BOOLEAN MODE)", [$keyword, $keyword])->getResultArray();
    }*/
}
