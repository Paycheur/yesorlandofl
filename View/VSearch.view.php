<?php
class VSearch
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function homeSearch($_value)
	{

		?>
		<div class="content" id="holer-content">

			<div class="container">


				<?php require_once('components/search-form.php') ?>



			</div>

			<div class="container">
				<div class="row" id="searchResult">
					<?php
					if(isset($_value['results']) && count($_value['results']) > 0)
					{
						foreach($_value['results'] as $d)
						{
						if(isset($d['img']))
						{
							$allImg = explode('|', $d['img']);
						}
						else
						{
							$allImg =array();
						}
										?>
							<div class="col-lg-4 padding-2em">
								<article class="search-property">
									<div class="bg-header">
										<img src="<?=$allImg[0] ?>" alt="">
									</div>
									<div class="padding-r-l-2em search-property-content txt-center">
										<hgroup class="txt-center">
											<h4 class="search-property-type"><span class="visuallyhidden">Property type :</span> <i class="icon-home"></i></h4>
											<h3 class="search-property-title lh-100 margin-zero"><?=$d['address']?></h3>
											<h4 class="lh-100">$<?=str_replace('.00', '', $d['price'])?></h4>
										</hgroup>
										<a href="/property/<?=$d['id'] ?>" class="btn btn-primary">View details</a>
										<ul class="list-inline padding-3em details">
											<li class="text-left"><strong class="display-block number"><?=$d['bed'] ?></strong> BEDS
											<li class="text-left"><strong class="display-block number"><?=$d['bathroom'] ?></strong> BATHS
											<li class="text-left"><strong class="display-block number"><?=$d['sqft'] ?></strong>  SQFT
										</ul>
									</div>
								</article>
							</div>
						<?php
						}
					}
					else
					{
						?>
						<p>No Result.</p>
					<?php
					}?>
				</div>
			</div>
			<?php
			if(isset($_value['nbResults']) && $_value['nbResults'] > 6)
			{?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 padding-2em txt-center">
						<ul class="pagination liste_page">
							<?php
							$nbPage = ceil($_value['nbResults']/6);
						if($nbPage > 1)
						{
							if($nbPage > 5)
							{
								echo '<li><a class="page first" href="#">&laquo;</a></li>';
								echo '<li class="active"><a class="page" href="#">1</a></li>';

								for($i = 2; $i < 6; $i++)
								{
									echo '<li><a class="page" href="#">'.$i.'</a></li>';
								}
							}
							else
							{
								echo '<li><a class="page" href="#">&laquo;</a></li>';
								echo '<li class="active"><a class="page" href="#">1</a></li>';

								for($i = 2; $i != ($nbPage + 1); $i++)
								{
									echo '<li class="active"><a class="page" href="#">'.$i.'</a></li>';
								}
							}
							echo '<li class="active"><a class="page last" href="#">&raquo;</a></li>';
						}
						?>
						</ul>
					</div>
				</div>
			</div>
			<?php
			}?>
			<div class="bg-header">
				<img src="http://localhost/yesorlandofl/Assets/img/flou.jpg" alt="">
			</div>
		</div>

	   <?php
	}



}

?>