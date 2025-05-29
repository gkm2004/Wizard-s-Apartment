document.addEventListener('DOMContentLoaded', () => {

  // 🎵 Music toggle
  const musicBtn = document.getElementById('music-icon');
  const music = document.getElementById('background-music');
  if (musicBtn && music) {
    musicBtn.addEventListener('click', () => {
      if (music.paused) {
        music.play();
        musicBtn.classList.remove('fa-volume-mute');
        musicBtn.classList.add('fa-volume-up');
      } else {
        music.pause();
        musicBtn.classList.remove('fa-volume-up');
        musicBtn.classList.add('fa-volume-mute');
      }
    });
  }

  // 🐾 Cat interaction with hearts + purr
  const cat = document.getElementById('cat');
  if (cat) {
    cat.addEventListener('click', () => {
      const purrSound = new Audio('audio/Purr.mp3');
      purrSound.volume = 0.5;
      purrSound.play();

      createHeart();

      setTimeout(() => {
        purrSound.pause();
        purrSound.currentTime = 0;
      }, 5000);
    });
  }

  function createHeart() {
    const heart = document.createElement('div');
    heart.textContent = '❤️';
    heart.className = 'heart';

    const rect = cat.getBoundingClientRect();
    heart.style.left = `${rect.left + Math.random() * rect.width}px`;
    heart.style.top = `${rect.top + Math.random() * rect.height}px`;

    document.body.appendChild(heart);
    setTimeout(() => heart.remove(), 2000);
  }

  // 🎯 Tooltips on hover
  document.querySelectorAll('.hotspot').forEach(hotspot => {
    const tooltip = hotspot.querySelector('.tooltip-text');
    if (tooltip) {
      hotspot.addEventListener('mouseover', () => {
        tooltip.style.visibility = 'visible';
        tooltip.style.opacity = '1';
      });

      hotspot.addEventListener('mouseout', () => {
        tooltip.style.visibility = 'hidden';
        tooltip.style.opacity = '0';
      });
    }
  });

  // 🔗 Navigation buttons
  const radio = document.getElementById('radio');
  if (radio) {
    radio.addEventListener('click', () => {
      window.location.href = 'https://open.spotify.com/playlist/3C7VgeeS2uiaJns0MzJngo?si=464052e8c8c14641';
    });
  }

  const orb = document.getElementById('orb');
  if (orb) {
    orb.addEventListener('click', () => {
      window.location.href = 'blog.php';
    });
  }

  const golu = document.getElementById('golu');
  if (golu) {
    golu.addEventListener('click', () => {
      window.location.href = 'gallery.php';
    });
  }

  const comp = document.getElementById('computer');
  if (comp) {
    comp.addEventListener('click', () => {
      window.location.href = 'projects.html';
    });
  }

  // 🧙‍♀️ AJAX Tag Filtering
  document.querySelectorAll('.tag').forEach(tag => {
    tag.addEventListener('click', function (e) {
      e.preventDefault();

      const selectedTag = this.dataset.tag;

      document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
      this.classList.add('active');

      fetch('./filter-gallery.php?tag=' + encodeURIComponent(selectedTag))
        .then(response => response.text())
        .then(html => {
          const gallery = document.getElementById('gallery-area');
          if (gallery) {
            gallery.innerHTML = html;
          }
        })
        .catch(error => console.error('AJAX error:', error));
    });
  });

});
