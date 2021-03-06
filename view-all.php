<!doctype html>
<html lang="en">

<head>
    <!-- Execute php -->
    <?php
    require_once("php/rest-all.php"); // Execute php rest script
    require_once("php/functions.php"); // Include helper functions for articles and archived photos
    ?>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" rel="stylesheet" href="styles/style.css">

    <!-- Favicons -->
    <link rel="icon" href="https://thelasallian.com/wp-content/uploads/2020/06/LOGO.png" sizes="32x32" />
    <link rel="icon" href="https://thelasallian.com/wp-content/uploads/2020/06/LOGO.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://thelasallian.com/wp-content/uploads/2020/06/LOGO.png" />
    
    <!-- Title -->
    <title>All Articles - The LaSallian: From the Archives</title>
</head>

<body>
    <header class="subpage-header py-5">
        <div class="container">
            <a class="homepage-link d-inline-block mb-3 fst-italic" href="index.php">← Back to Homepage</a>
            <div class="d-flex align-items-center flex-column flex-md-row">
                <img class="me-md-4" src="images/old-tls-star.png" alt="">
                <h1 class="lh-1 m-0 text-white text-center text-md-start">
                    <span class="subpage-title fw-bold">All Articles</span><br/>
                    <span class="subpage-subtitle fs-4">From the Archives</span>
                </h1>
            </div>
        </div>
    </header>

    <main class="articles py-5">
        <div class="container">
            <!-- Fetch all articles -->
            <?php $allArticles = $_SESSION["ARTICLE_INFO"]; ?>

            <!-- Group articles by writing section -->
            <?php
            groupBySection($allArticles, $opedArticles,
                $menageArticles, $sportsArticles,
                $univArticles, $vangieArticles);

            if (count($univArticles) > 0)
                renderSection("University", $univArticles, $allArticles);

            if (count($menageArticles) > 0)
                renderSection("Menagerie", $menageArticles, $allArticles);

            if (count($sportsArticles) > 0)
                renderSection("Sports", $sportsArticles, $allArticles);

            if (count($vangieArticles) > 0)
                renderSection("Vanguard", $vangieArticles, $allArticles);

            if (count($opedArticles) > 0)
                renderSection("Opinion", $opedArticles, $allArticles);

            ?>
        </div>
    </main>

    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6 d-flex justify-content-center align-self-center align-items-lg-start text-center">
                    <figure>
                        <!-- Logo -->
                        <img src="images/old-tls-wordmark.png" alt="TLS Name Logo" class="footer-logo mb-4 img-fluid">
                        <!-- Logo Heading -->
                        <figcaption class="footer-heading"><strong>Archives Website</strong></figcaption>
                    </figure>
                </div>
                <div class="col-sm-12 col-lg-6 d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
                    <!-- Description -->
                    <p class="footer-description">
                        <strong>The LaSallian</strong> is the official student publication of De La Salle University.
                        It is of the students, by the students, and for the students. Our student writers, photographers,
                        videographers, and web managers are committed to the 61-year tradition of journalistic excellence
                        and issue-oriented critical thinking.
                    </p>
                    <!-- Link to Main Website -->
                    <p class="footer-link-main-site"><a href="https://thelasallian.com"><strong>Go to Main Website →</strong></a></p>
                    <!-- Website Developers -->
                    <p class="footer-developers mt-3">Website by <a href="https://github.com/angelocguerra" class="fs-5" target="_blank">Angelo Guerra</a> & <a href="https://github.com/ronnparcia" class="fs-5" target="_blank">Ronn Parcia</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Masonry -->
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

</body>

</html>

<?php

function renderSection($sectionName, $secArticles, $allArticles)
{
    echo "<h1 class='fw-bold fs-2 mb-3' style='color: #382215'>$sectionName</h1>";

    echo '<div class="row row-cols-1 row-cols-md-2 g-3 mb-5">';
    foreach ($secArticles as $i)
    {
        getArticleInfo($allArticles, $i, $date, $link, $title, $visual, $authors, $category, $excerpt);
        renderSmallArticleCard($date, $link, $title, $visual);
    }
    echo '</div>';

    
}

function renderSmallArticleCard($date, $link, $title, $visual)
{
    $date = date('F j, Y', strtotime($date));
    
    echo <<<COL_CARD
    <div class="col">
        <a href="{$link}" target="_blank">
            <!-- Card -->
            <div class="card h-100 border-0 overflow-hidden">
                <div class="row g-0 d-f h-100">
                    <!-- Left Side -->
                    <div class="col-3 col-sm-3 col-lg-4 overflow-hidden" style="min-height: 7rem; max-height: 10rem">
                        <img class="card-img rounded-0 w-100 h-100" style="object-fit: cover;" src="{$visual}" alt="" loading="lazy">
                    </div>
                    <!-- Right Side -->
                    <div class="col-9 col-sm-9 col-lg-8 d-flex h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title fw-bold">{$title}</h5>
                            <p class="card-text">{$date}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    COL_CARD;
}

?>