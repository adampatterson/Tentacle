<div class="navbar-fixed-bottom">
    <div class="navbar-inner">
        <div class="navbar navbar-fixed-bottom" style="position: absolute;">
            <div class="navbar-inner">
                <div class="container" style="width: auto; padding: 0 20px;">
                    <ul class="nav pull-left">
                        <li><a href="<?= ADMIN ?>/">Dashboard</a></li>
                        <li><a href="<?= ADMIN ?>content_update_post/<?= $post->id;?>">Edit</a></li>
                        <li><a href="<?= BASE_URL ?>action/trash_post/<?= $post -> id;?>">Trash</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= ADMIN ?>content_add_page/">Write a new page</a></li>
                                <li><a href="<?= ADMIN ?>content_manage_pages/">Manage pages</a></li>
                                <li><a href="<?= ADMIN ?>content_add_post/">Write a new post</a></li>
                                <li><a href="<?= ADMIN ?>content_manage_posts/">Manage posts</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-heart"></i> Help <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="https://github.com/adampatterson/Tentacle/wiki" target="_blank">Documentation</a></li>
                                <li><a href="https://github.com/adampatterson/Tentacle/wiki/Reporting-a-bug" target="_blank">Submit an Issue</a></li>
                                <li><a href="https://github.com/adampatterson/Tentacle/wiki/Credits">Credits</a></li>
                            </ul>
                        </li>
                        <li> <a href="<?= ADMIN ?>logout/">Logout</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a href="http://tentaclecms.com"><img src="<?= ADMIN_URL.'/images/tentacle_logo_footer.png' ?>" alt="Tentacle CMS" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
