<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
    <style>
        .tml-links {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .tml .tml-action-confirmaction .success,
        .tml .tml-error,
        .tml .tml-message,
        .tml .tml-success {
            box-shadow: none;
        }

        .tml .tml-error {
            background-color: #dc323210;
        }

        .tml .tml-message {
            background-color: #00a0d210;
        }

        .tml .tml-success {
            background-color: #46b45010;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <h1 class="h2"><?php the_title(); ?></h1>
                                </div>
                                <div class="m-sm-4">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php wp_footer(); ?>

</body>

</html>