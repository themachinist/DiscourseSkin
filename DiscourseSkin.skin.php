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
            					 * 	Setup Sign-in/Username section
            					 */ 
            					if ($this->isUserLoggedIn()) { ?>
								<span class="username"><a href="<?php echo $this->data['personal_urls']['userpage']['text']; ?>"><?php echo $this->data['personal_urls']['userpage']['text']; ?></a></span>
								<?php } else { ?>
								<button class="btn btn-primary"><i class="fa fa-user"></i>Sign In</button>
								<?php } ?>
                  			</div>
                  			<?php	
        					/**
        					 * 	Setup Sign-in/Username section
        					 */ 
        					if ($this->isUserLoggedIn()) { ?>
                  			<ul class="icons clearfix" role="navigation">
                  			<li class="notifications">
            					<a class="icon" href="#" data-notifications="notifications-dropdown" id="user-notifications" title="notifications of @name mentions, replies to your posts and topics, private messages, etc">
									<i class="fa fa-comment"></i><span class="sr-only">notifications of @name mentions, replies to your posts and topics, private messages, etc</span>
								</a>
							</li>
							<li>
								<a id="search-button" class="icon expand" href="#" data-dropdown="search-dropdown" title="search for topics, posts, users, or categories">
									<i class="fa fa-search"></i><span class="sr-only">search for topics, posts, users, or categories</span>
								</a>
							</li>
							<li class="categories dropdown">
								<a class="icon" data-dropdown="site-map-dropdown" data-render="renderSiteMap" href="#" title="go to another topic list or category" id="site-map">
									<i class="fa fa-bars"></i><span class="sr-only">go to another topic list or category</span>
								</a>
							</li>
							<li class="current-user dropdown">
								<a class="icon" data-dropdown="user-dropdown" data-render="renderUserDropdown" href="#" title="Avatar" id="current-user">
									<i class="fa fa-user"></i><span class="sr-only">go to another topic list or category</span>
								</a>
							</li>
							</ul>
							<div id="search-dropdown" class="d-dropdown" style="display: none;"><input id="search-term" class="ember-text-field" placeholder="type your search terms here" type="text"></div>
							<section class="d-dropdown" id="notifications-dropdown" style="display: none;">
								<div class="none">You have no notifications right now.</div>
							</section>
							<section class="d-dropdown" id="user-dropdown" style="display: none;">
	  							<ul class="user-dropdown-links">
									<li><a class="user-activity-link" href="/users/winslow">Profile</a></li>
									<li><a href="/admin/users/winslow">Admin</a></li>
									<li><a class="user-messages-link" href="/users/winslow/private-messages">Messages</a></li>
									<li><a href="<?php echo $this->data['personal_urls']['href']; ?>"><?php echo $this->data['personal_urls']['text']; ?></a></li>
									<li><button class="btn btn-danger right logout"><i class="fa fa-sign-out"></i>Log Out</button></li>
								</ul>
							</section>
							<?php } ?>
						</div>
	  				</div>
				</div>
			</header>
			<div id="main-outlet">
				<div class="container">
  					<div class="row">
  						<div class="alert alert-info">Create at least 5 public topics and 30 public posts to get discussion started. New users will not be able to earn trust levels unless there's content for them to read.</div>
  					</div>
				</div>
				<div class="list-controls">
					<div class="container">
						<ul class="nav nav-pills" id="navigation-bar">
							<li title="View this article." class="active" >
								<a href="/latest">Latest</a>
							</li>
							<li title="Edit this article.">
								<a href="/new">New</a>
							</li>
							<li title="Watch this article." class="has-icon">
								<a href="/unread"><span class="unread"></span>Unread</a>
							</li>
							<li title="topics you starred" class="has-icon">
								<a href="/starred"><span class="starred"></span>Starred</a>
							</li>
							<li title="a selection of best topics in the last year, month, week or day">
								<a href="/top">Top</a>
							</li>
							<li title="all topics grouped by category">
								<a href="/categories">Categories</a>
							</li>
						</ul>
						<button id="create-topic" class="btn btn-default"><i class="fa fa-plus"></i>Create Topic</button>
					</div>
				</div>
				<div class="container">
					<div class="contents clearfix body-page">
						<?php $this->html( 'catlinks' ); ?>
						<?php $this->html( 'bodytext' ); ?>
			  		</div>
				</div>
			</div>
		</div>
	</section>
	<footer id="bottom"><?php $this->printTrail(); ?></footer>
</body>
</html><?php
	}
 
}