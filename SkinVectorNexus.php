<?php
/**
 * Vector Nexus - Fork of Vector to better match the Puyo Nexus look.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for Vector Nexus skin
 * @ingroup Skins
 */
class SkinVectorNexus extends SkinTemplate {
	public $skinname = 'vectornexus';
	public $stylename = 'VectorNexus';
	public $template = 'VectorNexusTemplate';
	/**
	 * @var Config
	 */
	private $vectorConfig;

	public function __construct() {
		$this->vectorConfig = ConfigFactory::getDefaultInstance()->makeConfig( 'vectornexus' );
	}

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		if ( $this->vectorConfig->get( 'VectorResponsive' ) ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
			$out->addModuleStyles( 'skins.vectornexus.styles.responsive' );
		}

		$out->addModules( 'skins.vector.js' );

		// We're going to be savages and use internal only methods.
		$out->addStyle( '/assets/css/common.css', 'screen' );
		$out->addScriptFile( '/assets/js/common.js', '' );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$styles = [ 'mediawiki.skinning.interface', 'skins.vectornexus.styles' ];
		Hooks::run( 'SkinVectorStyleModules', [ $this, &$styles ] );
		$out->addModuleStyles( $styles );
	}

	/**
	 * Override to pass our Config instance to it
	 */
	public function setupTemplate( $classname, $repository = false, $cache_dir = false ) {
		return new $classname( $this->vectorConfig );
	}
}
