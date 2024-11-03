document.addEventListener('DOMContentLoaded', function() {
    fetch('../json/radios.json')
        .then(response => response.json())
        .then(data => {
            const radiosContainer = document.getElementById('radios-container');
            let currentSound = null;
            let footer = null;

            data.radios.forEach(radio => {
                const radioDiv = document.createElement('div');
                radioDiv.className = 'w-full bg-gray-800 p-6 rounded-lg shadow-lg transition transform hover:scale-105 text-center border border-gray-700';

                const logo = document.createElement('img');
                logo.className = 'w-16 h-16 mx-auto rounded-full mb-3';
                logo.src = radio.logo;

                const title = document.createElement('h2');
                title.className = 'text-2xl font-bold text-white mb-3';
                title.textContent = `${radio.title}`;

                const playButton = document.createElement('img');
                playButton.className = 'mx-auto cursor-pointer w-12 h-12 invert';
                playButton.src = '../media/util/play.png';

                playButton.addEventListener('click', () => {

                    if (currentSound && currentSound.playing()) {
                        currentSound.stop();
                        removeFooter();
                    }

                    currentSound = new Howl({
                        src: [radio.src],
                        html5: true
                    });

                    currentSound.play();
                    createFooter(radio);

                    playButton.src = '../media/util/pause.png';

                    currentSound.on('end', () => {
                        playButton.src = '../media/util/play.png';
                    });
                });

                radioDiv.appendChild(logo);
                radioDiv.appendChild(title);
                radioDiv.appendChild(playButton);
                radiosContainer.appendChild(radioDiv);
            });

            function createFooter(radio) {
                if (footer) removeFooter();

                footer = document.createElement('footer');
                footer.className = 'fixed bottom-0 w-full bg-black p-4 flex justify-between items-center border-t border-gray-700';

                footer.innerHTML = `
                    <div class="flex items-center">
                        <img src="${radio.logo}" class="h-12 w-12 rounded-full mr-4 spin" id="footerLogo">
                        <h2 class="text-white mr-4">${radio.title}</h2>
                    </div>
                    <div class="flex gap-4 items-center">
                        <img src="../media/util/play.png" class="invert hidden" id="play" style="height: 25px;">
                        <img src="../media/util/pause.png" class="invert" id="pause" style="height: 25px;">
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="../media/util/audio3.png" class="invert" id="volume-icon" style="height: 25px;">
                        <input type="range" id="volume-control" class="h-2 bg-gray-700 rounded-lg cursor-pointer" min="0" max="1" step="0.01" value="1" style="width: 100px;">
                    </div>
                `;

                document.body.appendChild(footer);

                const playButtonFooter = footer.querySelector('#play');
                const pauseButtonFooter = footer.querySelector('#pause');
                const volumeControl = footer.querySelector('#volume-control');
                const volumeIcon = footer.querySelector('#volume-icon');

                volumeControl.addEventListener('input', function () {
                    currentSound.volume(this.value);
                    updateVolumeIcon(this.value);
                });

                function updateVolumeIcon(volume) {
                    if (volume <= 0.00) {
                        volumeIcon.src = '../media/util/audio0.png';
                    } else if (volume <= 0.33) {
                        volumeIcon.src = '../media/util/audio1.png';
                    } else if (volume <= 0.66) {
                        volumeIcon.src = '../media/util/audio2.png';
                    } else {
                        volumeIcon.src = '../media/util/audio3.png';
                    }
                }

                playButtonFooter.addEventListener('click', () => {
                    currentSound.play();
                    playButtonFooter.classList.add('hidden');
                    pauseButtonFooter.classList.remove('hidden');
                });

                pauseButtonFooter.addEventListener('click', () => {
                    currentSound.pause();
                    playButtonFooter.classList.remove('hidden');
                    pauseButtonFooter.classList.add('hidden');
                });
            }

            function removeFooter() {
                if (footer) {
                    footer.remove();
                    footer = null;
                }
            }
        });
});
