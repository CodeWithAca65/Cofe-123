//CENE

let cena_kafe = 180;
let cena_soka = 250;
let cena_gazirane_vode = 150;
let cena_koktela = 600;

//KASA 1

let broj_stola_naslov = document.getElementById("broj_stola_naslov");
let kasa1 = document.getElementById("kasa1");
let sto1 = document.getElementById("sto1");
let dugme_racun1 = document.getElementById("racun1");
let kafa1 = document.getElementById("kafa1");
let sok1 = document.getElementById("sok1");
let gazirana_voda1 = document.getElementById("gazirana_voda1");
let koktel1 = document.getElementById("koktel1");
let iznos_racuna1 = document.getElementById("iznos_racuna1");
let uplata1 = document.getElementById("uplata1");
let kusur1 = document.getElementById("kusur1");
let izracunaj_kusur1 = document.getElementById("izracunaj_kusur1");
let zavrsi_racun1 = document.getElementById("zavrsi_racun1");

let iznos1;
let kusur_js1;
let kusur_if;
var iznos = [0, 0];
var kusur = [0, 0];
var kafa = [0, 0];
var sok = [0, 0];
var gazirana_voda = [0, 0];
var koktel = [0, 0];
var uplata = [0, 0];
let broj_stola;

sto1.addEventListener("click", () => {
    broj_stola = 1;
    broj_stola_naslov.innerText = "STO BROJ 1";
    if (kasa1.style.display == "block") {
        kasa1.style.display = "none";
    }
    else {
        kasa1.style.display = "block";
        iznos_racuna1.innerHTML = `Iznos: ${iznos[0]}.00 RSD`;
        kafa1.value = kafa[0];
        sok1.value = sok[0];
        gazirana_voda1.value = gazirana_voda[0];
        koktel1.value = koktel[0];
        uplata1.value = uplata[0];
        if (kusur_if == 0) {
            uplata1.focus();
        }
        else {
            kusur1.innerHTML = `Kusur: <i>${kusur[0]}.00 RSD</i>`;
        }
    }
});

dugme_racun1.addEventListener("click", () => {
    if (broj_stola == 1) {
        iznos[0] = kafa1.value * cena_kafe + sok1.value * cena_soka + gazirana_voda1.value * cena_gazirane_vode + koktel1.value * cena_koktela;
        kafa[0] = kafa1.value;
        sok[0] = sok1.value;
        gazirana_voda[0] = gazirana_voda1.value;
        koktel[0] = koktel1.value;
        iznos_racuna1.innerHTML = `Iznos: ${iznos[0]}.00 RSD`;
        sto1.style.border = "5px solid red";  //zauzet sto
    }
    else {
        iznos[1] = kafa1.value * cena_kafe + sok1.value * cena_soka + gazirana_voda1.value * cena_gazirane_vode + koktel1.value * cena_koktela;
        kafa[1] = kafa1.value;
        sok[1] = sok1.value;
        gazirana_voda[1] = gazirana_voda1.value;
        koktel[1] = koktel1.value;
        iznos_racuna1.innerHTML = `Iznos: ${iznos[1]}.00 RSD`;
        sto2.style.border = "5px solid red";  //zauzet sto
    }
});

izracunaj_kusur1.addEventListener("click", () => {
    if (broj_stola == 1) {
        uplata[0] = uplata1.value;
        kusur[0] = uplata1.value - iznos[0];
        if (kusur[0] >= 0) {
            kusur_if = 1; //placeno
            kusur1.innerHTML = `Kusur: <i>${kusur[0]}.00 RSD</i>`;
        }
        else {
            kusur_if = 0; //duzan
            uplata1.focus();
        }
    }
    else {
        kusur[1] = uplata1.value - iznos[1];
        uplata[1] = uplata1.value;
        if (kusur[1] >= 0) {
            kusur_if = 1; //placeno
            kusur1.innerHTML = `Kusur: <i>${kusur[1]}.00 RSD</i>`;
        }
        else {
            kusur_if = 0; //duzan
            uplata1.focus();
        }
    }
});

let potvrda1 = 1;

zavrsi_racun1.addEventListener("click", () => {
    if (broj_stola == 1) {
        if (potvrda1 == 2) {
            if (uplata1.value != "") {
                iznos[0] = 0;
                kusur[0] = 0;
                kafa1.value = 0;
                sok1.value = 0;
                gazirana_voda1.value = 0;
                koktel1.value = 0;
                kusur1.innerHTML = `Kusur: 0.00 RSD`;
                iznos_racuna1.innerHTML = `Iznos: 0.00 RSD`;
                uplata1.value = "";
                kasa1.style.display = "none";
                potvrda1 = 1;
                zavrsi_racun1.innerText = "ZAVRSI RACUN";
                sto1.style.border = "5px solid green";  //slobodan sto
                kafa[0] = 0;
                sok[0] = 0;
                gazirana_voda[0] = 0;
                koktel[0] = 0;
                uplata[0] = 0;
            }
            else {
                uplata1.focus();
            }
        }
        else {
            zavrsi_racun1.style.width = "30%";
            zavrsi_racun1.innerText = "Klikni za potvrdu da je sto slobodan za sledece goste";
            potvrda1 = potvrda1 + 1;
        }
    }
    else {
        if (potvrda1 == 2) {
            if (uplata1.value != "") {
                iznos[1] = 0;
                kusur[1] = 0;
                kafa1.value = 0;
                sok1.value = 0;
                gazirana_voda1.value = 0;
                koktel1.value = 0;
                kusur1.innerHTML = `Kusur: 0.00 RSD`;
                iznos_racuna1.innerHTML = `Iznos: 0.00 RSD`;
                uplata1.value = "";
                kasa1.style.display = "none";
                potvrda1 = 1;
                zavrsi_racun1.innerText = "ZAVRSI RACUN";
                sto2.style.border = "5px solid green";  //slobodan sto
                kafa[1] = 0;
                sok[1] = 0;
                gazirana_voda[1] = 0;
                koktel[1] = 0;
                uplata[1] = 0;
            }
            else {
                uplata1.focus();
            }
        }
        else {
            zavrsi_racun1.style.width = "30%";
            zavrsi_racun1.innerText = "Klikni za potvrdu da je sto slobodan za sledece goste";
            potvrda1 = potvrda1 + 1;
        }
    }
});

let sto2 = document.getElementById("sto2");

sto2.addEventListener("click", () => {
    broj_stola_naslov.innerText = "STO BROJ 2";
    broj_stola = 2;
    if (kasa1.style.display == "block") {
        kasa1.style.display = "none";
    }
    else {
        kasa1.style.display = "block";
        iznos_racuna1.innerText = `Iznos: ${iznos[1]}.00 RSD`;
        kafa1.value = kafa[1];
        sok1.value = sok[1];
        gazirana_voda1.value = gazirana_voda[1];
        koktel1.value = koktel[1];
        uplata1.value = uplata[1];
        if (kusur_if == 0) {
            uplata1.focus();
        }
        else {
            kusur1.innerHTML = `Kusur: <i>${kusur[1]}.00 RSD</i>`;
        }
    }
});