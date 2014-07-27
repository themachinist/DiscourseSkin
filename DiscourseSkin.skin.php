<?php
/**
 * Skin file for skin Discourse Skin.
 *
 * I am seriously considering using Smarty for this.
 *
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

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
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
 		$out->addModuleScripts( 'skins.discourse' );
	}
 
	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

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

	public function addKeyToArrayIfExist( &$arr, $key, $val ){
		if ( isset( $arr ) ){
			$arr[$key] = $val;
		}
	}

	/** 
	 * This sucks.
	 *
	 */
	public function insertIcons() {
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['namespaces']['main'], 'icon_class', "fa-file-text-o" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['namespaces']['talk'], 'icon_class', "fa-comments-o" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['views']['view'], 'icon_class', "fa-book" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['views']['edit'], 'icon_class', "fa-edit" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['views']['history'], 'icon_class', "fa-history" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['userpage'], 'icon_class', "fa-user" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['mytalk'], 'icon_class', "fa-comments" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['preferences'], 'icon_class', "fa-cog" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['watchlist'], 'icon_class', "fa-eye" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['mycontris'], 'icon_class', "fa-list" );
		$this->addKeyToArrayIfExist( $this->data['personal_urls']['logout'], 'icon_class', "fa-sign-out" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['actions']['delete'], 'icon_class', "fa-times-circle" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['actions']['move'], 'icon_class', "fa-copy" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['actions']['watch'], 'icon_class', "fa-eye" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['actions']['unprotect'], 'icon_class', "fa-unlock-alt" );
		$this->addKeyToArrayIfExist( $this->data['content_navigation']['actions']['protect'], 'icon_class', "fa-lock-alt" );
	}

	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->insertIcons();
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
							<a href="/"><img alt="Techstore@MASS Precision" src=<?php echo $this->data['logopath']; ?> class="logo-big" id="site-logo"></a>
						</div>
						<div class="panel clearfix">
							<div class="current-username">
								<?php	
								/**
								 * 	Ouput the User's name or a sign in button
								 */ 
								if ( $this->isUserLoggedIn() ) { ?>
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
								<a id="user-notifications" class="icon" href="" title="notifications of @name mentions, replies to your posts and topics, private messages, etc">
									<i class="fa fa-comment"></i><span class="sr-only">notifications of @name mentions, replies to your posts and topics, private messages, etc</span>
								</a>
							</li>
							<li>
								<a id="search-button" class="icon expand" href="#" title="search for topics, posts, users, or categories">
									<i class="fa fa-search"></i><span class="sr-only">search for topics, posts, users, or categories</span>
								</a>
							</li>
							<li class="categories dropdown">
								<a id="sitemap-button" class="icon" href="/Special:AllPages" title="go to another topic list or category">
									<i class="fa fa-bars"></i><span class="sr-only">go to another topic list or category</span>
								</a>
							</li>
							<li id="user-button" class="current-user dropdown">
								<a id="user-button" class="icon" href="/User:Winslow" title="User">
									<i class="fa fa-user"></i><span class="sr-only">user controls</span>
								</a>
							</li>
							</ul>
							<section id="search-dropdown" class="d-dropdown hide">
								<form action="{$this->data['wgScript']}" id="searchform">
									{$this->makeSearchInput( array( "id" => "searchInput" ) )}
									{$this->makeSearchButton( 'fulltext', array( 'id' => 'mw-searchButton', 'class' => 'searchButton', 'placeholder' => 'ask a question here!' ) )}
									<input type="hidden" name="title" value="Special:Search">
								</form>
							</section>
							<section id="site-map-dropdown" class="d-dropdown hide">
								<ul class="location-links">
									<li><a href="/Special:AllPages" class="admin-link"><i class="fa fa-wrench"></i>Special Pages</a></li>
									<li><a href="/admin/flags/active" class="flagged-posts-link"><i class="fa fa-flag"></i>Flags</a></li>
									<li><a href="/" class="latest-topics-link" title="topics with recent posts">Latest</a></li>
									<li><a href="/faq" class="faq-link">FAQ</a></li>
									<li><a href="#" class="mobile-toggle-link">Mobile View</a></li>
								</ul>	
							</section>
							<section id="user-dropdown" class="d-dropdown hide">
	  							<ul class="user-dropdown-links">
HTML;
	  							foreach ( $this->data['personal_urls'] as $personal_urls) {
	  								if ( !is_null( $personal_urls ) ){
		  								echo <<<HTML
		  								<li><a href="{$personal_urls['href']}"><i class="fa {$personal_urls['icon_class']}"></i>{$personal_urls['text']}</a></li>
HTML;
									}
	  							}
	  							echo <<<HTML
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
									if ( !is_null($views) ){
										echo <<<HTML
										<li class="{$views['class']}" title="{$views['text']}">
											<a href="{$views['href']}"><i class="fa {$views['icon_class']}"></i>{$views['text']}</a>
										</li>
HTML;
									}
								}
								echo '</ul>';
							}
							?>
						</ul>
					</div>
				</div>
				<?php
				}
				?>
				<div class="container">
					<div class="contents clearfix body-page">
						<?php $this->html( 'catlinks' ); ?>
						<h1 id="firstHeading" class="firstHeading"><?php $this->html( 'title' ) ?></h1>
						<?php $this->html( 'bodytext' ); ?>
			  		</div>
				</div>
			</div>
		</div>
	</section>
	<div class="angle-blue hide">&nbsp;</div>
	<footer id="bottom"></footer>
	<?php $this->printTrail(); ?>
</body>
</html><?php
	}
}
?>