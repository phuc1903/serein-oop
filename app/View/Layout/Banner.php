<?php

if(isset($data['banner'])):
    $banner = $data['banner'];
    extract($banner);
?>

<div class="banner">
    <img class="banner_background" src="<?=BASE_PATH.'/'.$background?>" alt="">
    <div class="grid wide">
        <div class="row">
            <div class="col l-6 banner__left-main">
                <div class="banner__left">
                    <h3><?=$collection?></h3>
                    <h2><?=$title?></h2>
                    <span><?=$des?></span>
                    <a href="<?=BASE_PATH.''.$link?>" class="banner-bottom-left" style="display: block;">
                        <button type="submit" name=""><?=$action?></button>
                    </a>
                </div>
            </div>
            <div class="col l-2">
            </div>
            <div class="col l-4">
                <div class="banner__right">
                    <div class="banner-right-img">
                        <img src="<?=$img?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

endif;

?>