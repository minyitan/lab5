<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use CodeIgniter\Controller;
/**
 * Description of newPHPClass
 *
 * @author Admin
 */
class Pages extends Controller{
    //put your code here
     public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
         if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
    {
        // Whoops, we don't have a page for that!
        throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data['title'] = ucfirst($page); // Capitalize the first letter

    echo view('templates/header', $data);
    echo view('pages/'.$page, $data);
    echo view('templates/footer', $data);
    }
}
