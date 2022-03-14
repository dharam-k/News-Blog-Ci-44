<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {

    $model = model(NewsModel::class);

    $data = [
        'news'  => $model->getNews(),
        'title' => 'All News',
    ];

    echo view('templates/header');
    echo view('news/overview', $data);
    echo view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);


        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view('templates/header');
        echo view('news/view', $data);
        echo view('templates/footer');
    }

    public function world()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getCat('world'),
            'title' => 'World News',
        ];

    echo view('templates/header');
    echo view('news/overview', $data);
    echo view('templates/footer');

    }    

    public function sport()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getCat('sports'),
            'title' => 'Sport News',
        ];

    echo view('templates/header');
    echo view('news/overview', $data);
    echo view('templates/footer');

    }  

    public function business()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getCat('business'),
            'title' => 'Business News',
        ];

    echo view('templates/header');
    echo view('news/overview', $data);
    echo view('templates/footer');

    }  

    public function science()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getCat('science'),
            'title' => 'Science News',
        ];

    echo view('templates/header');
    echo view('news/overview', $data);
    echo view('templates/footer');

    }         

    public function create()
    {
        helper(['form', 'url']);      
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required',
            'body'  => 'required',
            'cat'  => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
            ],
            ])) 
        {

            $newsImage = $this->request->getFile('file');

            $newsImage->move(ROOTPATH . 'public/uploads');

            $img=$newsImage->getClientName();

            $model->save([
                'title' => $this->request->getPost('title'),
                'slug'  => url_title($this->request->getPost('title'), '-', true),
                'body'  => $this->request->getPost('body'),
                'cat_id' => '',
                'cat'   => $this->request->getPost('cat'),
                'image' =>  $img,
            ]); 


            return redirect()->to( base_url('ci4/public/news') );

        } else {

        $cat_select = model(CatSelect::class);

        $data = [
            'cat'  => $cat_select->catSelect(),
        ]; 

        echo view('templates/header', ['news_title' => 'Create a News']);
        echo view('news/create',array('data'=>$data));
        echo view('templates/footer');

        }
    }

    public function search(){

        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'news_search' => 'required',])){

            $search_value=$this->request->getPost('news_search');

            $data = [
                'news'  => $model->search($search_value),
            ];             

        }

        echo view('templates/header');
        echo view('news/overview', $data);
        echo view('templates/footer');

    }

    public function login()
    {

    $session = session();
    helper(['form', 'url']);

    $login = model(LoginDetail::class);

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $data=$login->where('admin_email',$email)->first();

    // echo "<pre>";
    // print_r($login) ;
    // die();

    if($data){
        $pass = $data['admin_password'];

         if($password===$pass){

            $ses_data = [
                'id' => $data['admin_id'],
                'name' => $data['admin_name'],
                'email' => $data['admin_email'],
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);

            return redirect()->to( base_url('ci4/public/news') );
         }else{
            $session->setFlashdata('msg', 'Password is incorrect.');
            return redirect()->to( base_url('ci4/public/news') );
         }
    }else{
        $session->setFlashdata('msg', 'This email is not exists.');
        return redirect()->to( base_url('ci4/public/news') );
    }
    }


    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('ci4/public/news') );
    }

    public function delete($id = null){

        $model = model(NewsModel::class);

        $model->where('id', $id)->delete();

        return redirect()->to( base_url('ci4/public/news') );
    }

    public function edit($id=null)
    {
        $session=session();
        helper(['form', 'url']);
        $model = model(NewsModel::class);
        $data_match=$model->where('id', $id)->first();

        $data_update=[
            'id'=>$data_match['id'],
            'title'=>$data_match['title'],
            'slug' => $data_match['slug'],
            'body' => $data_match['body'],
            'cat'=> $data_match['cat'],
            'image'=>$data_match['image'] 
        ];

        $id = [
            'id'=>$data_match['id']
        ];

        $session->set($id);

        $cat_select = model(CatSelect::class);

        $data = [
            'cat'  => $cat_select->catSelect(),
        ]; 

        echo view('templates/header', ['news_title' => 'Create a News']);
        echo view('news/update', array(
                                        'update_data'=> $data_update,
                                        'data' => $data
                                    ));
        echo view('templates/footer');
        
    }


    public function update()
    {
        $session=session();
        helper(['form', 'url']);      
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required',
            'body'  => 'required',
            'cat'  => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
            ],
            ])) 
        {
            $model = model(NewsModel::class);
            $newsImage = $this->request->getFile('file');
            $newsImage->move(ROOTPATH . 'public/uploads');
            $img=$newsImage->getClientName();

            $id=$session->get('id');

            $title=$this->request->getPost('title');
            $slug=url_title($this->request->getPost('title'), '-', true);
            $body=$this->request->getPost('body');
            $cat=$this->request->getPost('cat');
            $image=$img;

            $model->set('title',$title)->
                    set('slug',$slug)->
                    set('body',$body)->
                    set('cat',$cat)->
                    set('image',$image)->where('id', $id)->update();

            return redirect()->to( base_url('ci4/public/news') );

        }

    }


}