
<style scoped>

</style>

<div class=" mb-6 flex flex-row items-center w-4/5 mx-auto space-x-2">
    <!-- Bouton pour ajouter un client -->
<button class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg" id="btnAddClient">Ajouter un client</button>
<button class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg" id="btnAddClient">modifier un client</button>
<button class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg" id="btnAddClient">Supprimer un client</button>
<form method="post" action="?action=logout">
<button type="submit">Se déconnecter</button>
</div>

<!-- Conteneur des toasts -->
<div class="toast-container fixed top-5 right-5 z-50" id="toastContainer"></div>
<!-- Tableau des clients -->
<table class="glass-card table w-4/5 text-left rounded overflow-hidden mx-auto">
    <thead class="glass-card text-white">
        <tr>
            <th class="py-3 px-4">#</th>
            <th class="py-3 px-4">Photo</th>
            <th class="py-3 px-4">Nom</th>
            <th class="py-3 px-4">Email</th>
            <th class="py-3 px-4">Téléphone</th>
        </tr>
    </thead>
    <tbody id="clientTable" class="divide-y divide-gray-200">
        <!-- Les données des clients seront injectées ici dynamiquement -->
    </tbody>
</table>
<!-- Panneau latéral pour les détails -->
<div class="detail-panel" id="detailPanel">
    <h5 class="text-center font-bold text-xl mb-4">Détails du client</h5>
    <p id="clientDetails" class="text-sm"></p>
    <button class="btn btn-danger bg-red-600 text-white w-full mt-4 py-2 rounded hover:bg-red-700 transition btn-small" id="deleteClient">Supprimer</button>
    <button class="btn btn-danger bg-green-600 text-white w-full mt-4 py-2 rounded hover:bg-red-700 transition btn-small" id="updateClient">modfier</button>
    <button class="btn btn-secondary bg-gray-400 text-white w-full mt-2 py-2 rounded hover:bg-gray-500 transition btn-small" id="closeDetails">Fermer</button>
</form>
</div>