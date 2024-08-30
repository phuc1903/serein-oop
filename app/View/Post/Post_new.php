<section class="posts product container">
    <div class="grid wide">
        <div class="product-section">
            <h3>Bài viết mới</h3>
            <?= $this->gotoPosts();?>
        </div>
        <div class="row">
            <?php

            $post_new = $data['post_new'];

            foreach($post_new as $item):
                extract($item);
            ?>
            <div class="col l-4">
                <div class="posts-item">
                    <div class="post-item-img"><img src="<?=$img?>" alt=""></div>
                    <div class="post-item-datetime"><?=$created_at?></div>
                    <div class="post-item-name"><?=$title?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>