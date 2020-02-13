var queryString = "table";
var breakpoint = 800;
jQuery(document).ready(function($) {

	var processed = [];
	var pauseProcess = false;

	function processTables( nodes ) {

		pauseProcess = true;

		nodes.each(function () {

			// dont process a table twice
			if ( -1 < processed.indexOf( this ) || $(this).next().is('.art-table') ) return console.log('skipped');

			var headers = [],
				artHeaders = ' no-headers';
			$('tr th', this).each(function () {
				artHeaders = '';
				headers.push( $(this).html() );
			});

			artTable = '<div class="art-table' + artHeaders + '"><div class="art-tbody">';
			$('tr', this).each(function () {
				if( $(this).find('td').length > 0 ) {
					artTable += '<div class="art-tr">';
					$('td', this).each(function () {
						artTable += '<div class="art-td">';
						if( '' == artHeaders ) {
							artTable += '	<div class="art-td-first">'+headers[$(this).index()]+'</div>';
						}
						artTable += '	<div class="art-td-last">'+$(this).html()+'</div>';
						artTable += '	<div class="art-clearfix"></div>';
						artTable += '</div>';
					});
					artTable += '</div>';
				}
			});
			artTable += '</div></div>';

			$(this).after(artTable);
			processed.push( this );

		});

		pauseProcess = false;

	}
	processTables( $( queryString ) );
	$(document).on( 'DOMNodeInserted', function( e ) {
		var el = e.srcElement;
		if ( ! pauseProcess ) {
			var toProcess;
			if ( $( el ).is('table') ) {
				toProcess = $( el );
			} else {
				toProcess = $( el ).find( queryString );
			}
			processTables( toProcess );
		}
	})


	//---- For ie5 - ie8
	var div = document.createElement("div");
	div.innerHTML = "<!--[if lt IE 9]><i></i><![endif]-->";
	var isIeLessThan9 = (div.getElementsByTagName("i").length == 1);
	if( isIeLessThan9 ) {
		$('.art-table .art-tbody .art-tr:nth-child(2n)').addClass('even-rows');
		$('.art-table .art-tbody .art-tr:nth-child(2n+1)').addClass('odd-rows');
		if( document.documentElement.offsetWidth < breakpoint ) {
			tableObjects.css('display','none');
			$('div.art-table').css('display','block');
		} else {
			tableObjects.css('display','block');
			$('div.art-table').css('display','none');
		}
		$(window).on('resize', function () {
			if( document.documentElement.offsetWidth < breakpoint ) {
				tableObjects.css('display','none');
				$('div.art-table').css('display','block');
			} else {
				tableObjects.css('display','block');
				$('div.art-table').css('display','none');
			}
		});
	}

});