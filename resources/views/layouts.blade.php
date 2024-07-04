<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleurs Fraîches - Livraison à Domicile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-50 overflow-x-hidden">

    <!--Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-20 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{url('/')}}" class="text-2xl font-bold text-green-600 flex items-center">
                    <i class="fas fa-leaf mr-2"></i>
                    FleursFraîches
                </a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{url('/')}}"
                        class="nav-link text-gray-600 hover:text-green-600 transition-colors duration-300">Accueil</a>
                    <a href="{#"
                        class="nav-link text-gray-600 hover:text-green-600 transition-colors duration-300">Bouquets</a>
                    <a href="#"
                        class="nav-link text-gray-600 hover:text-green-600 transition-colors duration-300 relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">1</span>
                    </a>
                </div>
                <button class="md:hidden text-gray-600 focus:outline-none" id="menuToggle">
                    <i class="fas fa-bars w-6 h-6"></i>
                </button>
            </div>
        </div>
        <div class="md:hidden hidden bg-white" id="mobileMenu">
            <a href="{{ url('/') }}" class="block py-2 px-4 text-gray-600 hover:bg-green-50">Accueil</a>
            <a href="{#" class="block py-2 px-4 text-gray-600 hover:bg-green-50">Bouquets</a>
            <a href="#" class="block py-2 px-4 text-gray-600 hover:bg-green-50">
                <i class="fas fa-shopping-cart"></i>
                <span class="ml-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1">1</span>
            </a>
        </div>
    </nav>



    @yield('content')


    <!--Footer-->
    <footer class="bg-green-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">FleursFraîches</h3>
                    <p class="text-green-200">Des fleurs fraîches livrées à votre porte, pour illuminer votre quotidien.
                    </p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-green-200 hover:text-white transition-colors duration-300">Accueil</a></li>
                        <li><a href="#"
                                class="text-green-200 hover:text-white transition-colors duration-300">Bouquets</a></li>
                        <li><a href="#"
                                class="text-green-200 hover:text-white transition-colors duration-300">Comment ça
                                marche</a></li>
                        <li><a href="#"
                                class="text-green-200 hover:text-white transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i>contact@fleursfraîches.com
                        </li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2"></i>+33 1 23 45 67 89</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i>123 Rue des Fleurs,
                            Paris</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4 mb-4">
                        <a href="#"
                            class="bg-green-700 hover:bg-green-600 text-white p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-facebook-f w-5 h-5 flex items-center justify-center"></i>
                        </a>
                        <a href="#"
                            class="bg-green-700 hover:bg-green-600 text-white p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-twitter w-5 h-5 flex items-center justify-center"></i>
                        </a>
                        <a href="#"
                            class="bg-green-700 hover:bg-green-600 text-white p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-instagram w-5 h-5 flex items-center justify-center"></i>
                        </a>
                    </div>

                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-green-700 text-center text-green-200">
                <p>&copy; 2024 FleursFraîches. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <!--script js for navbar -->
    <script src="js/navbar.js"></script>


</body>

</html>
