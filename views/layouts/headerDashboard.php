<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<style scoped>
.dashboard-header {
    backdrop-filter: blur(10px);
    background: rgba(17, 90, 191, 0.282);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}
</style>

    <!-- En-tête du tableau de bord -->
    <div class="dashboard-header flex items-center justify-between mb-6 mt-6 w-justify-center w-4/5 mx-auto sm:W-full h-24 rounded-md">
        <div class= "text-white flex items-center w-2/4">
        <h1 class="text-3xl font-bold mx-auto">Gestion Admin</h1> 
        </div>
        <div class="user-info flex items-center gap-4 mx-auto">
        <img src="https://via.placeholder.com/50" alt="Utilisateur" class="rounded-full w-12 h-12">
        <p><?php echo get_logged_in_user_name(); ?></p>
        </div>
    </div>