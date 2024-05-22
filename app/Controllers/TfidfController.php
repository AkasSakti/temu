<?php namespace App\Controllers;

use App\Models\DocumentModel;
use CodeIgniter\Controller;

class TfidfController extends Controller
{
    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $documentModel = new DocumentModel();
            $documents = $documentModel->like('content', $keyword)->findAll();

            // Menghitung TF-IDF
            $tfidfMatrix = $this->computeTFIDF($documents);
        } else {
            // Jika tidak ada kata kunci, kembalikan dokumen kosong
            $documents = [];
            $tfidfMatrix = [];
        }

        // Menampilkan hasil pencarian dan TF-IDF
        return view('tfidf_view', ['tfidfMatrix' => $tfidfMatrix, 'keyword' => $keyword]);
    }


    public function index()
    {
        helper('form');
        echo view('search_form');
        $documentModel = new DocumentModel();
        $documents = $documentModel->findAll();

        // Menghitung TF-IDF
        $tfidfMatrix = $this->computeTFIDF($documents);

        // Menampilkan hasil TF-IDF
        return view('tfidf_view', ['tfidfMatrix' => $tfidfMatrix]);
    }
    private function computeTFIDF($documents)
    {
        $tf = [];
        $idf = [];
        $tfidf = [];
        $numDocs = count($documents);
        $docWords = [];

        // Preprocessing dan menghitung TF
        foreach ($documents as $doc) {
            $words = explode(' ', strtolower($doc['content']));
            $docWords[$doc['id']] = array_count_values($words);
            foreach ($words as $word) {
                if (isset($tf[$doc['id']][$word])) {
                    $tf[$doc['id']][$word] += 1;
                } else {
                    $tf[$doc['id']][$word] = 1;
                }
            }
        }

        // Menghitung IDF
        $wordDocCount = [];
        foreach ($docWords as $docId => $words) {
            foreach ($words as $word => $count) {
                if (isset($wordDocCount[$word])) {
                    $wordDocCount[$word] += 1;
                } else {
                    $wordDocCount[$word] = 1;
                }
            }
        }

        foreach ($wordDocCount as $word => $count) {
            $idf[$word] = log($numDocs / $count);
        }

        // Menghitung TF-IDF
        foreach ($tf as $docId => $words) {
            foreach ($words as $word => $count) {
                $tfidf[$docId][$word] = $count * $idf[$word];
            }
        }

        return $tfidf;
    }
}
