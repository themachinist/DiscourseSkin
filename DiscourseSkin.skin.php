<?php
/**
 * Skin file for skin Discourse Skin.
 *
 * I am seriously considering using Smarty for this.
 *
 * @file
 * @ingroup Skins
 */


/**
 * SkinTemplate class for My Skin skin
 * @ingroup Skins
 */
class SkinDiscourseSkin extends SkinTemplate {
	var $skinname = 'discourse', $stylename = 'DiscourseSkin',
		$template = 'DiscourseSkinTemplate', $useHeadElement = true;

	/**
	 * Add JavaScript via ResourceLoader
	 * Uncomment this function if your skin has a JS file or files
	 * Otherwise you won't need this function and you can safely delete it
	 *
	 * @param OutputPage $out
	 *
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
 
		$out->addModules( 'skins.myskin.js' );
	}
	 */
 
	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		/**
		 * FontAwesome requires utf-8 character encoding
		 */
		$out->addMeta( 'charset', 'utf-8' );
		$out->addStyle( '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', 'screen');
		$out->addStyle( '//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css', 'screen');
		$out->addModuleStyles( array(
			'mediawiki.skinning.interface', 'skins.discourse'
		) );

	}
 
}

/**
 * BaseTemplate class for My Skin skin
 * @ingroup Skins
 */
class DiscourseSkinTemplate extends BaseTemplate {
 	/**
 	 * Check if user is logged in.
 	 *
 	 * Maybe there is a better way to do this. Maybe it's hard as fuck 
 	 * to dig through MediaWiki's enourmous documentation and codebase
 	 */
 	public function isUserLoggedIn() {
		return array_key_exists('userpage', $this->data['personal_urls']);
	}

	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ); ?>
	<div class="container" id="top-navbar">
		<span style="height:20px;" id="top-navbar-links">
		  <a href="http://techstore.massa.ml">Techstore</a> | 
		  <a href="http://talk.massa.ml">Talk</a> | 
		  <a href="http://support.massa.ml/">Support</a>
		</span>
	</div>
	<section id="main">
		<div class="view">
			<header class="d-header clearfix">
				<div class="container">
					<div class="contents clearfix">
						<div class="title">
							<a href="/"><img alt="Techstore@MASS Precision" src=<?php echo $this->data['logopath'] ?> class="logo-big" id="site-logo"></a>
						</div>
						<div class="panel clearfix">
							<div class="current-username">
								<?php	
								/**
								 * 	Ouput the User's name or a sign in button
								 */ 
								if ($this->isUserLoggedIn()) { ?>
								<span class="username"><a href="<?php echo $this->data['personal_urls']['userpage']['text']; ?>"><?php echo $this->data['personal_urls']['userpage']['text']; ?></a></span>
								<?php } else { ?>
									<a class="btn btn-primary" href="<?php echo $this->data['personal_urls']['anonlogin']['href']; ?>"><i class="fa fa-user"></i><?php echo $this->data['personal_urls']['anonlogin']['text']; ?></a>
								<?php } ?>
				  			</div>
				  			<?php	
							/**
							 * 	If the a user is signed in display user controls
							 */ 
							if ($this->isUserLoggedIn()) { 
				  			echo <<<HTML
				  			<ul class="icons clearfix" role="navigation">
				  			<li class="notifications">
								<a class="icon" href="" id="user-notifications" title="notifications of @name mentions, replies to your posts and topics, private messages, etc">
									<i class="fa fa-comment"></i><span class="sr-only">notifications of @name mentions, replies to your posts and topics, private messages, etc</span>
								</a>
								<?php /* if ( $this->html( 'newtalk' ) ) */ ?>
								<div><!-- notification icon: small red box with a number in a nice font --></div>
							</li>
							<li>
								<a id="search-button" class="icon expand" href="#" title="search for topics, posts, users, or categories">
									<i class="fa fa-search"></i><span class="sr-only">search for topics, posts, users, or categories</span>
								</a>
							</li>
							<li class="categories dropdown">
								<a class="icon" href="#" title="go to another topic list or category" id="site-map">
									<i class="fa fa-bars"></i><span class="sr-only">go to another topic list or category</span>
								</a>
							</li>
							<li class="current-user dropdown">
								<a class="icon" href="#" title="User" id="current-user">
									<i class="fa fa-user"></i><span class="sr-only">go to another topic list or category</span>
								</a>
							</li>
							</ul>
							<div id="search-dropdown" class="d-dropdown" style="display: none;">
								<input id="search-term" class="ember-text-field" placeholder="type your search terms here" type="text">
							</div>
							<section class="d-dropdown" id="site-map-dropdown" style="display: block;">
								<ul class="location-links">
									<li><a href="/admin" class="admin-link"><i class="fa fa-wrench"></i>Admin</a></li>
									<li><a href="/admin/flags/active" class="flagged-posts-link"><i class="fa fa-flag"></i>Flags</a></li>
									<li><a id="ember4687" class="ember-view latest-topics-link" href="/" title="topics with recent posts">Latest</a></li>
									<li><a href="/faq" class="faq-link">FAQ</a></li>
									<li><a href="#" class="mobile-toggle-link" data-ember-action="1229">Mobile View</a></li>
								</ul>
								<ul class="category-links">
									<li class="heading" title="all topics grouped by category"><a id="ember4691" class="ember-view" href="/categories">Categories</a></li>
									<li class="category"><a href="/category/meta" data-drop-close="true" class="badge-category" title="Discussion about this forum, its organization, how it works, and how we can improve it." style="background-color: #808281; color: #FFFFFF; ">meta</a></li>
									<li class="category"><a href="/category/staff" data-drop-close="true" class="badge-category restricted" title="Private category for staff discussions. Topics are only visible to admins and moderators." style="background-color: #F7941D; color: #FFFFFF; "><div><i class="fa fa-group"></i> staff</div></a></li>
									<li class="category"><a href="/category/resdev" data-drop-close="true" class="badge-category restricted" style="background-color: #25AAE2; color: #FFFFFF; "><div><i class="fa fa-group"></i> resdev</div></a></li>
									<li class="category"><a href="/category/the-company" data-drop-close="true" class="badge-category restricted" title="Come here to read or talk about news, current events, or life in general at MASS." style="background-color: #283890; color: #FFFFFF; "><div><i class="fa fa-group"></i> The Company</div></a></li>
									<li class="category"><a href="/category/uncategorized" data-drop-close="true" class="badge-category" style="background-color: #D3D4D5; color: #FFFFFF; ">uncategorized</a></li>
									<li class="category"><a href="/category/lounge" data-drop-close="true" class="badge-category restricted" title="A category exclusive to members with trust level 3 and higher." style="background-color: #B3B5B4; color: #652D90; "><div><i class="fa fa-group"></i> lounge</div></a></li>
									<li class="category"><a href="/category/public" data-drop-close="true" class="badge-category" title="This category could be for public use. " style="background-color: #9EB83B; color: #FFFFFF; ">public</a></li>
									<li class="category"><a href="/category/epicor" data-drop-close="true" class="badge-category restricted" title="For all of your Epicor questions, comments, concerns and suggestions. Ask anything about using Epicor or use as a shoulder to cry on when Epicor is giving you troubles. " style="background-color: #0E76BD; color: #FFFFFF; "><div><i class="fa fa-group"></i> Epicor</div></a></li>
								</ul>
							</section>
							<section class="d-dropdown" id="user-dropdown" style="display: none;">
	  							<ul class="user-dropdown-links">
									<li><a class="user-activity-link" href="{$this->data['personal_urls']['userpage']['href']}">{$this->data['personal_urls']['userpage']['text']}</a></li>
									<li><a href="/admin/users/winslow">Admin</a></li>
									<li><a class="user-messages-link" href="/users/winslow/private-messages">Messages</a></li>
									<li><a href="{$this->data['personal_urls']['preferences']['href']}">{$this->data['personal_urls']['preferences']['text']}</a></li>
									<li><a href="{$this->data['personal_urls']['logout']['href']}" class="btn btn-danger right logout"><i class="fa fa-sign-out"></i>{$this->data['personal_urls']['logout']['text']}</button></li>
								</ul>
							</section>
HTML;
							} 
							/**
							 * End user controls
							 */?>
						</div>
	  				</div>
				</div>
			</header>
			<div id="main-outlet">
				<div class="container">
					<?php 
					if ( $this->html( 'sitenotice' ) ) {
						echo <<<HTML
	  					<div class="row">
	  						<div class="alert alert-info">{$this->html( 'sitenotice' )}</div>
	  					</div>
 HTML;
					} 
					?>
				</div>
				<?php
				/**
				 * If the current page is an article let's display our theme controls.
				 *
				 * In the case of special pages and core modules markup may be built-in (what the fuck?). I'm about 
				 * 4 hours in to trying to figure out to replace mediawiki.special.preferences.js, where this built-in
				 * markup is stored, and it's really not worth the trouble.
				 */
				if ( $this->data['isarticle'] ) {
				?>
				<div class="list-controls">
					<div class="container">
							<?php
							foreach ( $this->data['content_navigation'] as $key => $value ) {
								if ( $key == 'namespaces' ) {
									echo <<<HTML
									<ul class="nav-dropdown">
										<li><a href="#" class="nav-dropdown-item">Page/Talk</a><a href="#" class="nav-dropdown-button"><i class="fa fa-caret-right"></i></a></li>
										<section>
											<div class="{$value['main']['class']}"><div><i class="fa fa-group"></i> {$value['main']['text']}</div></a></div>
											<div class="{$value['talk']['class']}"><a href="{$value['main']['href']}"><div><i class="fa fa-group"></i> {$value['talk']['text']}</div></a></div>
										</section>
									<div class="clear"></div>
									</ul>
HTML;
								}
								echo '<ul class="nav nav-pills" id="navigation-bar">';
								foreach ( $value as $views ){
									echo <<<HTML
									<li class="{$views['class']}" title="{$views['text']}">
										<a href="{$views['href']}">{$views['text']}</a>
									</li>
HTML;
								}
								echo '</ul>';
							}
							?>
							<!--
							<li title="View this article." class="active" >
								<a href="/latest">View</a>
							</li>-->
						</ul>
					</div>
				</div>
				<?php
				}
				?>
				<div class="container">
					<div class="contents clearfix body-page">
						<?php $this->html( 'catlinks' ); ?>
						<?php $this->html( 'bodytext' ); ?>
						<?php
						
						echo '<pre>';
						var_dump( $this->data["content_navigation"] );
						var_dump( $this->data['personal_urls'] );
						echo '</pre>';
						
						?>
			  		</div>
				</div>
			</div>
		</div>
	</section>
	<div class="angle-blue">&nbsp;</div>
	<footer id="bottom"><?php $this->printTrail(); ?></footer>
</body>
</html><?php
	}
}
?>