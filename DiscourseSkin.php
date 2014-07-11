<?php
/**
 * Discourse skin for MediaWiki skin
 *
 * @file
 * @ingroup Skins
 * @author David Winslow
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );
}
 
$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'Discourse Skin', // name as shown under [[Special:Version]]
	'version' => '1.0',
	'date' => '20140711',
	'url' => '',
	'author' => '',
	'descriptionmsg' => 'discourseskin-desc',
	'license' => 'GPL-2.0+'
);

$wgValidSkinNames['Discourse'] = 'DiscourseSkin';
 
$wgAutoloadClasses['SkinDiscourseSkin'] = __DIR__ . '/DiscourseSkin.skin.php';
$wgMessagesDirs['DiscourseSkin'] = __DIR__ . '/i18n';

$wgResourceModules['skins.discourse'] = array(
	'styles' => array(
		'DiscourseSkin/resources/screen.css' => array( 'media' => 'screen' ),
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);
?>