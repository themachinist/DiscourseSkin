<?php
/**
 * Skin file for skin My Skin.
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
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ); ?>
 

 
<?php $this->printTrail(); ?>
</body>
</html><?php
	}
 
}