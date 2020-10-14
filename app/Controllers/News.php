<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Controller;

/**
 * Description of News
 *
 * @author Admin
 */
class News extends Controller {

    //put your code here
    public function index() {
       
        $model = new NewsModel();
        
        $data = [
            'news' => $model->getNews(),
            'title' => 'tanminyi News archive',
        ];
 
        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
        //echo "Controller";
    }

    public function view($slug = null) {
        $model = new NewsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
    }
public function create()
{
    $model = new NewsModel();

    if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ]))
    {
        $model->save([
            'title' => $this->request->getPost('title'),
            'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
            'body'  => $this->request->getPost('body'),
        ]);

        echo view('news/success');

    }
    else
    {
        echo view('templates/header', ['title' => 'Create a news item']);
        echo view('news/create');
        echo view('templates/footer');
    }
}
}
