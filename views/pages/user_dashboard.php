<?php
defined('API_EXEC') or die(http_response_code(500));

// Vérifiez que session_start() est présent
session_start(); // Assurez-vous que cette ligne est présente

if (!is_logged_in()) {
    header('Location: index.php?action=login');
    exit();
}

?>


<!-- Styles spécifiques au composant -->
<style scoped>

</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/assets/main.js"></script>
    <script src="public/assets/jquery.js"></script>
    <link href="public/assets/main.css" rel="stylesheet">

    <title>Bienvenue Utilisateur</title>
    
</head>
<body class="w-screen h-screen bg-sky-600">
<?php
include_layout('headerDashboard');
?>
<div class="w-screen h-screen bg-sky-900">
    <div>
    <?php
    include_layout('card_dashboard');
    ?>
    </div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_layout('footer');
?>
</body>

<script>
    $(document).ready(function() {
        let clients = [
            { name: 'John Doe', email: 'john@example.com', phone: '123456789', photo: 'https://via.placeholder.com/40?text=JD' },
            { name: 'Jane Smith', email: 'jane@example.com', phone: '987654321', photo: 'https://via.placeholder.com/40?text=JS' },
        ];
        let selectedClientIndex = null;

        function displayClients() {
            let rows = '';
            clients.forEach((client, index) => {
                rows += `
                    <tr data-index="${index}" class="hover:bg-gray-100 cursor-pointer">
                        <td class="py-3 px-4">${index + 1}</td>
                        <td class="py-3 px-4"><img src="${client.photo}" alt="${client.name}"></td>
                        <td class="py-3 px-4">${client.name}</td>
                        <td class="py-3 px-4">${client.email}</td>
                        <td class="py-3 px-4">${client.phone}</td>
                    </tr>
                `;
            });
            $('#clientTable').html(rows);
        }

        function showToast(message) {
            const toast = `
                <div class="toast align-items-center bg-blue-500 text-white rounded shadow-lg p-3 mb-2" role="alert">
                    <div class="flex justify-between items-center">
                        <span>${message}</span>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close">×</button>
                    </div>
                </div>
            `;
            $('#toastContainer').append(toast);
            const toastElement = $('#toastContainer .toast').last();
            setTimeout(() => toastElement.fadeOut(500, () => toastElement.remove()), 3000);
        }

        $('#btnAddClient').click(function() {
            const newClient = { 
                name: 'Nouveau Client', 
                email: 'newclient@example.com', 
                phone: '555555555', 
                photo: 'https://via.placeholder.com/40?text=NC' 
            };
            clients.push(newClient);
            displayClients();
            showToast('Nouveau client ajouté avec succès !');
        });

        $(document).on('click', '#clientTable tr', function() {
            selectedClientIndex = $(this).data('index');
            const client = clients[selectedClientIndex];
            $('#clientDetails').html(`
                <strong>Nom:</strong> ${client.name}<br>
                <strong>Email:</strong> ${client.email}<br>
                <strong>Téléphone:</strong> ${client.phone}
            `);
            $('#detailPanel').addClass('active');
        });

        $('#closeDetails').click(function() {
            $('#detailPanel').removeClass('active');
        });

        $('#deleteClient').click(function() {
            if (selectedClientIndex !== null) {
                clients.splice(selectedClientIndex, 1);
                selectedClientIndex = null;
                displayClients();
                $('#detailPanel').removeClass('active');
                showToast('Client supprimé avec succès');
            }
        });

        $('#toggleTheme').click(function() {
            $('body').toggleClass('dark-mode');
            const icon = $('#themeIcon');
            if ($('body').hasClass('dark-mode')) {
                icon.html(`<path d="M12 2a10 10 0 100 20 1 1 0 010-2 8 8 0 110-16z"></path>`);
            } else {
                icon.html(`<path d="M12 3a1 1 0 010-2 10 10 0 100 20 1 1 0 010-2 8 8 0 110-16z"></path>`);
            }
        });

        displayClients();
    });
</script>
</html>
