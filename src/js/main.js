(function($) {
	'use strict';

	function header() {
		var header = $('.header'),
			form = $('.search');

		// Mega Posts Menu
		$('.header__mega-menu').each(function() {
			var links = $(this).find('.header__mega-submenu li'),
				posts = $(this).find('.header__mega-posts');
			links.first().addClass('active');
			posts.hide().first().addClass('active').show();
			links.on('hover', function() {
				var $this = $(this),
					n = $this.index();
				links.removeClass('active');
				$this.addClass('active');
				posts.hide();
				posts.filter(':nth-child(' + (n + 1) + ')').show();
			});
		});

		// header__ham
		var nav = $('.header > .header__nav');

		$(window).click(function(e) {
			if (header.hasClass('header--open') && !nav.is(e.target) && nav.has(e.target).length === 0) {
				nav.find('.open').removeClass('open').find('.sub-menu').slideUp("easieEaseInOutCubic");
				nav.animate({height: 0}, 700, "easieEaseInOutCubic");
				header.removeClass('header--open');
			}
		});
		
		$('.header__ham').on('click', function(e) {
			e.stopPropagation();
			if (header.hasClass('header--open')) {
				nav.find('.open').removeClass('open').find('.sub-menu').slideUp("easieEaseInOutCubic");
				nav.animate({height: 0}, 700, "easieEaseInOutCubic");
				header.removeClass('header--open');
			} else {
				header.addClass('header--open');
				nav.animate({
					height: nav.get(0).scrollHeight
				}, 700, "easieEaseInOutCubic", function() {
					$(this).height('auto');
				});
			}
		});

		// Touch Dropdown
		$('.menu-arrow').on('click', function(e) {
			if ($(this).parent().attr('href') == '#') return;
			e.preventDefault();
			openDropdown($(this).parent());
		});
		$('.menu-item a').on('click', function(e) {
			if ($(this).attr('href') == '#') {
				e.preventDefault();
				openDropdown($(this));
			}
		});

		function openDropdown(el) {
			if (!el.hasClass('open')) {
				$('li a', el.closest('ul')).removeClass('open');
				$('li', el.closest('ul')).removeClass('open');
				$('li ul', el.closest('ul')).slideUp(500, "easieEaseInOutCubic");
				el.next('ul').slideDown(500, "easieEaseInOutCubic");
				el.addClass('open').parent('li').addClass('open');
				el.next('.header__mega').find('.sub-menu').slideDown(500, "easieEaseInOutCubic");
			} else {
				el.removeClass('open').parent('li').removeClass('open');
				el.next('ul').slideUp(500, "easieEaseInOutCubic");
				el.next('.header__mega').find('.sub-menu').slideUp(500, "easieEaseInOutCubic");
			}
		}

		// Search
		$(window).click(function(e) {
			if (!form.is(e.target) && form.has(e.target).length === 0) form.removeClass('opened');
		});
		$('.header__search, .search__close').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			form.toggleClass('opened');
			setTimeout(function() {
				$('.search__input')[0].focus();
			}, 200);
		});

		// Toggle search submit button
		$('.header .search input').keyup(function() {
			if ($.trim(this.value).length > 0)
				$('.header .search__submit').fadeIn()
			else
				$('.header .search__submit').fadeOut()
		});

	}

	function headerSticky() {
		var view = $(window),
			header = $('.header'),
			adbar = $('.header-placement'),
			adminBar,
			headerPos;
		header.length ? headerPos = header.offset().top : headerPos = '';

		view.bind('scroll resize load', function() {
			view.width() > 600 ? adminBar = $('#wpadminbar').outerHeight() : adminBar = 0;
			var viewTop = view.scrollTop(),
				height = headerPos - adminBar;
			if ((viewTop >= height) || !adbar.length) {
				header.addClass('sticky').css({'top': adminBar});
			} else {
				header.removeClass('sticky').css({'top': '0'});
			}
		});
	}

	function vossenDataAttr() {		
	
		const dataBg = document.querySelectorAll('[data-bg]');
		dataBg.forEach( function(el) {
			const attr = el.getAttribute('data-bg');
			if (attr !== '') {
				const dataBgWrap = document.createElement('div');
				dataBgWrap.classList.add('data-bg-wrap');
				dataBgWrap.style.backgroundImage = 'url('+ attr +')';
				el.appendChild(dataBgWrap);
				setTimeout( function() {
					dataBgWrap.style.opacity = '1';
				}, 250);
			}  
		});
		 
		const dataColor = document.querySelectorAll('[data-color]');
		dataColor.forEach( function(el) {
			var attr = el.getAttribute('data-color')
			el.style.backgroundColor = ''+ attr +'';
		});
	
	}

	function vossenSliders() {

		$('.vslider').each(function() {
			var vossSlider = $(this),
				dataStyle = vossSlider.data('style'),
				dataColumns = vossSlider.data('columns'),
				dataColumnsMd = vossSlider.data('columns-md'),
				dataColumnsXs = vossSlider.data('columns-xs'),
				dataAutoplay = vossSlider.data('autoplay'),
				dataDelay = vossSlider.data('delay'),
				dataLoop = vossSlider.data('loop'),
				dataCentered = vossSlider.data('centered'),
				dataDynamicBullets = vossSlider.data('dynamic-bullets'),
				dataSpaceBetween = vossSlider.data('spacebetween'),
				dataParallax = vossSlider.data('parallax'),
				excerptHeight,
				vossSwiper = new Swiper(vossSlider, { // eslint-disable-line
					autoplay: {
						enabled: dataAutoplay,
						delay: dataDelay
					},
					loop: dataLoop,
					loopedSlides: 2,
					loopAdditionalSlides: 10,
					centeredSlides: dataCentered,
					pagination: {
						el: '.swiper-pagination',
						type: 'bullets',
						clickable: true,
						dynamicBullets: dataDynamicBullets,
						renderBullet: function(index, className) {
							return '<span class="' + className + '"><div><span>' + (index + 1) + '</span></div></span>';
						}
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev'
					},
					grabCursor: true,
					roundLengths: true,
					parallax: dataParallax,
					speed: 500,
					slidesPerView: dataColumns,
					spaceBetween: dataSpaceBetween,
					breakpoints: {
						700: {
							slidesPerView: dataColumnsXs,
							spaceBetween: dataSpaceBetween
						},
						992: {
							slidesPerView: dataColumnsMd,
							spaceBetween: dataSpaceBetween
						},
						2000: {
							slidesPerView: dataColumns,
							spaceBetween: dataSpaceBetween
						}

					},
					observer: true,
					observeParents: true,
					on: {
						init: function() {
							vossSlider.addClass('swiper-initialized')
						},
					},
				});

			if ((dataStyle === 3 || dataStyle === 4) && dataColumns !== 5 && dataColumns !== 6) {
				excerptHeight = $(this).find('.vs-excerpt').outerHeight() + 12;
				$(this).find('.vs-bottom-content').css({
					'-webkit-transform': 'translate(0,' + excerptHeight + 'px)',
					'transform': 'translate(0,' + excerptHeight + 'px)'
				});
			}
		});
	}

	function vossenMasonry() {
		
		var posts = document.querySelectorAll('.voss-posts');
		imagesLoaded( posts, function() {

			var grid = document.querySelector('.voss-layout-masonry');
			
			if (grid !== null) {
			
				var horizontalOrder = false;
				if (grid !== null && grid.getAttribute('data-col') === '3' && window.innerWidth > 992) {
					horizontalOrder = true;
				}
				
				var msnry = new Masonry(grid, {
					columnWidth: '.post',
					itemSelector: '.post',
					horizontalOrder: horizontalOrder,
				});
	
				// set Infinite Scroll
				var vossPosts = document.querySelector('.voss-posts');
				if (vossPosts.classList.contains('voss-ajax-load') || vossPosts.classList.contains('voss-ajax-infinite')) {
	
					// get Load method
					var scroll;
					var vossPosts = document.querySelector('.voss-posts');
					if (vossPosts.classList.contains('voss-ajax-load')) {
						scroll = false;
					} else if (vossPosts.classList.contains('voss-ajax-infinite')) {
						scroll = 100;
					}
					
					// get Layout
					var el = document.querySelector('.voss-layout');
					var outlayer;
					if (el.classList.contains('voss-layout-masonry')) {
						el = grid;
						outlayer = msnry;
					}
	
					// init Infinite Scroll
					var infScroll = new InfiniteScroll(el, {
						path: '.voss-load-btn',
						append: '.post',
						button: '.voss-load-btn',
						scrollThreshold: scroll,
						status: '.page-load-status',
						checkLastPage: true,
						history: true,
						outlayer: outlayer,
					});
				 
					infScroll.on('append', function(event, response, path, items) {
						if (items === null && items.length == 0) {
							document.querySelector('.infinite-scroll-request').style.display = 'none';
							document.querySelector('.voss-load-btn').style.display = 'none';
							document.querySelector('.page-load-status').style.display = 'block';
							document.querySelector('.infinite-scroll-last').style.display = 'block';
							el.infiniteScroll('destroy');
						}
					});
	
				}
				
			}

		});

	}

	function vossenAjaxify() {
		if ($('.voss-ajax-numeric').length || $('.voss-ajax-links').length) {
			(function(window) {

				// Prepare our Variables
				var History = window.History,
					$ = window.jQuery,
					document = window.document;

				// Check to see if History.js is enabled for our Browser
				if (!History.enabled) {
					return false;
				}

				// Wait for Document
				$(function() {
					// Prepare Variables
					var contentSelector = '.voss-posts',
						$content = $(contentSelector).filter(':first'),
						contentNode = $content.get(0),
						$menu = $('.voss-ajax-pagination nav').filter(':first'),
						activeClass = 'current',
						activeSelector = '.voss-ajax-pagination nav .current',
						menuChildrenSelector = ' > a',
						completedEventName = 'statechangecomplete',
						// Application Generic Variables
						$window = $(window),
						$body = $(document.body),
						rootUrl = History.getRootUrl();

					// Ensure Content
					if ($content.length === 0) {
						$content = $body;
					}

					// Internal Helper
					$.expr[':'].internal = function(obj) {
						// Prepare
						var $this = $(obj),
							url = $this.attr('href') || '',
							isInternalLink;

						// Check link
						isInternalLink = url.substring(0, rootUrl.length) === rootUrl || url.indexOf(':') === -1;

						// Ignore or Keep
						return isInternalLink;
					};

					// HTML Helper
					var documentHtml = function(html) {
						// Prepare
						var result = String(html)
							.replace(/<!DOCTYPE[^>]*>/i, '')
							.replace(/<(html|head|body|title|meta|script)([\s>])/gi, '<div class="document-$1"$2')
							.replace(/<\/(html|head|body|title|meta|script)>/gi, '</div>');
						// Return
						return $.trim(result);
					};

					// Ajaxify Helper
					$.fn.ajaxify = function() {
						// Prepare
						var $this = $(this);

						// Ajaxify
						$this.find('.pagination a').on('click', function(event) {
							// Prepare
							var $this = $(this),
								url = $this.attr('href'),
								title = $this.attr('title') || null;

							// Continue as normal for cmd clicks etc
							if (event.which == 2 || event.metaKey) {
								return true;
							}

							// Ajaxify this link
							History.pushState(null, title, url);
							event.preventDefault();
							return false;
						});

						// Chain
						return $this;
					};

					// Ajaxify our Internal Links
					$body.ajaxify();

					// Hook into State Changes
					$window.on('statechange', function() {
						// Prepare Variables
						var State = History.getState(),
							url = State.url,
							relativeUrl = url.replace(rootUrl, ''),
							wpAdm = $('#wpadminbar'),
							wpAdmOffset = (wpAdm ? wpAdm.outerHeight() : 0);

						// Set Loading
						$content.addClass('voss-load-after');
						$('html, body').animate({
							scrollTop: $content.offset().top - wpAdmOffset - 95
						}, 1000);

						// Start Fade Out
						// Animating to opacity to 0 still keeps the element's height intact
						// Which prevents that annoying pop bang issue when loading in new content
						//$content.animate({opacity:0.2},1000);
						$($content).find('article,nav').animate({
							opacity: 0.2
						}, 1000);

						// Ajax Request the Traditional Page
						$.ajax({
							url: url,
							success: function(data) {
								// Prepare
								var $data = $(documentHtml(data)),
									$dataBody = $data.find('.document-body:first'),
									$dataContent = $dataBody.find(contentSelector).filter(':first'),
									$menuChildren, contentHtml, $scripts;

								// Fetch the scripts
								$scripts = $dataContent.find('.document-script');
								if ($scripts.length) {
									$scripts.detach();
								}

								// Fetch the content
								contentHtml = $dataContent.html() || $data.html();
								if (!contentHtml) {
									document.location.href = url;
									return false;
								}

								// Update the menu
								$menuChildren = $menu.find(menuChildrenSelector);
								$menuChildren.filter(activeSelector).removeClass(activeClass);
								$menuChildren = $menuChildren.has('a[href^="' + relativeUrl + '"],a[href^="/' + relativeUrl + '"],a[href^="' + url + '"]');
								if ($menuChildren.length === 1) {
									$menuChildren.addClass(activeClass);
								}

								// Update the content
								$content.stop(true, true);
								$content.html(contentHtml).ajaxify().css('opacity', 100).show();

								// Update the title
								document.title = $data.find('.document-title:first').text();
								try {
									document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<', '&lt;').replace('>', '&gt;').replace(' & ', ' &amp; ');
								} catch (Exception) {} // eslint-disable-line

								// Add the scripts
								$scripts.each(function() {
									var $script = $(this),
										scriptText = $script.text(),
										scriptNode = document.createElement('script');
									if ($script.attr('src')) {
										if (!$script[0].async) {
											scriptNode.async = false;
										}
										scriptNode.src = $script.attr('src');
									}
									scriptNode.appendChild(document.createTextNode(scriptText));
									contentNode.appendChild(scriptNode);
								});

								// Complete the change
								$content.removeClass('voss-load-after');
								$window.trigger(completedEventName);

								// Inform Google Analytics of the change
								if (typeof window._gaq !== 'undefined') {
									window._gaq.push(['_trackPageview', relativeUrl]);
								}

								// Inform ReInvigorate of a state change
								if (typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined') {
									reinvigorate.ajax_track(url); // eslint-disable-line
									// ^ we use the full url here as that is what reinvigorate supports
								}
							},
							error: function() {
								document.location.href = url;
								return false;
							}
						}); // end ajax

					}); // end onStateChange

				}); // end onDomLoad

			})(window); // end closure
		}
	}

	function toTop() {		
		
		const el = document.querySelector('.scroll__top');
		
		// Add class to reveal the element
		window.addEventListener('scroll', function() {
			if (window.scrollY >= 500) {
				el.classList.add('--active');
			} else {
				el.classList.remove('--active');
			}
		});
		
		// Smooth scroll to top of the body
	    el.addEventListener('click', function(e) {
	        e.preventDefault();
	        document.body.scrollIntoView({
	            behavior: 'smooth'
	        });
	    });
		
	}
	
	function coockieModal() {
	
		// Cookie Notice
		const cookieNotice = document.querySelector('.cookie');
		const cookieSet = document.querySelector('.cookie .button');
		const cookieClose = document.querySelector('.cookie__close');
		
		if (Cookies.get('cookies-data') !== 'accepted') {
			cookieNotice.classList.add('--active');
		}
		
		cookieSet.addEventListener('click', function() {
			Cookies.set('cookies-data', 'accepted', { expires: 30 });
			cookieNotice.classList.remove('--active');
		});
		
		cookieClose.addEventListener('click', function() {
			cookieNotice.classList.remove('--active');
		});
		
	}

	function vossenSingle() {

		$('.comments-show-btn button').on('click', function() {
			if ($(this).hasClass('active')) {
				$('.comments-area').slideUp();
			} else {
				$('.comments-area').slideDown();
			}
			$(this).toggleClass('active');
		});

		$('.meta-comments a').on('click', function(event) {
			$('html, body').animate({
				scrollTop: $('.entry-footer').offset().top - 100
			});
			event.preventDefault();
			$('.comments-area').slideDown();
			$('.comments-show-btn button').addClass('active');
		});

		$('.wp-block-gallery').fancybox({
			selector: '.wp-block-gallery a'
		});

		if ($('.single-post').length) {

			// init Infinite Scroll
			var $container = $('.voss-infinite-1 .voss-posts-content');
			$container.infiniteScroll({
				path: function() {
					return $("article:last-child .single-nav > div:first-child a").attr("href");
				},
				append: 'article',
				status: '.page-load-status',
				scrollThreshold: '0',
			});

			$container.on('append.infiniteScroll', function() {
				vossenSliders();
				vossenDataAttr();
			});

		}

	}

	function initInstagram() {
	
		// Create image tags with src from parent data attribute and display container
		function showItems() {
		
			const container = document.querySelector('.null-instagram-feed');
			const img = document.querySelectorAll('.null-instagram-feed li > a');
			
			img.forEach( function(el) {
				const src = el.getAttribute('data-img-src');
				el.insertAdjacentHTML('afterbegin', '<img src="'+ src +'" alt width="320" height="320"/>');
			});
			
			if (container !== null) container.style.display = 'block';
		
		}
		
		// Initialize showItems function if it's homepage and scroll begins
		if (document.body.classList.contains('home')) {
		
			let itsDone = false;
		
			window.addEventListener('scroll', function() {
				if (itsDone !== true) {
					if (this.window.scrollY >= 100) {
						showItems();
						itsDone = true;
					}
				}
			});
			
		} else {
			showItems();
		}
		
	}

	function vossenInit() {
		header();
		headerSticky();
		vossenSliders();
		vossenDataAttr();
		vossenAjaxify();
		vossenMasonry();
		vossenSingle();
		initInstagram();
		toTop();
		coockieModal();
	}

	$(document).ready(function() {
		vossenInit();
	});

	$(document).on('resize', function() {
		header();
		headerSticky();
		vossenMasonry();
	});

	$(document).ajaxComplete(function() {
		vossenMasonry();
	});
	
	// window.onscroll = function() {
	// 	myFunction()
	// };

}(jQuery));
