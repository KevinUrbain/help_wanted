<nav>
    <div class="nav-container">
        <a href="index.php?action=home" class="logo">Help Wanted</a>

        <div class="nav-right">
            <!-- Auth buttons (visible when logged out) -->
            <div class="nav-auth">
                <span>
                    <?= isset($_SESSION['user']) ? 'Bienvenue, ' . $_SESSION['user']['username'] : '' ?>
                </span>
                <?php if (!isset($_SESSION['user'])): ?>
                    <button class="btn btn-ghost"><a href="index.php?action=login" class="links">Connexion</a></button>
                    <button class="btn btn-primary"><a href="index.php?action=register"
                            class="links">Inscription</a></button>
                <?php else: ?>
                    <!-- Profile menu (visible when logged in) -->
                    <div class="profile-menu logged-in-only">
                        <img src="https://i.pravatar.cc/150?img=68" alt="Profile" class="profile-avatar" />
                        <div class="dropdown">
                            <div class="dropdown-item"><i class="fa-solid fa-user"></i> Mon profil</div>
                            <div class="dropdown-item"><i class="fa-solid fa-circle-plus"></i> Créer une annonce</div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item">
                                <a href="index.php?action=logout" class="links"><i
                                        class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


        </div>
    </div>
</nav>