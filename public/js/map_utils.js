/**
 * Utilitários de Mapa e Localização para o GUIAR
 */

// =============================
// BUSCA CEP (ViaCEP)
// =============================
function buscarCEP(cepInputId, enderecoId, bairroId, cidadeId, estadoId) {
    const input = document.getElementById(cepInputId);
    if (!input) return;

    input.addEventListener("blur", function () {
        let cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert("CEP inválido!");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert("CEP não encontrado!");
                    return;
                }

                if (document.getElementById(enderecoId)) document.getElementById(enderecoId).value = data.logradouro;
                if (document.getElementById(bairroId)) document.getElementById(bairroId).value = data.bairro;
                if (document.getElementById(cidadeId)) document.getElementById(cidadeId).value = data.localidade;
                if (document.getElementById(estadoId)) document.getElementById(estadoId).value = data.uf;
            })
            .catch(error => {
                console.error("Erro ao buscar CEP:", error);
            });
    });
}

// =============================
// GEOCODIFICAÇÃO (Nominatim/OSM)
// =============================

/**
 * Obtém coordenadas para um endereço e submete o formulário
 * @param {string} formId ID do formulário a ser submetido
 * @param {object} fields Mapeamento de IDs dos campos de endereço
 */
function geocodeAndSubmit(formId, fields) {
    const endereco = document.getElementById(fields.endereco).value;
    const bairro = document.getElementById(fields.bairro).value;
    const cidade = document.getElementById(fields.cidade).value;
    const estado = document.getElementById(fields.estado).value;

    const address = `${endereco}, ${bairro}, ${cidade}, ${estado}, Brasil`;
    const url = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1&limit=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                document.getElementById(fields.latitude).value = data[0].lat;
                document.getElementById(fields.longitude).value = data[0].lon;
                document.getElementById(formId).submit();
            } else {
                alert('Endereço não encontrado com precisão. Verifique os dados e tente novamente.');
            }
        })
        .catch(error => {
            console.error("Erro na geocodificação:", error);
            alert("Erro ao obter localização. Verifique sua conexão.");
        });
}

// Helpers específicos para os formulários de pedido
function geocodeAddress() {
    geocodeAndSubmit('newOrderForm', {
        endereco: 'endereco',
        bairro: 'bairro',
        cidade: 'cidade',
        estado: 'estado',
        latitude: 'latitude',
        longitude: 'longitude'
    });
}

function geocodeAddressEdit() {
    geocodeAndSubmit('editOrderForm', {
        endereco: 'edit_endereco',
        bairro: 'edit_bairro',
        cidade: 'edit_cidade',
        estado: 'edit_estado',
        latitude: 'edit_latitude',
        longitude: 'edit_longitude'
    });
}
