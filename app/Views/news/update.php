<br>
<br>
<br>

<div class="container shadow border p-5 mt-5 w-50" style="margin-left: 30%;">
	<?= session()->getFlashdata('error') ?>
    <?= service('validation')->listErrors() ?>
	<h2><?= esc($news_title) ?></h2>
	<form action="/ci4/public/news/update" method="post" enctype='multipart/form-data'>
	    <?= csrf_field() ?>

	    <label for="title" class="form-label">News Title</label>
	    <input type="input" class="form-control" value="<?php if(isset($update_data['title'])){echo $update_data['title'];} ?>" name="title" /><br />

	    <label for="body" class="form-label">News Content</label>
	    <textarea name="body" class="form-control"  cols="45" rows="4"><?php if(isset($update_data['body'])){echo $update_data['body'];} ?></textarea><br />
		<div class="mb-3">
		  <label for="formFile" class="form-label">Image Uplaod</label>
		  <input class="form-control" value="<?php if(isset($update_data['image'])){echo $update_data['image'];} ?>" type="file" name="file" id="formFile">
		</div>	    
	    <label for="body" class="form-label">News Category</label>
	    <select class="form-select" name="cat" aria-label="Default select example">
	    	<?php 

		    	if(isset($update_data['cat'])){
			    	foreach($data['cat'] as $cat_list){

			    		if($update_data['cat']==$cat_list['cat_name']){
			    			continue;
			    		}
				    		?>
				    		 <option value="<?php echo $cat_list['cat_name'];?>"><?php echo $cat_list['cat_name'];?></option>
				    		<?php 
			    	}
			    	echo '<option selected>'.$update_data['cat'] .'</option>';		    		
			    }else{
			    	echo '<option selected>Select Category</option>';

			    	foreach($data['cat'] as $cat_list){
			    		?>
			    		<option value="<?php echo $cat_list['cat_name'];?>"><?php echo $cat_list['cat_name'];?></option>
			    		<?php 
			    	   }
			    } 

		    ?>
	

		</select>
		<br>
		
		<button type="submit" class="btn btn-primary mt-2" name="submit">Update News</button>

	</form>
</div>