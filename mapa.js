// Inicializa o mapa com a posição central em Brazlândia, DF
const map = L.map('map').setView([-15.664, -48.202], 14);

// Adiciona a camada do OpenStreetMap com crédito apropriado
const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Variáveis para controle de edição e armazenamento dos marcadores
let markerToEditId = null;
let allMarkers = [];

// Função para alternar a exibição dos botões de filtro
function toggleFilterButtons() {
    const filterButtons = document.getElementById('filter-buttons');
    filterButtons.classList.toggle('hidden');
    filterButtons.style.display = filterButtons.classList.contains('hidden') ? 'none' : 'block';
}

// Função para fechar qualquer formulário
function closeForm(formId) {
    document.getElementById(formId).style.display = 'none';
}

// Função para "curtir" um marcador, com confirmação amigável
function likeMarker(markerId) {
    if (confirm("Você quer curtir este ponto?")) {
        fetch('like_marker.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: markerId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Você curtiu este ponto com sucesso!');
                loadMarkers(); // Atualiza a lista de marcadores
            } else {
                alert('Houve um problema ao curtir: ' + data.message);
            }
        })
        .catch(error => console.error('Erro ao curtir o marcador:', error));
    }
}

// Função para inativar um marcador, com confirmação amigável
function inactivateMarker(markerId) {
    if (confirm("Tem certeza de que quer inativar este ponto?")) {
        fetch('inactivate_marker.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: markerId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Este ponto foi inativado.');
                loadMarkers(); // Atualiza a lista de marcadores
            } else {
                alert('Erro ao inativar o ponto: ' + data.message);
            }
        })
        .catch(error => console.error('Erro ao inativar o marcador:', error));
    }
}

// Função para carregar e exibir todos os marcadores
function loadMarkers() {
    fetch('get_markers.php')
    .then(response => response.json())
    .then(data => {
        allMarkers = data;
        displayMarkers(allMarkers); // Exibe todos os marcadores carregados
    })
    .catch(error => {
        console.error('Erro ao carregar marcadores:', error);
        alert("Não foi possível carregar os pontos. Tente novamente mais tarde.");
    });
}

// Função para selecionar o ícone de categoria do marcador
function getCategoryIcon(category) {
    const icons = {
        1: 'imagens/comes-e-bebes.png',
        2: 'imagens/comercio.png',
        3: 'imagens/mercado-feira.png',
        4: 'imagens/lazer.png',
        5: 'imagens/publico.png',
        6: 'imagens/turistico.png'
    };
    return icons[category] || null;
}

// Função para exibir marcadores no mapa
function displayMarkers(markers) {
    map.eachLayer(layer => {
        if (layer instanceof L.Marker) {
            map.removeLayer(layer);
        }
    });

    markers.forEach(markerData => {
        let popupContent = `<div class="popup-content">
                                <b>${markerData.nome}</b><br />
                                <p>${markerData.descriptionn}</p>`;

        const categoryIcon = getCategoryIcon(markerData.categoria);
        if (categoryIcon) {
            popupContent = `<img src="${categoryIcon}" alt="Ícone da Categoria" class="categoria-icon">` + popupContent;
        }

        if (markerData.imgurl) {
            popupContent += `<img src="${markerData.imgurl}" alt="Imagem" class="popup-image">`;
        }

        popupContent += `<div class="likes-container">
                            <span class="like-count">${markerData.likes} curtidas</span>
                            <button class="like-button" onclick="likeMarker(${markerData.id})">
                                <img src="imagens/logoo.png" alt="Curtir" class="like-icon">
                            </button>
                        </div>`;

        if (markerData.user_id == loggedInUserId) {
            popupContent += `<button class="edit-button" onclick="editMarker(${markerData.id}, '${markerData.nome}', '${markerData.descriptionn}', '${markerData.imgurl}')">Editar</button>`;
        }
        
        popupContent += '</div>';

        let iconUrl = 'imagens/icone_azul.png';
        if (markerData.evento == 1) {
            iconUrl = 'imagens/estrela.png';
        } else if (loggedInUserId && markerData.user_id == loggedInUserId) {
            iconUrl = 'imagens/icone_amarelo.png';
        } else if (markerData.user_type === 'admin') {
            iconUrl = 'imagens/icone_vermelho.png';
        }

        const markerIcon = L.icon({
            iconUrl: iconUrl,
            iconSize: [30, 30],
            iconAnchor: [15, 41],
            popupAnchor: [1, -34]
        });

        L.marker([markerData.latitude, markerData.longitude], { icon: markerIcon }).addTo(map).bindPopup(popupContent);
    });
}

// Função para filtrar marcadores por evento e categoria
function filterMarkers(eventOnly, category) {
    const filteredMarkers = allMarkers.filter(marker => {
        const matchesEvent = eventOnly ? marker.evento === 1 : marker.evento === 0;
        const matchesCategory = category === 'all' || marker.categoria === String(category);
        return matchesEvent && matchesCategory;
    });
    displayMarkers(filteredMarkers);
}

// Função para editar marcadores
function editMarker(id, name, description, imageUrl) {
    if (document.getElementById('markerForm').style.display !== 'none') {
        alert('Feche o menu de "Adicionar Ponto" antes de editar um ponto.');
        return;
    }
    markerToEditId = id;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editImage').value = imageUrl;
    document.getElementById('editMarkerForm').style.display = 'block'; 
}

// Configuração do formulário de edição de ponto
document.getElementById('editForm').onsubmit = function(event) {
    event.preventDefault();
    const editName = document.getElementById('editName').value;
    const editDescription = document.getElementById('editDescription').value;
    const editImage = document.getElementById('editImage').value;

    if (confirm("Confirma a edição deste ponto?")) {
        fetch('edit_marker.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: markerToEditId,
                name: editName,
                description: editDescription,
                image: editImage
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Ponto atualizado com sucesso!');
                loadMarkers();
                closeForm('editMarkerForm');
            } else {
                alert('Erro ao editar o ponto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao editar ponto:', error);
            alert('Ocorreu um erro ao atualizar o ponto.');
        });
    } else {
        console.log('Edição cancelada.');
    }
};

// Configuração do clique no mapa para adicionar um ponto
map.on('click', function(e) {
    if (document.getElementById('editMarkerForm').style.display !== 'none') {
        alert('Feche o menu "Editar Ponto" antes de adicionar um novo ponto.');
        return;
    }

    if (document.getElementById('markerForm').style.display !== 'none') {
        alert('Feche o menu atual antes de adicionar outro ponto.');
        return;
    }

    document.getElementById('markerForm').style.display = 'block'; 

    document.getElementById('addMarkerForm').onsubmit = function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        const image = document.getElementById('image').value.trim();
        const category = document.getElementById('category').value;
        const evento = document.getElementById('evento').checked ? 1 : 0;

        if (confirm("Confirma a adição deste ponto?")) {
            fetch('save_marker.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    latitude: e.latlng.lat,
                    longitude: e.latlng.lng,
                    name,
                    description,
                    image,
                    category,
                    evento
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Ponto adicionado com sucesso!');
                    loadMarkers();
                    closeForm('markerForm');
                } else {
                    alert('Erro ao adicionar ponto: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro ao adicionar ponto:', error);
                alert('Não foi possível adicionar o ponto. Tente novamente.');
            });
        }
    };
});

// Carrega os marcadores quando a página é carregada
loadMarkers();
