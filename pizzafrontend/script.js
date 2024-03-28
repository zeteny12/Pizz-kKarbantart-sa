document.addEventListener('DOMContentLoaded', function(){
    const postButton = document.getElementById('post');
    const getButton = document.getElementById('get');
    const putButton = document.getElementById('put');
    const deleteButton = document.getElementById('delete');
    const pizzakForm = document.getElementById('pizzakForm');
    const pizzaLista = document.getElementById('pizzaLista');

    //'post' gomb eseménykezelője
    postButton.addEventListener('click', async function(){
        let BaseURL = "http://localhost/pizzabackend/index.php?pizza";

        //Űrlap adatainak gyűjtése
        const formData = new FormData(document.getElementById('pizzakForm'));
        let options = {
            method: 'POST',
            mode: "no-cors",
            body: formData
        };
        let response = await fetch(BaseURL, options);
        if(response.ok){
            console.log("Sikeres adatfelvétel");
        } else {
            console.log("Hiba a szerver válaszában");
        }
    });

    //'get' gomb eseménykezelője
    getButton.addEventListener('click', async function(){
        //Űrlap elrejtése, lista megjelenítése
        pizzakForm.classList.add('d-none');
        pizzaLista.classList.remove('d-none');
        let BaseURL = "http://localhost/pizzabackend/index.php?pizza";
        let options = {
            method: 'GET',
            mode: "cors"
        };
        let response = await fetch(BaseURL, options);
        if (response.ok) {
            let data = await response.json();
            pizzakListazasa(data);
        } else {
            console.error('Hiba a szerver válaszában');
        };
    });

    //'update' gomb eseménykezelője
    putButton.addEventListener('click', async function () {
        let baseUrl = "http://localhost/pizzabackend/index.php?pizza/{id}";
        //Űrlap adatainak gyűjtése
        const formData = new FormData(document.getElementById('pizzakForm'));
        let options = {
            method: 'PUT',
            mode: "no-cors",
            body: formData
        };
        let response = await fetch(baseUrl, options);
        if (response.ok) {
            console.log("Sikeres adatmódosítás");
        } else {
            console.error('Hiba a szerver válaszában');
        }
    });

    //'delete' gomb eseménykezelője
    deleteButton.addEventListener('click', async function () {
        let baseUrl = "http://localhost/pizzabackend/index.php?pizza/{id}";
        //Űrlap adatainak gyűjtése
        const formData = new FormData(document.getElementById('pizzakForm'));
        let options = {
            method: 'DELETE',
            mode: "no-cors",
            body: formData
        };
        let response = await fetch(baseUrl, options);
        if (response.ok) {
            console.log("Sikeres törlés");
        } else {
            console.error('Hiba a szerver válaszában');
        }
    });

    //Pizzák kilistázása
    function pizzakListazasa(pizzak){
        let tablazat = pizzaFejlec();
        for (let pizza of pizzak) {
            tablazat += pizzaSor(pizza);
        }
        pizzaLista.innerHTML = tablazat + "</tbody></table>";
    }

    //Pizza sor
    function pizzaSor(pizza){
        let sor = `<tr>
            <td>${pizza.pazon}</td>
            <td>${pizza.pnev}</td>
            <td>${pizza.par}</td>
            <td><button type="button" class="btn btn-outline-info" onclick="adatBetoltes(${pizza.pazon})"><i class="fa-regular fa-hand-point-left"></i></button></td>
        </tr>`;
    }

    //Pizza fejléc
    function pizzaFejlec(){
        let fejlec = `<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Azonosító:</th>
                        <th>Név:</th>
                        <th>Ár:</th>
                    </tr>
                </thead>
                <tbody>`;
        return fejlec;
    }
});