// Set custom editor scripts on page loaded
document.addEventListener(
	'DOMContentLoaded',
	function () {
		qodefSetBodyClasses();
	}
);

// Set preview screen body class
const qodefSetBodyClasses = () => {

	if ( typeof wp === 'object' && typeof wp.data === 'object' ) {
		var wpData           = wp.data;
		var initialScreen    = 'desktop';
		var $currentDocument = document;

		$currentDocument.body.classList.add( 'qode-essential-addons--' + initialScreen );

		wpData.subscribe(
			() =>
			{
				// Timeout is set in order to wait a little to iframe loaded
				setTimeout(
					function() {
						var currentPageData = wpData.select( 'core/edit-post' );

						if ( currentPageData ) {
							var currentScreen = currentPageData.__experimentalGetPreviewDeviceType().toLowerCase();

							if ( typeof currentScreen !== 'undefined' && initialScreen !== currentScreen && ['tablet', 'mobile', 'desktop'].includes( currentScreen ) ) {
								var $currentPageEditor = document.querySelector( '.edit-post-visual-editor__content-area' ) || document.querySelector( '#site-editor' ),
									$previewPanel = document.querySelector('.block-editor-block-preview__content iframe'),
									$iframeElement = '';

								if ( $previewPanel ) {
									$iframeElement = $previewPanel;
								} else if ( $currentPageEditor ) {
									$iframeElement = $currentPageEditor.querySelector( 'iframe[name="editor-canvas"]' );
								}

								$currentDocument = $iframeElement ? $iframeElement.contentDocument : document;

								$currentDocument.body.classList.remove( 'qode-essential-addons--tablet' );
								$currentDocument.body.classList.remove( 'qode-essential-addons--mobile' );
								$currentDocument.body.classList.remove( 'qode-essential-addons--desktop' );

								$currentDocument.body.classList.add( 'qode-essential-addons--' + currentScreen );

								initialScreen = currentScreen;
							}
						}
					},
					500
				);
			}
		);
	}
}
