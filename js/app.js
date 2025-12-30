document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;
  const toggleBtn = document.getElementById('themeToggle');

  function applyTheme(theme) {
    if (theme === 'light') {
      root.setAttribute('data-theme', 'light');
    } else {
      root.setAttribute('data-theme', 'dark');
    }
    if (toggleBtn) {
      toggleBtn.textContent = theme === 'light' ? '🌙' : '☀️';
    }
  }

  let saved = localStorage.getItem('hh_theme');
  if (saved !== 'light' && saved !== 'dark') {
    // default to LIGHT: bright, calm mental health space
    saved = 'light';
  }
  applyTheme(saved);

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const current = root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
      const next = current === 'light' ? 'dark' : 'light';
      localStorage.setItem('hh_theme', next);
      applyTheme(next);
    });
  }

  // Mobile nav hamburger toggle
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');
  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      navLinks.classList.toggle('is-open');
    });
  }

  // Lightweight pagination for Instagram placeholder grid on homepage
  var socialGrid = document.querySelector('[data-hh-social-paginated]');
  if (socialGrid) {
    var cards = Array.prototype.slice.call(
      socialGrid.querySelectorAll('.hh-social-card[data-page]')
    );
    var container = socialGrid.parentElement || document;
    var prevBtn = container.querySelector('[data-hh-social-prev]');
    var nextBtn = container.querySelector('[data-hh-social-next]');
    var indicator = container.querySelector('[data-hh-social-page-indicator]');

    if (!cards.length || !prevBtn || !nextBtn || !indicator) {
      // If any piece is missing, skip pagination without breaking the page
      return;
    }

    var totalPages = 1;
    for (var i = 0; i < cards.length; i++) {
      var v = parseInt(cards[i].getAttribute('data-page') || '1', 10);
      if (!isNaN(v) && v > totalPages) {
        totalPages = v;
      }
    }

    var currentPage = 1;

    function renderPage(page) {
      for (var j = 0; j < cards.length; j++) {
        var p = parseInt(cards[j].getAttribute('data-page') || '1', 10) || 1;
        cards[j].style.display = p === page ? '' : 'none';
      }

      indicator.textContent = page + ' / ' + totalPages;
      prevBtn.disabled = page === 1;
      nextBtn.disabled = page === totalPages;
    }

    prevBtn.addEventListener('click', function () {
      if (currentPage > 1) {
        currentPage -= 1;
        renderPage(currentPage);
      }
    });

    nextBtn.addEventListener('click', function () {
      if (currentPage < totalPages) {
        currentPage += 1;
        renderPage(currentPage);
      }
    });

    renderPage(currentPage);
  }
});
