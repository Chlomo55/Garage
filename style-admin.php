<style>
/* Styles des boutons */
/* Styles pour les boutons */
button[type="submit"] {
    margin: 10px 0; /* espace entre les boutons */
    padding: 5px 15px; /* plus de padding pour un meilleur look */
    border: none; /* enlever le style par défaut du bord */
    cursor: pointer; /* indiquer que c'est cliquable */
    transition: background-color 0.2s; /* transition douce pour le hover */
}

button[type="submit"]:hover {
    opacity: 0.8; /* effet de hover */
}

/* Styles spécifiques pour les boutons */
input[type="submit"] {
    background-color: #4CAF50; /* couleur verte pour le bouton d'ajout */
    color: white; /* texte blanc */
}

#modifier-color{
    background-color: #FFA500; /* orange pour le bouton Modifier */
    color: white;
}

#supprimer-color{
    background-color: #FF0000; /* rouge pour le bouton Supprimer */
    color: white;
}
.cardPerso{
    border: 2px black solid !important;
    width: 300px !important;
    margin: 10px !important;
    border-radius: 15px !important;
    padding: 10px !important;
    text-align: center;
}

.col-lg-4.col-md-6.col-sm-12.mb-2 {
width: auto !important;
}

.presentation{
display: flex;
flex-wrap: nowrap;
justify-content: center;
align-items: flex-start;
align-content: flex-start;
}
.acceuil{
margin: 3%;
text-align: center;
}
.img-details{
justify-content: center;
margin-left: auto;
margin-right: auto;
}
.div-details{
padding-left: 5%;
} 
.center-footer{
    text-align: center;
    justify-content: center;
}
.voiture-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.card-container {
    display: flex;
    align-items: stretch;
}

.card-body {
    flex-grow: 1;
}

.card-img {
    /* object-fit: cover; Ajoute cette ligne */
    height: 300px; /* Définis la hauteur souhaitée pour les images */
}
.cart-car{
    margin: 10px;
}
#image-details{
    width: 60%;
    /* height: 30rem; */
    text-align: center;
}
.services-list {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
}

.services-list li {
    background-color: #56bbcb;
    padding: 0.5rem 1rem;
    border-radius: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.avis{
    border-radius: 15px !important; 
    padding: 10px;
    text-align: center;
} 

.form {
            display: flex;
            justify-content: center;
            margin: 5%;
        }

form {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    padding: 10px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 50%;
    margin-left: auto;
    margin-right: auto;
}

h4 {
    text-align: center;
    font-size: 20px;
    background-color: #17a2b8;
    padding: 10px;
    border-radius: 7px;
}

hr {
    margin: 10px 0;
    background-color: #ccc;
    border: 0;
    height: 1px;
    width: 100%;
}

.username-div {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.username-div div {
    display: flex;
    flex-direction: column;
    width: 49%;
}

label {
    margin-bottom: 6px;
    color: #17a2b8;
}

input,
textarea {
    margin-bottom: 5px;
    padding: 10px;
    outline: 0;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px;
    width: 100%;
    font-size: 14px;
}

input:focus,
textarea:focus {
    border: 1px solid #17a2b8;
}

input[type="button"] {
    margin-top: 15px;
    background-color: #17a2b8;
    color: #fff;
    border: 1px solid #17a2b8;
    cursor: pointer;
    width: 20%;
}

#box-p {
    background-color: #2E7E32;
    color: #fff;
    padding: 20px;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    width: 20%;
    border-radius: 15px;
    text-align: center;
    font-size: 20px;
}

.div-click1 {
    text-align: center;
    /* width: 60%; */
    margin-left: auto;
    margin-right: auto;
}

.click1 {
    margin: 1.2em;
    padding: 10px;
    border-radius: 15px;
    background-color: #17a2b8;
    color: #fff;
    font-size: 18px;
}

/* Media Queries */
@media only screen and (max-width: 768px) {
    form {
        width: 80%;
    }

    .username-div div {
        width: 100%;
    }

    input[type="button"] {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    #box-p {
        width: 80%;
        justify-content: center;
        padding: auto;
    }
}

@media only screen and (max-width: 480px) {
    form {
        width: 90%;
    }

    input,
    textarea {
        font-size: 12px;
    }

    .username-div div {
        width: 100%;
    }

    input[type="button"] {
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }

    #box-p {
        width: 80%;
        justify-content: center;
        padding: auto;
    }
}

</style>