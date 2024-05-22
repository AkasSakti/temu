<?php 

namespace App\Controllers;

use App\Models\DocumentModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/add_document');
    }

    public function addDocument()
    {
        $documentModel = new DocumentModel();

        // Ambil data dari form
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        // Simpan data ke database
        $data = [
            'title' => $title,
            'content' => $content
        ];

        $documentModel->insert($data);

        // Redirect ke halaman utama admin setelah penambahan berhasil
        return view('admin/add_document');
    }
    public function saveDocument()
{
    // Tangani penambahan dokumen di sini
}
}
