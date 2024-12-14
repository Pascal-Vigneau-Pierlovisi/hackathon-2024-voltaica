@extends('base')

@section('content')
    <div class="container mx-auto p-6 dark:text-white">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <!-- Revenu total -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-4 bg-green-200 rounded-full text-green-500">
                        <i class="fas fa-coins text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Revenu Total sur les 12 derniers mois</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format(47700, 2, ',', ' ') }} €
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Revenu estimé -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-4 bg-blue-200 rounded-full text-blue-500">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Revenu Estimé sur les 12 derniers mois</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format(62910, 2, ',', ' ') }} €
                        </h3>
                    </div>
                </div>
            </div>
            <!-- Revenu mml -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-4 bg-indigo-200 rounded-full text-blue-500">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Revenu MLM</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format(9960, 2, ',', ' ') }} €
                        </h3>
                    </div>
                </div>
            </div>
        </div>


        <!-- Boutons pour afficher le graphique, MML ou Projets -->
        <div class="flex justify-start space-x-4 mb-8">
            <button
                class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition"
                id="btnGraphique" style="display: none;">
                Voir Graphique
            </button>
            <button
                class="bg-indigo-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition"
                id="btnMML">
                Voir MLM
            </button>
            <button
                class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition"
                id="btnProjets">
                Voir Projets
            </button>
        </div>

        <!-- Section du graphique (visible par défaut) -->
        <div id="graphiqueSection" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Revenus Annuel</h3>
            <div id="chart" class="w-full h-96"></div>
        </div>

        <!-- Tableau des MML (caché par défaut) -->
        <div id="tableauMML" class="hidden bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Liste des MLM</h3>

            <table class="table-auto w-full border border-gray-300 dark:border-gray-700">
                <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Grade</th>
                    <th class="px-4 py-2 text-gray-700 dark:text-gray-300">Revenu (€)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Senior Manager</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">5,000</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Manager</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">2,000</td>
                </tr>
                </tbody>
            </table>


            <p class="text-gray-700 dark:text-gray-300 font-semibold">
                Puissance Génerée nécessaire pour MLM : <span class="text-blue-600 dark:text-blue-400">2300/2500</span>
            </p>


        </div>


        <div id="tableauProjets" class="hidden bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Liste des Projets</h3>
            <!-- Tableau des Projets (caché par défaut) -->
            <!-- Formulaire de recherche et filtres -->
            <div class="flex flex-col md:flex-row md:items-center md:gap-4 mb-6">
                <!-- Champ de recherche -->
                <input
                    type="text"
                    id="searchBar"
                    class="w-full md:w-1/3 p-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 md:mb-0"
                    placeholder="Rechercher un projet..."
                />

                <!-- Filtre par statut -->
                <select
                    id="statusFilter"
                    class="w-full md:w-1/4 p-3 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Tous les statuts</option>
                    <option value="En cours">En cours</option>
                    <option value="Etabli">Etabli</option>
                    <option value="Abandonné">Abandonné</option>
                </select>

            </div>
            <table class="table-auto w-full border border-gray-300 dark:border-gray-700">
                <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                    <th class="px-2 py-2 text-gray-700 dark:text-gray-300">Numéro du Projet</th>
                    <th class="px-2 py-2 text-gray-700 dark:text-gray-300">Statut</th>
                    <th class="px-2 py-2 text-gray-700 dark:text-gray-300">Puissance Estimée en KwC</th>
                    <th class="px-2 py-2 text-gray-700 dark:text-gray-300">Date de Complétude</th>
                    <th class="px-2 py-2 text-gray-700 dark:text-gray-300">Date de Signature</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P368</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Etabli</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">200</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">01/01/2023</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">15/12/2022</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P480</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">En cours</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">250</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">15/05/2024</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">12/03/2024</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P390</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Abandonné</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">300</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">-</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">10/02/2024</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P370</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Etabli</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">600</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">01/09/2023</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">01/06/2023</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P410</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">En cours</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">200</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">-</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">20/08/2024</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P389</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Abandonné</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">300</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">-</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">10/03/2024</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">P414</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">Etabli</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">200</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">30/10/2024</td>
                    <td class="border px-4 py-2 text-gray-700 dark:text-gray-300">10/08/2024</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inclusion d'ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Données pour le graphique
        var options = {
            series: @json($graphData['series']),
            chart: {
                type: 'line',
                height: 350,
                toolbar: { show: true }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            grid: {
                borderColor: '#e7e7e7',
                row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.5 }
            },
            xaxis: {
                categories: ['Décembre 2023', 'Janvier 2024', 'Février 2024', 'Mars 2024', 'Avril 2024', 'Mai 2024', 'Juin 2024', 'Juillet 2024', 'Août 2024', 'Septembre 2024', 'Octobre 2024', 'Novembre 2024', 'Décembre 2024'],
                title: { text: 'Mois / Année' }
            },
            yaxis: { title: { text: 'Revenu (€)' } },
            colors: ['#1E88E5', '#28A745', '#FFC107'],
            tooltip: {
                theme: 'dark',
                y: { formatter: function(val) { return val + ' €'; } }
            }
        };

        // Initialisation du graphique
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // Gestion des boutons pour afficher le graphique, MML ou Projets
        document.getElementById('btnGraphique').addEventListener('click', function() {
            // Afficher le graphique et masquer les tableaux
            document.getElementById('graphiqueSection').classList.remove('hidden');
            document.getElementById('tableauMML').classList.add('hidden');
            document.getElementById('tableauProjets').classList.add('hidden');
            // Cacher le bouton Graphique après avoir cliqué
            document.getElementById('btnGraphique').style.display = 'none';
        });

        document.getElementById('btnMML').addEventListener('click', function() {
            // Masquer le graphique et afficher le tableau des MML
            document.getElementById('graphiqueSection').classList.add('hidden');
            document.getElementById('tableauMML').classList.remove('hidden');
            document.getElementById('tableauProjets').classList.add('hidden');
            // Afficher le bouton Graphique
            document.getElementById('btnGraphique').style.display = 'inline-block';
        });

        document.getElementById('btnProjets').addEventListener('click', function() {
            // Masquer le graphique et afficher le tableau des Projets
            document.getElementById('graphiqueSection').classList.add('hidden');
            document.getElementById('tableauMML').classList.add('hidden');
            document.getElementById('tableauProjets').classList.remove('hidden');
            // Afficher le bouton Graphique
            document.getElementById('btnGraphique').style.display = 'inline-block';
        });
        document.addEventListener('DOMContentLoaded', function () {
            const searchBar = document.getElementById('searchBar');
            const statusFilter = document.getElementById('statusFilter');
            const searchButton = document.getElementById('searchButton');
            const tableRows = document.querySelectorAll('#tableauProjets tbody tr');

            // Fonction pour appliquer le filtrage
            function filterTable() {
                const searchTerm = searchBar.value.toLowerCase();
                const status = statusFilter.value.toLowerCase();

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const projectNumber = cells[0].textContent.toLowerCase();
                    const projectStatus = cells[1].textContent.toLowerCase();

                    // Vérification des conditions de filtrage
                    const matchesSearch = projectNumber.includes(searchTerm);
                    const matchesStatus = status ? projectStatus.includes(status) : true;

                    // Affichage ou masquage de la ligne
                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Écouteurs d'événements pour les filtres
            searchBar.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            searchButton.addEventListener('click', filterTable);
        });




    </script>
@endsection
