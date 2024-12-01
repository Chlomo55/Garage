<style>

#slide-div {
    display: flex;
    justify-content: space-evenly;
    padding: 20px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

.slide_sous_div {
    flex: 1;
    margin: 10px;
    padding: 10px;
}

.slide_sous_div label,
.slide_sous_div span {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #647476;
}

.slide_sous_div div {
    margin-bottom: 20px;
}

/* Pour les écrans de smartphones (largeur inférieure ou égale à 768px) */
@media (max-width: 768px) {
    #slide-div {
        flex-direction: column; /* Empile les éléments verticalement */
    }

    .slide_sous_div {
        margin: 10px 0; /* Ajuste la marge pour les smartphones */
        flex: none; /* Annule la flexibilité pour les smartphones */
    }
}

.mod{
    width: 100%; /* Utilise toute la largeur de son conteneur parent */
    height: auto; /* Garde le ratio d'aspect de l'image */
    max-height: 200px; /* Définissez la hauteur maximale que vous souhaitez pour les images */
    display: block; /* Supprime tout espace blanc autour de l'image */
    margin: 0 auto; /* Centre l'image horizontalement */
}
.button-style{
    padding: 5px;
    margin: 10px;
}
.color-filtre .ui-slider-handle {
background: #fafef9;
}
.color-filtre .ui-slider-range {
    background: #17a2b2;
}
    
</style>

