
async function getDataCep(cep){
    showLoader()
    const resp = await fetch(`https://viacep.com.br/ws/${cep}/xml/`)
        .then(response => response.text())
        .then(function (data) {
            let parser = new DOMParser(), 
            xml = parser.parseFromString(data, 'text/xml');
            
            let data_cep          = xml.getElementsByTagName("cep")[0].childNodes[0].nodeValue
            let data_logradouro   = xml.getElementsByTagName("logradouro")[0].childNodes[0].nodeValue
            let data_bairro       = xml.getElementsByTagName("bairro")[0].childNodes[0].nodeValue
            let data_localidade   = xml.getElementsByTagName("localidade")[0].childNodes[0].nodeValue
            let data_uf           = xml.getElementsByTagName("uf")[0].childNodes[0].nodeValue
        
            let body_data = {
                "cep": data_cep,
                "logradouro": data_logradouro,
                "bairro": data_bairro,
                "localidade": data_localidade,
                "uf": data_uf,
            };

            registerCep(body_data);

        })
        .catch(function() {
            document.getElementById("title-modal").innerHTML = "Atenção !";
            document.getElementById("text-modal").innerHTML = "O CEP informado é inválido !";
            document.getElementById("button-modal").click();
            hideLoader()
        });;

}

async function registerCep(body){
    showLoader()
    await fetch("services/register_cep.php",
        {
            method: "POST",
            body: JSON.stringify(body)
        })
        .then(response => response.text())
        .then(str => (new window.DOMParser()).parseFromString(str, "text/xml"))
        .then(data => {
            let status = data.getElementsByTagName("status")[0].childNodes[0].nodeValue;
            document.getElementById("text-modal").innerHTML = "";
            switch (status) {
                case 'true':

                    let data_cep          = data.getElementsByTagName("cep")[0].childNodes[0].nodeValue;
                    let data_logradouro   = data.getElementsByTagName("logradouro")[0].childNodes[0].nodeValue;
                    let data_localidade   = data.getElementsByTagName("localidade")[0].childNodes[0].nodeValue;
                    let data_bairro   = data.getElementsByTagName("bairro")[0].childNodes[0].nodeValue;
                    let data_uf           = data.getElementsByTagName("uf")[0].childNodes[0].nodeValue;

                    document.getElementById("title-modal").innerHTML = "Encontramos seu endereço !";
                    document.getElementById("text-modal").innerHTML = 
                    `
                        <p>Cep: <span>${data_cep}</span></p>
                        <p>Logradouro: <span>${data_logradouro}</span></p>
                        <p>Bairro: <span>${data_bairro}</span></p>
                        <p>Localidade: <span>${data_localidade}</span></p>
                        <p>UF: <span>${data_uf}</span></p>
                    `;
                    document.getElementById("button-modal").click();
                    hideLoader()
                    break;
                case 'error':
                    document.getElementById("title-modal").innerHTML = "Atenção !";
                    document.getElementById("text-modal").innerHTML = "Houve uma instabilidade com o servidor, tente novamente daqui a uns minutos !";
                    document.getElementById("button-modal").click();
                    hideLoader()
                break;
            }
     
        });
}


async function checkCep(data){
    showLoader()

    await fetch("services/check_cep.php",
    {
        method: "POST",
        body: JSON.stringify({"cep": data})
    })
    .then(response => response.text())
    .then(str => (new window.DOMParser()).parseFromString(str, "text/xml"))
    .then(data => {
        let status = data.getElementsByTagName("status")[0].childNodes[0].nodeValue;
        switch (status) {
            case 'true':
                let data_cep          = data.getElementsByTagName("cep")[0].childNodes[0].nodeValue;
                let data_logradouro   = data.getElementsByTagName("logradouro")[0].childNodes[0].nodeValue;
                let data_localidade   = data.getElementsByTagName("localidade")[0].childNodes[0].nodeValue;
                let data_bairro   = data.getElementsByTagName("bairro")[0].childNodes[0].nodeValue;
                let data_uf           = data.getElementsByTagName("uf")[0].childNodes[0].nodeValue;

                document.getElementById("title-modal").innerHTML = "Encontramos seu endereço !";
                document.getElementById("text-modal").innerHTML = 
                `
                    <p>Cep: <span>${data_cep}</span></p>
                    <p>Logradouro: <span>${data_logradouro}</span></p>
                    <p>Bairro: <span>${data_bairro}</span></p>
                    <p>Localidade: <span>${data_localidade}</span></p>
                    <p>UF: <span>${data_uf}</span></p>
                `;
                document.getElementById("button-modal").click();
                hideLoader()
                break;
            case 'false':
                let cep = data.getElementsByTagName("cep")[0].childNodes[0].nodeValue;
                getDataCep(cep);
                break; 
            case 'error':
                document.getElementById("title-modal").innerHTML = "Atenção !";
                document.getElementById("text-modal").innerHTML = "O CEP informado é inválido !";
                document.getElementById("button-modal").click();
                hideLoader()
            break;
        }


    });


}

async function showLoader(){
    let element = document.querySelector(".loader-background");
        element.style.display = 'flex';
}

async function hideLoader(){
    let element = document.querySelector(".loader-background");
        element.style.display = 'none';
}


document.getElementById('form-cep').addEventListener('submit', function (event){
    showLoader()
    event.preventDefault();

    let cep = document.getElementById('cep').value;

    checkCep(cep);

});


