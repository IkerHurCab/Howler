async function fetchSingers() {
    const response = await fetch('../json/singers.json');
    const singers = await response.json();
    return singers;
}

function generateSingers(singers) {
    const container = document.getElementById('singers-container');

    singers.forEach(singer => {
        const singerDiv = document.createElement('div');
        singerDiv.className = 'singer bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transform transition duration-200 text-center hover:cursor-pointer';
        singerDiv.addEventListener('click', () => {
            window.location.href = `singer.php?id=${singer.id}`;
        });

        const img = document.createElement('img');
        img.src = singer.logo;
        img.alt = singer.name;
        img.className = 'w-24 h-24 mx-auto rounded-full mb-4 object-cover';

        const name = document.createElement('p');
        name.textContent = singer.name;
        name.className = 'text-lg font-semibold text-white';

        singerDiv.appendChild(img);
        singerDiv.appendChild(name);
        container.appendChild(singerDiv);
    });
}



document.addEventListener('DOMContentLoaded', function() {
    fetchSingers().then(function(singers) {
        generateSingers(singers);
    });
});