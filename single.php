<?php get_header(); ?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><?php the_title(); ?></h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>