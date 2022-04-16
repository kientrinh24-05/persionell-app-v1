<?php

include('./autoload/Autoload.php');


$title = "Tin tức";

$sql = "SELECT * FROM  baiviet ORDER BY id DESC";
$posts =  $DB->query($sql);


$categories = $DB->query('SELECT * FROM  danhmuc_blog');

include('./layouts/page/header.php');


?>
<!-- Start Middle -->
<div id="middle">
    <div class="headline cmsmasters_color_scheme_default">
    </div>
    <div class="middle_inner">
        <div class="content_wrap r_sidebar">

            <!-- Start Content -->
            <div class="content entry">
                <div id="cmsmasters_row_a0e7e99483" class="cmsmasters_row cmsmasters_color_scheme_default cmsmasters_row_top_default cmsmasters_row_bot_default cmsmasters_row_boxed">
                    <div class="cmsmasters_row_outer_parent">
                        <div class="cmsmasters_row_outer">
                            <div class="cmsmasters_row_inner">
                                <div class="cmsmasters_row_margin">
                                    <div id="cmsmasters_column_" class="cmsmasters_column one_first">
                                        <div class="cmsmasters_column_inner">
                                            <div id="blog_49ae717791" class="cmsmasters_wrap_blog entry-summary" data-layout="standard" data-layout-mode="" data-url="https://devicer.cmsmasters.net/wp-content/plugins/cmsmasters-content-composer/" data-orderby="date" data-order="ASC" data-count="3" data-categories="business,hi-tech,trends" data-metadata="date,categories,author,comments,likes,more" data-pagination="more">
                                                <div class="blog standard">
                                                    <?php if (is_array($posts)) : ?>
                                                        <?php foreach ($posts as $post) : ?>
                                                            <article id="post-85" class="cmsmasters_post_default post-85 post type-post status-publish format-image has-post-thumbnail hentry category-hi-tech post_format-post-format-image">
                                                                <div class="cmsmasters_post_cont_wrap">
                                                                    <img width="860" height="508" src="./wp-content/uploads/2017/06/blog5-2-860x508.jpg" class="" alt="Best care and support at Our Stores" title="blog5" srcset=" <?= BASE_URL . '/' . $post->hinhanh ?> " sizes="(max-width: 860px) 100vw, 860px" />
                                                                    <div class="cmsmasters_post_cont enable_image">
                                                                        <header class="cmsmasters_post_header entry-header">
                                                                            <h3 class="cmsmasters_post_title entry-title"><a href="blog-detail.php?id=<?= $post->id ?>"><?= $post->tieude ?></a></h3>
                                                                        </header>
                                                                        <div class="cmsmasters_post_cont_info entry-meta"><span class="cmsmasters_post_date"><?= formatDate($post->created_at) ?></span></div>
                                                                        <div class="cmsmasters_post_content entry-content">
                                                                            <p><?= $post->tieude ?></p>
                                                                        </div>
                                                                        <a class="cmsmasters_post_read_more" href="blog-detail.php?id=<?= $post->id ?>">Chi tiết</a>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                        <?php endforeach ?>
                                                    <?php endif ?>

                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cl"></div>
            </div>
            <!-- Finish Content -->


            <!-- Start Sidebar -->
            <div class="sidebar">
                <aside id="categories-2" class="widget widget_categories">
                    <h3 class="widgettitle">Danh mục</h3>
                    <ul>
                        <?php foreach ($categories as $category) :?>
                            <li class="cat-item cat-item-16"><a href="#"><?= $category->tendanhmuc ?></a>
                            </li>
                         <?php endforeach ?>
                    </ul>
                </aside>
            </div>
            <!-- Finish Sidebar -->


        </div>
    </div>
</div>
<!-- Finish Middle -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=543121906576699&autoLogAppEvents=1" nonce="UU6IAsrA"></script>
<?php include('./layouts/page/footer.php') ?>