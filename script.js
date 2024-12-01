$(document).ready(function () {
    // Charger toutes les voitures au démarrage
    loadCars();

    function loadCars(filters = {}) {
        $.post('fetch_cars.php', filters, function (data) {
            $('#carsList').html(data);
        }).fail(function () {
            alert("Une erreur s'est produite lors du chargement des voitures.");
        });
    }

    // Afficher/masquer les filtres
    $('#showFilters').click(function () {
        $('#filters').slideDown();
        $(this).hide();
    });

    $('#hideFilters').click(function () {
        $('#filters').slideUp();
        $('#showFilters').show();
    });

    // Appliquer les filtres
    $('#applyFilters').click(function () {
        const filters = {
            kmMin: $('#kmMin').val(),
            kmMax: $('#kmMax').val(),
            yearMin: $('#yearMin').val(),
            yearMax: $('#yearMax').val(),
            priceMin: $('#priceMin').val(),
            priceMax: $('#priceMax').val(),
        };

        // Charger les voitures filtrées
        loadCars(filters);
    });
});
