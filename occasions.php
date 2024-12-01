<?php require_once('header.php')?>
    <div class="container">
        <button id="showFilters">Afficher les filtres</button>
        <form id="filters" style="display: none;">
            <label for="kmMin">Kilomètres (min):</label>
            <input type="number" id="kmMin" name="kmMin">
            <label for="kmMax">Kilomètres (max):</label>
            <input type="number" id="kmMax" name="kmMax">

            <label for="yearMin">Année (min):</label>
            <input type="number" id="yearMin" name="yearMin">
            <label for="yearMax">Année (max):</label>
            <input type="number" id="yearMax" name="yearMax">

            <label for="priceMin">Prix (min):</label>
            <input type="number" id="priceMin" name="priceMin">
            <label for="priceMax">Prix (max):</label>
            <input type="number" id="priceMax" name="priceMax">

            <button type="button" id="applyFilters">Appliquer les filtres</button>
            <button type="button" id="hideFilters">Masquer les filtres</button>
        </form>
        <div id="carsList">
            <!-- Liste des voitures -->
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
