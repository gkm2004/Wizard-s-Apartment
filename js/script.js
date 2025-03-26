document.getElementById('music-icon').addEventListener('click', function () {
    let music = document.getElementById('background-music');
    let icon = document.getElementById('music-icon');

    if (music.paused) {
        music.play();
        icon.classList.remove('fa-volume-mute'); // Remove mute icon
        icon.classList.add('fa-volume-up'); // Show volume up when playing
    } else {
        music.pause();
        icon.classList.remove('fa-volume-up'); // Remove volume up icon
        icon.classList.add('fa-volume-mute'); // Show mute when paused
    }
});

document.querySelectorAll('.hotspot').forEach(hotspot => {
    hotspot.addEventListener('mouseover', function() {
      const tooltip = this.querySelector('.tooltip-text');
      tooltip.style.visibility = 'visible';
      tooltip.style.opacity = '1';
    });
    
    hotspot.addEventListener('mouseout', function() {
      const tooltip = this.querySelector('.tooltip-text');
      tooltip.style.visibility = 'hidden';
      tooltip.style.opacity = '0';
    });
  });
  
  document.getElementById('radio').addEventListener('click', function () {
    window.location.href = 'https://open.spotify.com/playlist/3C7VgeeS2uiaJns0MzJngo?si=464052e8c8c14641'; // Replace with your actual link
});

  document.getElementById('cat').addEventListener('click', function () {
    let purrSound = new Audio('audio/Purr.mp3');
    purrSound.volume = 0.5;
    purrSound.play();

    createHeart();

    setTimeout(() => {
        purrSound.pause(); // Pause the sound
        purrSound.currentTime = 0; // Reset to the start
    }, 5000); 
});

function createHeart() {
    let heart = document.createElement('div');
    heart.textContent = '❤️';
    heart.className = 'heart';

    let cat = document.getElementById('cat');
    let rect = cat.getBoundingClientRect();

    heart.style.left = `${rect.left + Math.random() * rect.width}px`;
    heart.style.top = `${rect.top + Math.random() * rect.height}px`;

    document.body.appendChild(heart);

    setTimeout(heart.remove.bind(heart), 2000); // Remove after 2s
}

document.getElementById('orb').addEventListener('click', function () {
    window.location.href = 'blog.php';
});

