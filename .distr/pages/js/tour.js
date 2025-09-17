

function initTourFilters(){
    var root = document.querySelector('.tour');
    if(!root) return;

	var cards = [].slice.call(root.querySelectorAll('.tour__card'));
	var filtersState = { type: null, duration: null, price: null };
	var $tagsRoot = root.querySelector('.tour__tags');
    var options = { type: [], duration: [], price: [] };
    var $moreWrap = root.querySelector('.tour__more');
    var $moreBtn = $moreWrap ? $moreWrap.querySelector('.tour__more-button') : null;
    var $moreCount = $moreWrap ? $moreWrap.querySelector('.tour__more-count') : null;
    var pageSize = 6;

	function getUnique(values){
		return Array.from(new Set(values.filter(Boolean)));
	}

	function collectOptions(){
		return {
			type: getUnique(cards.map(function(c){ return c.getAttribute('data-type'); })),
			duration: getUnique(cards.map(function(c){ return c.getAttribute('data-duration'); })),
			price: getUnique(cards.map(function(c){ return priceBucket(parseInt(c.getAttribute('data-price'), 10) || 0); }))
		};
	}

	function priceBucket(value){
		if (value <= 10000) return 'до 10 000 ₽';
		if (value <= 30000) return '10 001–30 000 ₽';
		if (value <= 60000) return '30 001–60 000 ₽';
		return '60 001+ ₽';
	}

	function inBucket(value, bucket){
		if (bucket === 'до 10 000 ₽') return value <= 10000;
		if (bucket === '10 001–30 000 ₽') return value > 10000 && value <= 30000;
		if (bucket === '30 001–60 000 ₽') return value > 30000 && value <= 60000;
		if (bucket === '60 001+ ₽') return value > 60000;
		return true;
	}

    function renderTags(name, items){
		if (!$tagsRoot) return;
		$tagsRoot.innerHTML = '';
        // Reset option to show all
        var all = document.createElement('div');
        all.className = 'tour__tag';
        all.textContent = 'Все';
        all.dataset.filter = name;
        all.dataset.value = '';
        $tagsRoot.appendChild(all);
		items.forEach(function(it){
			var el = document.createElement('div');
			el.className = 'tour__tag';
			el.textContent = it;
			el.dataset.filter = name;
			el.dataset.value = it;
			$tagsRoot.appendChild(el);
		});
	}

	function applyFilters(){
		var visible = [];
		cards.forEach(function(card){
			var ok = true;
			if (filtersState.type){ ok = ok && (card.getAttribute('data-type') === filtersState.type); }
			if (filtersState.duration){ ok = ok && (card.getAttribute('data-duration') === filtersState.duration); }
			if (filtersState.price){
				var price = parseInt(card.getAttribute('data-price'), 10) || 0;
				ok = ok && inBucket(price, filtersState.price);
			}
			card.style.display = ok ? '' : 'none';
			if (ok) visible.push(card);
		});

		applyPagination(visible);
	}

	function applyPagination(visibleCards){
		var allVisible = visibleCards || cards.filter(function(c){ return c.style.display !== 'none'; });
		allVisible.forEach(function(c, idx){
			c.style.display = (idx < pageSize) ? '' : 'none';
		});
		var remaining = Math.max(allVisible.length - pageSize, 0);
		if ($moreWrap){
			if (remaining > 0){
				$moreWrap.hidden = false;
				if ($moreCount) $moreCount.textContent = remaining;
			} else {
				$moreWrap.hidden = true;
			}
		}
	}

	root.addEventListener('click', function(e){
		var btn = e.target.closest('.tour__filter-button');
		if (btn){
			var filter = btn.parentElement.getAttribute('data-filter');
			var options = collectOptions();
			renderTags(filter, options[filter] || []);
			return;
		}
		var tag = e.target.closest('.tour__tag');
		if (tag){
			var filter = tag.dataset.filter;
			var value = tag.dataset.value || null;
			filtersState[filter] = value && value.length ? value : null;
			applyFilters();
		}
	});

    // Initial render: show type tags by default
    // Collect options once on init
    options = collectOptions();

    // Bind filter buttons explicitly + toggle active state
    var $filters = [].slice.call(root.querySelectorAll('.tour__filter'));
    $filters.forEach(function($f){
        var $btn = $f.querySelector('.tour__filter-button');
        if ($btn){
            $btn.addEventListener('click', function(){
                $filters.forEach(function(el){ el.classList.remove('is-active'); });
                $f.classList.add('is-active');
                var name = $f.getAttribute('data-filter');
                var opts = collectOptions();
                renderTags(name, opts[name] || []);
            });
        }
    });

    // Tag click (delegated)
    $tagsRoot.addEventListener('click', function(e){
        var tag = e.target.closest('.tour__tag');
        if (tag){
            var filter = tag.dataset.filter;
            var value = tag.dataset.value || null;
            filtersState[filter] = value && value.length ? value : null;
            applyFilters();
        }
    });

    // Default: show all cards, apply initial pagination and render type tags
    cards.forEach(function(c){ c.style.display = ''; });
    applyPagination();
    renderTags('type', options.type || []);

    if ($moreBtn){
        $moreBtn.addEventListener('click', function(){
            pageSize += 6;
            applyFilters();
        });
    }
}

if (document.readyState === 'loading'){
    window.addEventListener('DOMContentLoaded', initTourFilters);
} else {
    initTourFilters();
}


