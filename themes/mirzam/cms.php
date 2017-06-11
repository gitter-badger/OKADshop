<div id="main-container">
    <div class="cms-content container">
        <aside class="col-sm-3 side-bar">
            <div class="widget recent-post">
                <?php

                /*
                var_dump($cms['CMSRelatedArticles']->cms_list);
                die();
                $CMSRelatedArticles = $cms['CMSRelatedArticles'];
                
                foreach($CMSRelatedArticles as $cms_articles)
                {
                    var_dump($cms_articles);
                    break;
                } 
                */
                ?>
                <h4 class="title"><?= $cms['CMSCAT']->title;?></h4>
                <ul>
                    <li>
                        <a href="#" class="post-title">Mobile</a>
                    </li>
                    <li>
                        <a href="#" class="post-title">Payments</a>
                    </li>
                    <li>
                        <a href="#" class="post-title">Shipping</a>
                    </li>
                    <li>
                        <a href="#" class="post-title">Get OKADshop</a>
                    </li>
                    <li>
                        <a href="#" class="post-title">Colors & functionnalities</a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="col-md-9 col-sm-8">
            <div class="title-section text-center">
                <h2 class="title"><?= $cms['CMS']->title; ?></h2>
            </div>

            <p>
                <?= $cms['CMS']->content; ?>
            </p>
        </div>
    </div>
</div>