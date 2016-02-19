<?php
/**
* @package   Zen Grid Framework
* @author    Joomlabamboo http://www.Jjoomlabamboo.com
* @copyright Copyright (C) Joomlabamboo
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// No Direct Access
defined('ZEN_ALLOW') or die(); 


$zgf = new zen();

// Read settings
if(isset($zgf->getsettings()->params->socialicons)) {
	$socialicons = $zgf->getsettings()->params->socialicons;
}

$icons = array('500px','user','envelope','envelope-o','search','adn','android','angellist','apple','behance','behance-square','bitbucket','bitbucket-square','bitcoin (alias)','btc','buysellads','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','codepen','connectdevelop','css3','dashcube','delicious','deviantart','digg','dribbble','dropbox','drupal','empire','facebook','facebook-f (alias)','facebook-official','facebook-square','flickr','forumbee','foursquare','ge (alias)','git','git-square','github','github-alt','github-square','gittip (alias)','google','google-plus','google-plus-square','google-wallet','gratipay','hacker-news','html5','instagram','ioxhost','joomla','jsfiddle','lastfm','lastfm-square','leanpub','linkedin','linkedin-square','linux','maxcdn','meanpath','medium','openid','pagelines','paypal','pied-piper','pied-piper-alt','pinterest','pinterest-p','pinterest-square','qq','ra (alias)','rebel','reddit','reddit-square','renren','sellsy','share-alt','share-alt-square','shirtsinbulk','simplybuilt','skyatlas','skype','slack','slideshare','soundcloud','spotify','stack-exchange','stack-overflow','steam','steam-square','stumbleupon','stumbleupon-circle','tencent-weibo','trello','tumblr','tumblr-square','twitch','twitter','twitter-square','viacoin','vimeo-square','vine','vk','wechat (alias)','weibo','weixin','whatsapp','windows','wordpress','xing','xing-square','yahoo','yelp','youtube','youtube-play','youtube-square','home'); ?>

	<p>	
		<a class="uk-button uk-button-primary" data-id="add-network" href="#">Add another network</a>
	</p>
	
	<div id="extra-social-networks">
		<ul class="sub-list">
			<?php if(isset($socialicons)) {
					foreach ($socialicons as $url => $icon) { ?>
				
					<li data-display="half">
						<p>Social Network Link</p>		
						<input data-display="half" id="social-network" class="uk-form uk-form-large uk-form-width-large" value="<?php echo $url;?>"/>		
							
						<p>Social Network Icon</p>		
						<select data-display="half" class="zen-select" value="<?php echo $icon;?>">	   	
							<?php foreach ($icons as $key => $option) {			
							
								if($option == $icon) {
				
									echo  '<option selected value="'.$option.'">'.ucfirst($option).'</option>';
								} else {
									echo  '<option value="'.$option.'">'.ucfirst($option).'</option>';
								}		
							} ?>		
						</select>				
						<a data-display="half"  class="uk-button uk-button-warning" id="remove-network" href="#">Remove</a>
							<div class="bevel"></div>
					</li>
			<?php } 
				}
			?>
		</ul>
	</div>
	
	<script>
		jQuery(document).ready(function($) {	
			$('[data-id="add-network"]').click(function() {		
				var network_html = $('.social-network').html();		
				$('#extra-social-networks ul').prepend(network_html);		
				return false;	
			});			
		
			$('#remove-network').live('click', function() {		
				$(this).parent().remove();		
			return false;	});	
		});
	</script>
	
	<script type="text/html" class="social-network">	
		<li data-display="half">
		<p>Social Network Link</p>		
		<input data-display="half" class="uk-form uk-form-large uk-form-width-large"/>		
				
		<p>Social Network Icon</p>		
		<select data-display="half" id="<?php echo $name;?>" data-compile="<?php echo $compile;?>" class="zen-select <?php echo $class;?>" value="<?php echo $value;?>">	   	
			<?php foreach ($icons as $key => $option) {			
				echo  '<option selected value="'.$option.'">'.ucfirst($option).'</option>';		
			} ?>		
		</select>			
		<a class="uk-button uk-button-warning" id="remove-network" href="#">Remove</a>
		<div class="bevel"></div>
		</li>	
	</script>