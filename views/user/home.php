<?php
// if (!isset($_SESSION['user'])) {
//     header('Location: index.php?action=login');
//     exit;
// }
// $username = $_SESSION['user']['username'];
?>

<!doctype html>
<html lang="fr">
<?php require_once ROOT . '/views/templates/head.php'; ?>

<body>
    <!-- Navigation -->
    <?php require_once ROOT . '/views/templates/nav.php'; ?>
    <!-- Main content -->
    <main>
        <!-- Hero section -->
        <section class="hero">
            <h1>Votre voisinage, solidaire</h1>
            <p>
                Partagez, demandez, offrez. Ensemble, faisons vivre l'entraide de
                proximité.
            </p>
        </section>

        <!-- Filter tabs -->
        <div class="filter-tabs">
            <button class="tab active" onclick="filterCards('all')">
                Tout voir
            </button>
            <button class="tab" onclick="filterCards('demande')">
                Demandes d'aide
            </button>
            <button class="tab" onclick="filterCards('offre')">
                Offres de service
            </button>
        </div>

        <!-- Cards grid -->
        <div class="cards-grid" id="cardsContainer">
            <!-- Demande cards -->
            <div class="card" data-type="demande">
                <div class="card-header">
                    <span class="card-type demande">Demande</span>
                    <span class="card-time">Il y a 2h</span>
                </div>
                <h3>
                    <a href="" class="links">Besoin d'aide pour déménager un canapé</a>
                </h3>
                <p>
                    Bonjour ! Je cherche quelqu'un avec un van pour m'aider à déplacer
                    un canapé 3 places du rez-de-chaussée. Distance : 5 km environ.
                </p>
                <div class="card-footer">
                    <div class="card-author">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Marie" class="author-avatar" />
                        <span class="author-name">Marie D.</span>
                    </div>
                    <span class="card-distance">📍 0.3 km</span>
                </div>
            </div>

            <div class="card" data-type="offre">
                <div class="card-header">
                    <span class="card-type offre">Offre</span>
                    <span class="card-time">Il y a 5h</span>
                </div>
                <h3>Cours de guitare gratuits pour débutants</h3>
                <p>
                    Guitariste depuis 15 ans, je propose des cours gratuits les samedis
                    après-midi. Tous niveaux bienvenus, dans une ambiance détendue !
                </p>
                <div class="card-footer">
                    <div class="card-author">
                        <img src="https://i.pravatar.cc/150?img=33" alt="Thomas" class="author-avatar" />
                        <span class="author-name">Thomas L.</span>
                    </div>
                    <span class="card-distance">📍 0.8 km</span>
                </div>
            </div>


        </div>
    </main>

    <script>
        // Filter functionality
        function filterCards(type) {
            const cards = document.querySelectorAll(".card");
            const tabs = document.querySelectorAll(".tab");

            // Update active tab
            tabs.forEach((tab) => tab.classList.remove("active"));
            event.target.classList.add("active");

            // Filter cards with animation
            cards.forEach((card) => {
                if (type === "all" || card.dataset.type === type) {
                    card.style.display = "block";
                    card.style.animation = "fadeInUp 0.5s ease-out";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Toggle login state (for demo purposes)
        function toggleLogin() {
            document.body.classList.toggle("logged-in");
        }

        // Demo: Start logged in
        // Uncomment the next line to see the logged-in state by default
        document.body.classList.add('logged-in');
    </script>
</body>

</html>