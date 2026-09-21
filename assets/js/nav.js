/**
 * スマホ用ハンバーガーメニューの開閉
 * .site-header に is-open クラスを付け外しし、ボタンの aria 属性も更新する
 */

( function () {
	'use strict';

	var header = document.querySelector( '.site-header' );
	var button = header ? header.querySelector( '.header-toggle' ) : null;

	if ( ! header || ! button ) {
		return;
	}

	function setOpen( open ) {
		header.classList.toggle( 'is-open', open );
		button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		button.setAttribute( 'aria-label', open ? 'メニューを閉じる' : 'メニューを開く' );
	}

	button.addEventListener( 'click', function () {
		setOpen( ! header.classList.contains( 'is-open' ) );
	} );

	// Esc キーで閉じる
	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && header.classList.contains( 'is-open' ) ) {
			setOpen( false );
			button.focus();
		}
	} );

	// 画面を広げて PC 幅になったら閉じた状態に戻す (768px より大きいとき)
	window.matchMedia( '(min-width: 769px)' ).addEventListener( 'change', function ( e ) {
		if ( e.matches ) {
			setOpen( false );
		}
	} );
} )();
