<script>
document.addEventListener('DOMContentLoaded', async () => { 
    const url = '<?= base_url('assets/pontos.json') ?>';
    
    try {
         const response = await fetch(url);
        const pontos = await response.json();

        var map = L.map('map').setView([-22.4707, -44.4500], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        pontos.forEach(p => {
          L.marker(p.coords)
            .addTo(map)
            .bindPopup(`<b>${p.nome}</b><br>${p.endereco}<br><small>${p.horarios}</small>`);
        });

        const container = document.querySelector(".col-lg-5");
        let listaHTML = "";
            pontos.forEach(p => {
            listaHTML += `
                <div class="location-card border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>${p.nome}</h5>
                    <small>${p.tipo}</small>
                </div>
                <p class="text-muted">
                    <i class="bi bi-geo-alt-fill me-2"></i>${p.endereco}<br>
                    <a href="#">Ver como chegar</a>
                </p>
                <ul class="list-unstyled text-muted">
                    <li><i class="bi bi-clock me-2"></i>${p.horarios}</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="mb-0 text-muted">Chegará na agência amanhã <span class="fw-bold">R$ ${p.preco.toFixed(2)}</span></p>
                    <button class="btn btn-primary">Escolher</button>
                </div>
                </div>
            `;
        });

    container.insertAdjacentHTML("beforeend", listaHTML);
    } catch (error) {
        console.error('Erro ao carregar o JSON: ', error);
    }
})
</script>
