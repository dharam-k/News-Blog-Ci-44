<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $allowedFields = ['title', 'slug', 'body', 'cat','cat_id', 'image'];

    public function getNews($slug = false)
	{
	    if ($slug === false) {
	        return $this->findAll();
	    }

	    return $this->where(['slug' => $slug])->first();
	}

	public function getCat($cat = false)
	{

		if ($cat === false) {
	        return $this->findAll();
	    }

	    return $this->where(['cat' => $cat])->findAll();
	}


	public function search($value)
	{
		return $this->like('title', $value)->findAll(); 
	}


}

