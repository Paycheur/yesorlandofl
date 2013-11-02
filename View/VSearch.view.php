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
										<a href="/property/<?=format_url($d['style'].'-'.$d['address'])?>/<?=$d['id'] ?>" class="btn btn-primary">View details</a>
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
						if(isset($_GET['page']))
							$numPage = $_GET['page'];
						else 
							$numPage = 1;
						$nbPage = ceil($_value['nbResults']/6);
						
						$param_get='';
						$isTheFirst=true;
						foreach($_GET as $key=>$value)
						{
						    if($key=='page')
						    {
						        continue;
						    }
						    if($isTheFirst==true)
						    {
						    	if(is_array($value))
						    	{
						    		foreach($value as $k => $v)
						    		{
						    			$param_get.= $key.'[]='.$v;
						    		}
						    	}
						    	else
						       		$param_get.= $key.'='.$value;
						        $isTheFirst=false;
						    }
						    else
						    {
						    	if(is_array($value))
						    	{
						    		foreach($value as $k => $v)
						    		{
						    			$param_get.= '&'.$key.'[]='.$v;
						    		}
						    	}
						    	else
						       		$param_get.= '&'.$key.'='.$value;
						    }
						}
						if($numPage == 1)
						{
							if($nbPage > 1)
							{
								if($nbPage > 5)
								{
									echo '<li><a class="page first" href="/search?'.$param_get.'&page=1">&laquo;</a></li>';
									echo '<li class="active"><a class="page" href="/search?'.$param_get.'&page=1">1</a></li>';
								
									for($i = 2; $i < 6; $i++)
									{
										echo '<li><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
									}
								}
								else
								{
									echo '<li><a class="page" href="#">&laquo;</a></li>';
									echo '<li class="active"><a class="page" href="#">1</a></li>';
	
									for($i = 2; $i != ($nbPage + 1); $i++)
									{
										echo '<li><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
									}
								}
								echo '<li><a class="page last" href="/search?'.$param_get.'&page='.$nbPage.'">&raquo;</a></li>';
							}
						}
						else
						{

							if($nbPage > 1)
							{
								if($numPage == $nbPage || $numPage == 1)
								{
									if($numPage == $nbPage)
									{
										$limit = $numPage;
										if($numPage < 5) 
											$i = 1;
										else 
											$i = $numPage - 4;
									}
									else if($numPage == 1)
									{
										$i = $numPage;
										$limit = $numPage + 4;
									}
	
									echo '<li><a class="page first" href="/search?'.$param_get.'&page=1">&laquo;</a></li>';
									for(; $i <= $limit; $i++)
									{
										if($i == $nbPage + 1) break;
	
										if($i == $numPage)
											echo '<li class="active"><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
										else
											echo '<li><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
									}
									echo '<li><a class="page last" href="/search?'.$param_get.'&page='.$nbPage.'">&raquo;</a></li>';
	
								}
								else
								{

									echo '<li><a class="page first" href="/search?'.$param_get.'&page=1">&laquo;</a></li>';
									if($numPage + 2 > $nbPage)
									{
										$i = $numPage - 3;
										if($i <= 0)
											$i = 1;
										$limit = $numPage + 1;
									}
									else if($numPage - 2 < 1)
									{
										$i = $numPage - 1;
										$limit = $numPage + 3;
									}
									else
									{
										$i = $numPage - 2;
										$limit = $numPage + 2;
									}
	
									for(; $i <= $limit; $i++)
									{
										if($i == $nbPage + 1) break;
	
										if($i == $numPage)
											echo '<li class="active"><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
										else
											echo '<li><a class="page" href="/search?'.$param_get.'&page='.$i.'">'.$i.'</a></li>';
									}
									echo '<li><a class="page last" href="/search?'.$param_get.'&page='.$nbPage.'">&raquo;</a></li>';
	
								}
							}
						}
						?>
						</ul>
					</div>
				</div>
			</div>
			<?php 
			}?>
			<div class="bg-header">
				<img src="/assets/img/flou.jpg" alt="">
			</div>
		</div>

	   <?php
	}

	

}

?>