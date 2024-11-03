document.addEventListener('DOMContentLoaded', function () {
    const playButtons = document.querySelectorAll('.play-button');
    let song;
    let currentIndex = 0;
    let songs = [];

    playButtons.forEach((button, index) => {
        songs.push({
            url: button.getAttribute('data-url'),
            logo: button.getAttribute('data-logo'),
            name: button.getAttribute('data-name')
        });

        button.addEventListener('click', function controlSong() {
            currentIndex = index;
            playSong(currentIndex);
        });
    });

    function playSong(index) {
        if (song) {
            if (song.playing()) {
                song.stop();
            }
        }

        const { url, logo, name } = songs[index];

        song = new Howl({
            src: [url],
            html5: true,
            onload: function() {
                updateFooter(logo, name);
                updateTimeDisplay(0, song.duration());
            },
            onend: function() {
                currentIndex = (currentIndex + 1) % songs.length;
                playSong(currentIndex);
            }
        });

        song.play();

        song.on('play', function () {
            requestAnimationFrame(updateProgress);
        });

        document.addEventListener('keydown', function (event) {
            if (event.code === 'Space') {
                event.preventDefault();
                if (song.playing()) {
                    song.pause();
                    updateButtonToPlay();
                } else {
                    song.play();
                    updateButtonToPause();
                }
            }
        });
    }

    function updateFooter(logo, name) {
        let footer = document.querySelector('footer');
        if (!footer) {
            footer = document.createElement('footer');
            footer.classList.add('fixed', 'bottom-0', 'w-full', 'bg-black', 'p-4', 'flex', 'justify-between', 'items-center', 'border-t', 'border-white');
            document.body.appendChild(footer);
        }

        footer.innerHTML = `
            <div class="flex items-center">
                <img src="${logo}" class="h-12 w-12 rounded-full mr-4 spin" id="footerLogo">
                <h2 class="text-white mr-4">${name}</h2>
            </div>
            <div class="flex gap-4 items-center">
                <img src="../media/util/previous.png" class="invert" id="previous" style="height: 25px;">
                <img src="../media/util/play.png" class="invert hidden" id="play" style="height: 25px;">
                <img src="../media/util/pause.png" class="invert" id="pause" style="height: 25px;">
                <img src="../media/util/next.png" class="invert" id="next" style="height: 25px;">
                <input type="range" id="progress-bar" style="width:200px;">
                <p id="time-display" class="text-white text-sm">0:00 / 0:00</p>
            </div>
            <div class="flex items-center gap-4">
                <img src="../media/util/audio3.png" class="invert" id="volume-icon" style="height: 25px;">
                <input type="range" id="volume-control" class="h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer" min="0" max="1" step="0.01" value="1" style="width: 100px;">
            </div>
        `;

        const logoElement = document.getElementById('footerLogo');
        const play = footer.querySelector('#play');
        const pause = footer.querySelector('#pause');
        const progressBar = footer.querySelector('#progress-bar');
        const volumeControl = footer.querySelector('#volume-control');
        const volumeIcon = footer.querySelector('#volume-icon');
        const timeDisplay = footer.querySelector('#time-display');
        const previous = footer.querySelector('#previous');
        const next = footer.querySelector('#next');

        play.addEventListener('click', function () {
            song.play();
            play.classList.add('hidden');
            pause.classList.remove('hidden');
            logoElement.classList.add('spin');
            updateButtonToPause();
        });

        pause.addEventListener('click', function () {
            song.pause();
            play.classList.remove('hidden');
            pause.classList.add('hidden');
            logoElement.classList.remove('spin');
            updateButtonToPlay();
        });

        volumeControl.addEventListener('input', function () {
            song.volume(this.value);
            updateVolumeIcon(this.value);
        });

        previous.addEventListener('click', function () {
            currentIndex = (currentIndex - 1 + songs.length) % songs.length;
            playSong(currentIndex);
        });

        next.addEventListener('click', function () {
            currentIndex = (currentIndex + 1) % songs.length;
            playSong(currentIndex);
        });

        progressBar.addEventListener('input', function () {
            const seekTime = song.duration() * (progressBar.value / 100);
            song.seek(seekTime);
        });
    }

    function updateVolumeIcon(volume) {
        const volumeIcon = document.getElementById('volume-icon');
        if (volume <= 0.01) {
            volumeIcon.src = '../media/util/audio0.png';
        } else if (volume <= 0.33) {
            volumeIcon.src = '../media/util/audio1.png';
        } else if (volume <= 0.66) {
            volumeIcon.src = '../media/util/audio2.png';
        } else {
            volumeIcon.src = '../media/util/audio3.png';
        }
    }

    function updateProgress() {
        const seek = song.seek() || 0;
        const duration = song.duration();
        const progressBar = document.getElementById('progress-bar');

        if (duration > 0) {
            progressBar.value = (seek / duration) * 100;
            updateTimeDisplay(seek, duration);
        }

        if (song.playing()) {
            requestAnimationFrame(updateProgress);
        }
    }

    function updateTimeDisplay(currentTime, duration) {
        const currentMinutes = Math.floor(currentTime / 60);
        const currentSeconds = Math.floor(currentTime % 60);
        const durationMinutes = Math.floor(duration / 60);
        const durationSeconds = Math.floor(duration % 60);

        const formattedCurrentTime = `${currentMinutes}:${currentSeconds < 10 ? '0' : ''}${currentSeconds}`;
        const formattedDuration = `${durationMinutes}:${durationSeconds < 10 ? '0' : ''}${durationSeconds}`;

        const timeDisplay = document.getElementById('time-display');
        timeDisplay.textContent = `${formattedCurrentTime} / ${formattedDuration}`;
    }

    function updateButtonToPause() {
        playButtons[currentIndex].innerHTML = '<img src="../media/util/pause.png" class="invert" style="height: 25px;">';
    }

    function updateButtonToPlay() {
        playButtons[currentIndex].innerHTML = '<img src="../media/util/play.png" class="invert" style="height: 25px;">';
    }
});
