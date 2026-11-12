(function () {
  'use strict';
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* Header */
  var tg = $('.menu-toggle'), nav = $('#main-nav');
  if (tg && nav) tg.addEventListener('click', function () {
    var o = nav.classList.toggle('open'); tg.setAttribute('aria-expanded', o);
  });
  $$('[data-top]').forEach(function (a) { a.addEventListener('click', function (e) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); }); });

  /* Hero slider */
  var hero = $('[data-hero]');
  if (hero) {
    var track = $('.hero-track', hero), slides = $$('.hero-slide', hero), dots = $('.hero-dots', hero), i = 0, t;
    var go = function (n) {
      i = (n + slides.length) % slides.length;
      track.style.transform = 'translateX(' + (-100 * i) + '%)';
      $$('button', dots).forEach(function (d, k) { d.classList.toggle('on', k === i); });
      /* Video chỉ phát khi slide đang hiển thị */
      slides.forEach(function (sl, k) {
        var v = $('video', sl); if (!v) return;
        if (k === i) { var pr = v.play(); if (pr && pr.catch) pr.catch(function () {}); } else { v.pause(); }
      });
    };
    slides.forEach(function (_, k) {
      var b = document.createElement('button'); b.type = 'button'; b.setAttribute('aria-label', 'Banner ' + (k + 1));
      b.addEventListener('click', function () { go(k); reset(); }); dots.appendChild(b);
    });
    var reset = function () { clearInterval(t); if (slides.length > 1 && !matchMedia('(prefers-reduced-motion: reduce)').matches) t = setInterval(function () { go(i + 1); }, 5000); };
    $('.prev', hero).addEventListener('click', function () { go(i - 1); reset(); });
    $('.next', hero).addEventListener('click', function () { go(i + 1); reset(); });
    if (slides.length < 2) { $('.prev', hero).hidden = $('.next', hero).hidden = true; dots.hidden = true; }
    go(0); reset();
  }

  /* Rail (bác sĩ) */
  $$('[data-rail]').forEach(function (r) {
    var tr = $('.rail-track', r);
    /* Vòng lặp: bấm tiếp ở thẻ cuối thì quay về thẻ đầu, bấm lùi ở thẻ đầu thì nhảy sang thẻ cuối */
    var step = function (d) {
      var c = tr.firstElementChild, max = tr.scrollWidth - tr.clientWidth;
      if (d > 0 && tr.scrollLeft >= max - 6) { tr.scrollTo({ left: 0, behavior: 'smooth' }); return; }
      if (d < 0 && tr.scrollLeft <= 6) { tr.scrollTo({ left: max, behavior: 'smooth' }); return; }
      tr.scrollBy({ left: d * (c ? c.offsetWidth + 24 : 400), behavior: 'smooth' });
    };
    $('.prev', r).addEventListener('click', function () { step(-1); });
    $('.next', r).addEventListener('click', function () { step(1); });
    /* thẻ ở giữa = nổi bật, các thẻ còn lại mờ đi */
    var mark = function () {
      var rect = tr.getBoundingClientRect(), mid = rect.left + rect.width / 2, best = null, bd = 1e9;
      $$('.doc', tr).forEach(function (d) {
        var b = d.getBoundingClientRect(), dist = Math.abs(b.left + b.width / 2 - mid);
        if (dist < bd) { bd = dist; best = d; }
      });
      $$('.doc', tr).forEach(function (d) { d.classList.toggle('is-active', d === best); });
      r.classList.add('has-active');
    };
    tr.addEventListener('scroll', function () { clearTimeout(tr._t); tr._t = setTimeout(mark, 60); }, { passive: true });
    window.addEventListener('resize', mark); mark();
  });

  /* Người nổi tiếng */
  $$('[data-celeb]').forEach(function (w) {
    var img = $('[data-c-img]', w), ph = $('[data-c-ph]', w);
    $$('.celeb-list button', w).forEach(function (b) {
      b.addEventListener('click', function () {
        $$('.celeb-list button', w).forEach(function (x) { x.classList.remove('on'); }); b.classList.add('on');
        $('[data-c-name]', w).textContent = b.dataset.name;
        $('[data-c-role]', w).textContent = b.dataset.role;
        $('[data-c-desc]', w).textContent = b.dataset.desc;
        if (b.dataset.img) { img.src = b.dataset.img; img.alt = b.dataset.name; img.hidden = false; if (ph) ph.hidden = true; }
        else { img.hidden = true; if (ph) ph.hidden = false; }
      });
    });
  });

  /* Trước / sau: kéo để so sánh */
  $$('[data-ba]').forEach(function (el) {
    var rng = $('input[type=range]', el);
    var set = function (v) { el.style.setProperty('--pos', v + '%'); };
    rng.addEventListener('input', function () { set(rng.value); });
    set(50);
  });
  $$('[data-ba-group]').forEach(function (g) {
    $$('[data-ba-tab]', g).forEach(function (b) {
      b.addEventListener('click', function () {
        $$('[data-ba-tab]', g).forEach(function (x) { x.classList.toggle('on', x === b); });
        $$('[data-ba-item]', g).forEach(function (x) { x.classList.toggle('on', x.dataset.baItem === b.dataset.baTab); });
      });
    });
  });

  /* Modal đặt lịch */
  var fp = $('#float-panel');
  if (fp) {
    var ft = $('[data-float-toggle]'), tg = function (o) { fp.hidden = !o; if (ft) ft.setAttribute('aria-expanded', o ? 'true' : 'false'); };
    if (ft) ft.addEventListener('click', function () { tg(fp.hidden); });
    $$('[data-float-close]').forEach(function (b) { b.addEventListener('click', function () { tg(false); }); });
  }
  var m = $('#contact-modal');
  if (m) {
    $$('[data-open-contact]').forEach(function (b) { b.addEventListener('click', function () { m.classList.add('open'); var f = $('input[name=pw_name]', m); if (f) f.focus(); }); });
    $$('[data-close-contact]').forEach(function (b) { b.addEventListener('click', function () { m.classList.remove('open'); }); });
    m.addEventListener('click', function (e) { if (e.target === m) m.classList.remove('open'); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') m.classList.remove('open'); });
  }
  var p = $('[data-promo] button'); if (p) p.addEventListener('click', function () { p.parentNode.remove(); });
  var ts = $('[data-toast]'); if (ts) setTimeout(function () { ts.remove(); }, 4500);
})();

/* Bộ lọc danh sách dịch vụ */
(function () {
  var bar = document.querySelector('[data-filter]'), grid = document.querySelector('[data-grid]');
  if (!bar || !grid) return;
  var cards = Array.prototype.slice.call(grid.children), empty = document.querySelector('[data-empty]');
  var n = function (c, k) { return parseInt(c.getAttribute('data-' + k), 10) || 0; };
  bar.addEventListener('click', function (e) {
    var b = e.target.closest('button[data-f]'); if (!b) return;
    Array.prototype.forEach.call(bar.children, function (x) { x.classList.toggle('on', x === b); });
    var f = b.getAttribute('data-f'), list = cards.slice();
    if (f === 'desc') list.sort(function (a, c) { return n(c, 'price') - n(a, 'price'); });
    else if (f === 'asc') list.sort(function (a, c) { return (n(a, 'price') || 9e12) - (n(c, 'price') || 9e12); });
    else list.sort(function (a, c) { return n(a, 'i') - n(c, 'i'); });
    var shown = 0;
    list.forEach(function (c) {
      var ok = f === 'sale' ? n(c, 'disc') > 0 : f === 'hot' ? n(c, 'pop') > 0 : true;
      c.hidden = !ok; if (ok) shown++; grid.appendChild(c);
    });
    if (empty) empty.hidden = shown > 0;
  });
})();

/* Hiệu ứng xuất hiện khi cuộn + "spotlight" tự chạy ở khối Lý do chọn + mục lục + lọc bảng giá */
(function () {
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };
  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  var items = $$('[data-reveal]');
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: .15, rootMargin: '0px 0px -40px 0px' });
    items.forEach(function (el) { io.observe(el); });
  } else items.forEach(function (el) { el.classList.add('in'); });

  /* Spotlight: lần lượt làm nổi từng ảnh, tạm dừng khi rê chuột, chỉ chạy khi nhìn thấy */
  $$('[data-spot]').forEach(function (g) {
    var tiles = $$('.rs-i', g); if (tiles.length < 2 || reduce) return;
    var i = -1, t = null, visible = false, paused = false, ms = 2800;
    g.style.setProperty('--spot', ms + 'ms');
    var step = function () {
      if (!visible || paused) return;
      tiles.forEach(function (x) { x.classList.remove('is-spot'); });
      i = (i + 1) % tiles.length; void tiles[i].offsetWidth; tiles[i].classList.add('is-spot'); g.classList.add('spot-on');
    };
    var start = function () { clearInterval(t); step(); t = setInterval(step, ms); };
    g.addEventListener('mouseenter', function () { paused = true; tiles.forEach(function (x) { x.classList.remove('is-spot'); }); });
    g.addEventListener('mouseleave', function () { paused = false; start(); });
    if ('IntersectionObserver' in window) new IntersectionObserver(function (es) {
      visible = es[0].isIntersecting;
      if (visible) start(); else { clearInterval(t); g.classList.remove('spot-on'); tiles.forEach(function (x) { x.classList.remove('is-spot'); }); }
    }, { threshold: .3 }).observe(g);
  });

  /* Mục lục tự tạo từ các tiêu đề h2 của bài dịch vụ */
  $$('[data-toc]').forEach(function (toc) {
    var body = document.querySelector('.sv-content'); if (!body) return;
    var hs = $$('h2:not(.sv-lead)', body).filter(function (h) { return h.textContent.trim(); });
    if (hs.length < 3) return;
    var ol = toc.querySelector('ol');
    hs.forEach(function (h, k) {
      h.id = h.id || 'muc-' + (k + 1);
      var li = document.createElement('li'), a = document.createElement('a');
      a.href = '#' + h.id; a.textContent = h.textContent.replace(/^\d+\.\s*/, ''); li.appendChild(a); ol.appendChild(li);
    });
    toc.hidden = false;
  });

  /* Lọc bảng giá theo thời gian bảo hành */
  $$('[data-pxb]').forEach(function (b) {
    var tabs = $$('.pxb-tabs button', b), rows = $$('tbody tr', b);
    tabs.forEach(function (t) {
      t.addEventListener('click', function () {
        tabs.forEach(function (x) { x.classList.toggle('on', x === t); });
        rows.forEach(function (r) { r.hidden = t.dataset.w !== 'all' && r.dataset.w !== t.dataset.w; });
      });
    });
  });

  /* Sao chép link bài viết */
  $$('[data-copy]').forEach(function (b) {
    b.addEventListener('click', function () {
      var u = b.dataset.copy, done = function () { var t = b.textContent; b.textContent = 'Đã sao chép ✓'; setTimeout(function () { b.textContent = t; }, 1800); };
      if (navigator.clipboard) navigator.clipboard.writeText(u).then(done); else { var i = document.createElement('input'); i.value = u; document.body.appendChild(i); i.select(); document.execCommand('copy'); i.remove(); done(); }
    });
  });

  /* Bảng giá: chọn nhóm dịch vụ */
  $$('[data-pv]').forEach(function (w) {
    var bs = $$('.pv-chips button', w), gs = $$('.pv-group', w);
    bs.forEach(function (b) {
      b.addEventListener('click', function () {
        bs.forEach(function (x) { x.classList.toggle('on', x === b); });
        gs.forEach(function (g) { g.hidden = b.dataset.g !== 'all' && g.dataset.group !== b.dataset.g; });
      });
    });
  });
})();
