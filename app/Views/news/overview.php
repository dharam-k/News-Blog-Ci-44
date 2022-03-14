<br>
<br><br>
<?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-warning w-75" style="margin:auto;">
       <?= session()->getFlashdata('msg') ?>
    </div>
<?php endif;?>

<div class="container border mt-3 pt-5">
<h2 class="text-center"><?= esc($title) ?></h2>

<div class="container pt-3">

<?php if (! empty($news) && is_array($news)): ?>

<div class="container d-flex flex-row flex-wrap m-2">

    <?php foreach ($news as $news_item): ?>

        <div class="card m-2">
            <?php      
             if(session()->get('isLoggedIn')){
                ?>
                <div>
                     <a href="<?php  echo base_url('ci4/public/news/edit/'. $news_item['id']) ?>" class="btn border m-2" style="color: green">Edit</a>
                     <a href=" <?php  echo base_url('ci4/public/news/delete/'. $news_item['id']) ?>" class="btn border m-2 " style="color: red">Delete</a>
                </div>
                <?php
              }
            ?>
          <img src="/ci4/public/uploads/<?= esc($news_item['image']) ?>" class="card-img-top" alt="..." style='height: 200px; width: 300px'>

          <div class="card-body " style="width: 15rem; height: 15rem; overflow: hidden;">
            
            <h5 class="card-title"><?= esc($news_item['title']) ?></h5>
            <p class="card-text"><?= esc($news_item['body']) ?></p>
            
          </div>
          <a href="/ci4/public/news/<?= esc($news_item['slug'], 'url') ?>" class="btn btn-primary">View News</a>
        </div>

    <?php endforeach ?>
</div>
<?php else: ?>

    <h4>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>

</div>
</div>