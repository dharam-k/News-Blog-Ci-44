<?php

namespace App\Models;

use CodeIgniter\Model;

class CatSelect extends Model
{

    protected $table = 'category';

    protected $allowedFields = ['cat_name'];

    public function catSelect($cat = false){

		if ($cat === false) {
	        return $this->findAll();
	    }

	    return $this->where(['cat' => $cat])->findAll();    	
	}

}