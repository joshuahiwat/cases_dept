<?php
    $movieId = substr($_GET['movie'], 7);

    $api = new api('123');
    $movie = $api->getApiData(
        [
            'method' => 'movies',
            'titleName' => urldecode($_GET['movieName']),
        ]
    );

	include 'includes/head.php';
?>

<body class="body">

<?php
	include 'includes/header.php';
?>

	<!-- details -->
	<section class="section section--details section--bg" data-bg="img/section/details.jpg">
		<!-- details content -->
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<h1 class="section__title">I Dream in Another Language</h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-lg-6">
					<div class="card card--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-5 col-lg-6 col-xl-5">
								<div class="card__cover">
									<img src="img/covers/cover.jpg" alt="">
									<span class="card__rate card__rate--green">8.4</span>
								</div>
							</div>
							<!-- end card cover -->

							<!-- card content -->
							<div class="col-12 col-sm-7 col-lg-6 col-xl-7">
								<div class="card__content">
									<ul class="card__meta">
										<li><span>Title:</span> Vince Gilligan</li>
										<li><span>Release year:</span> 2019</li>
									</ul>
								</div>
							</div>
							<!-- end card content -->
						</div>
					</div>
				</div>
				<!-- end content -->

				<!-- player -->
				<div class="col-12 col-lg-6">
					<video controls crossorigin playsinline poster="../../../../cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
						<!-- Video files -->
						<source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">
						<source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">
						<source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080">

						<!-- Caption files -->
						<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
						    default>
						<track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

						<!-- Fallback for browsers that don't support the <video> element -->
						<a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
					</video>
				</div>
				<!-- end player -->
			</div>
		</div>
		<!-- end details content -->
	</section>
	<!-- end details -->

<?php
	include 'includes/footer.php';
?>
