<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalizaBraz - Transporte</title>
    <link rel="shortcut icon" href="imagens/mapa.png" type="image/x-icon">
    <link rel="stylesheet" href="css/transporte.css">
    
</head>
<body>
<header>
    <div class="logo"> 
        <img src="imagens/logoo.png" alt="logoo" id="logoo">LocalizaBraz
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="brazlandia.php">Mapa</a></li>
            <li><a href="transporte.php">Transporte</a></li>
            <li><a href="galeriadefotos.php">Galeria</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="tutorial.php">Tutoriais</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'): ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if (isset($_SESSION['username'])): ?>
        <div class="logado">
            <p class="bemvindo">Bem - Vindo <?php echo $_SESSION['username'];?></p>
            <a href="logout.php"><button class="sair">Sair</button></a>
        </div>
    <?php else: ?>
        <div class="auto-buttons">
            <a href="login.php"><button class="login">Login</button></a>
            <a href="cadastro.html"><button class="cadastro">Cadastro</button></a>
        </div>
    <?php endif; ?>
</header>

<main>
    <section id="horarios" class="container">
        <h3>Horários de Ônibus</h3>
        <div class="bus-schedule">
            
            <?php 
            $busRoutes = [
                '406' => ['Brazlândia Circular'],
                '401' => ['Brazlândia - Taguatinga'],
                '402' => ['Brazlândia - Ceilândia'],
                '400' => ['Brazlândia - Plano Piloto']
            ];

            $schedules = [
                '406' => [
                    'weekdays' => [
                        
                        'morning' => '06:00 | 06:16 | 06:33 | 06:50 | 07:06 | 07:23 | 07:40 | 07:56 | 08:13 | 08:30 | 08:46 | 09:03 | 09:20 | 09:36 | 09:53 | 10:10 | 10:26 | 10:43 | 11:00 | 11:16 | 11:33 | 11:50',
                        'afternoon' => '12:06 | 12:23 | 12:40 | 12:56 | 13:13 | 13:30 | 13:46 | 14:03 | 14:20 | 14:36 | 14:53 | 15:10 | 15:26 | 15:43 | 16:00 | 16:16 | 16:33 | 16:50 | 17:06 | 17:23 | 17:40 | 17:56',
                        'evening' => '18:13 | 18:30 | 18:46 | 19:03 | 19:20 | 19:36 | 19:53 | 20:10 | 20:26 | 20:43 | 21:00 | 21:16 | 21:33 | 21:50 | 22:06 | 22:23 | 22:40 | 22:56'
                    ],
                    'saturday' => [
                       
                        'morning' => '06:15 | 06:45 | 07:15 | 07:45 | 08:15 | 08:45 | 09:15 | 09:45 | 10:15 | 10:45 | 11:15',
                        'afternoon' => '12:06 | 12:23 | 12:40 | 12:56 | 13:13 | 13:30 | 13:46 | 14:03 | 14:20 | 14:36 | 14:53 | 15:10 | 15:26 | 15:43 | 16:00 | 16:16 | 16:33 | 16:50 | 17:06 | 17:23 | 17:40 | 17:56',
                        'evening' => '18:13 | 18:30 | 19:03 | 19:20 | 19:53 | 20:10 | 20:43 | 21:33 | 22:23'
                    ],
                    'sunday' => [
                       
                        'morning' => '06:10 | 07:00 | 07:50 | 08:40 | 09:30 | 10:20 | 11:10',
                        'afternoon' => '12:00 | 12:50 | 13:40 | 14:30 | 15:20 | 16:10 | 17:00 | 17:50',
                        'evening' => '18:40 | 19:30 | 20:20 | 21:10 | 22:00'
                    ]
                ],
                '401' => [
                    'weekdays' => [
                        'early_morning' => '04:40 | 05:00 | 05:25 | 05:50',
                        'morning' => '06:02 | 06:15 | 06:27 | 06:40 | 07:05 | 07:17 | 07:30 | 07:55 | 08:20 | 08:45 | 09:10 | 09:35 | 10:25 | 10:50 | 11:15',
                        'afternoon' => '12:05 | 12:30 | 12:55 | 13:20 | 13:45 | 14:10 | 14:35 | 15:00 | 15:25 | 15:50 | 16:15 | 16:40',
                        'evening' => '18:20 | 18:45 | 19:00 | 20:10 | 20:30 | 21:30'
                    ],
                    'saturday' => [
                        'early_morning' => '05:15 | 05:45',
                        'morning' => '06:15 | 06:45 | 07:15 | 07:45 | 08:15 | 08:45 | 09:15 | 09:45 | 10:15 | 10:45 | 11:15',
                        'afternoon' => '12:45 | 13:15 | 13:45 | 14:15 | 14:45 | 15:15 | 15:45 | 16:45 | 17:45',
                        'evening' => '18:30 | 20:30 | 21:30'
                    ],
                    'sunday' => [
                        'early_morning' => '05:15',
                        'morning' => '06:09 | 07:03 | 07:57 | 08:51 | 09:45 | 10:39',
                        'afternoon' => '12:27 | 13:21 | 14:15 | 15:09 | 16:03 | 16:57 | 17:51',
                        'evening' => '18:45 | 19:39 | 21:30'
                    ]
                    ],
                    '402' => [
                        'weekdays' => [
                            'early_morning' => '05:00 | 05:32',
                            'morning' => '06:04 | 06:36 | 07:08 | 07:40 | 08:12 | 08:44 | 09:16 | 09:48 | 10:20 | 11:05 | 11:30 | 11:56',
                            'afternoon' => '12:28 | 13:00 | 13:32 | 14:04 | 14:36 | 15:08 | 15:40 | 16:12 | 16:44 | 17:16 | 17:48',
                            'evening' => '18:20 | 18:52 | 19:24 | 19:56'
                        ],
                        'saturday' => [
                            'early_morning' => '05:22 | 05:45',
                            'morning' => '06:08 | 06:31 | 06:54 | 07:17 | 07:40 | 08:02 | 08:25 | 08:48 | 09:11 | 09:34 | 09:57 | 10:20 | 
                            10:42 | 11:05 | 11:28',
                            'afternoon' => '12:14 | 12:37 | 13:00 | 13:22 | 13:45 | 14:08 | 14:31 | 14:54 | 15:17 | 15:40 | 16:02 | 16:25 | 
                            16:48 | 17:20 | 17:34 | 17:57',
                            'evening' => '18:20 | 19:00 | 20:10 | 22:00'
                        ],
                        'sunday' => [
                            
                            'morning' => '06:00 | 06:26 | 06:52 | 07:18 | 07:44 | 08:10 | 08:40 | 09:06 | 09:36 | 09:58 | 10:24 | 10:50 | 
                            11:38',
                            'afternoon' => '12:04 | 12:30 | 12:56 | 13:22 | 13:50 | 14:40 | 15:06 | 15:32 | 15:58 | 16:24 | 16:50 | 17:16',
                            'evening' => '18:34 | 19:00 | 19:26 | 19:56 | 21:36'
                        ]
                        ],
                        '400' => [
                            'weekdays' => [
                                
                                'morning' => '07:02 | 08:14 |10:38',
                                'afternoon' => '13:02 | 14:14 | 16:38 | 17:50',
                                
                            ],
                            'saturday' => [
                                'early_morning' => '05:54',
                                'morning' => '09:06 | 12:18',
                                'afternoon' => '15:30',
                               
                            ],
                            'sunday' => [
                                'early_morning' => '05:54',
                                'morning' => '09:06 | 12:18',
                                'afternoon' => '15:30'
                            ]
                        ]
                
            ];

            foreach ($busRoutes as $bus => $route) {
                echo "<div class='bus-info'>";
                echo "<h4 onclick=\"toggleBusSchedule('$bus')\">Ônibus $bus - $route[0]</h4>";
                echo "<div id='schedule-$bus' class='schedule-content' style='display: none;'>";

                foreach (['weekdays' => 'Segunda a Sexta', 'saturday' => 'Sábado', 'sunday' => 'Domingo'] as $dayKey => $dayLabel) {
                    if (isset($schedules[$bus][$dayKey])) {
                        echo "<h5 onclick=\"toggleDaySchedule('$bus-$dayKey')\">$dayLabel</h5>";
                        echo "<div id='schedule-$bus-$dayKey' class='day-schedule' style='display: none;'>";
                        foreach (['early_morning' => 'Madrugada', 'morning' => 'Manhã', 'afternoon' => 'Tarde', 'evening' => 'Noite'] as $periodKey => $periodLabel) {
                            if (!empty($schedules[$bus][$dayKey][$periodKey])) {
                                echo "<p><strong>$periodLabel:</strong> {$schedules[$bus][$dayKey][$periodKey]}</p>";
                            }
                        }
                        echo "</div>";
                    }
                }
                echo "</div></div>";
            }
            ?>
        </div>
    </section>
</main>

    
    <section id="locais" class="containerr">
        <h3>Locais de Parada</h3>
        <ul>
            <li>Terminal Rodoviário de Brazlândia</li>
            <li>Parada Central - Av. Principal</li>
            <li>Escola Técnica de Brazlândia</li>
            <li>Praça da Administração Regional</li>
            <li>Parada do Mercado Municipal</li>
            <li>Parada da Av. dos Ipês</li>
        </ul>
    </section>
    
    <section id="precos" class="containerr">
        <h3>Preços das Passagens</h3>
        <table>
            <thead>
                <tr>
                    <th>Rota</th>
                    <th>Preço (Inteira)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Brazlândia - Plano Piloto</td>
                    <td>R$ 5,50</td>
                </tr>
                <tr>
                    <td>Brazlândia - Ceilândia</td>
                    <td>R$ 5,50</td>
                </tr>
                <tr>
                    <td>Brazlândia - Taguatinga</td>
                    <td>R$ 5,50</td>
                </tr>
                <tr>
                    <td>Brazlândia - W3 Norte</td>
                    <td>R$ 5,50</td>
                </tr>
                <tr>
                    <td>Brazlândia - W3 Sul</td>
                    <td>R$ 5,50</td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <section id="galeria" class="containerr">
        <h3>Galeria de Veículos</h3>
        <div class="gallery">
            <img src="imagens/bus1.jpg" alt="Ônibus 1">
            <img src="imagens/bus2.jpg" alt="Ônibus 2">
            <img src="imagens/bus3.jpg" alt="Ônibus 3">
            <img src="imagens/bus4.jpg" alt="Ônibus 4">
        </div>
    </section>
    <footer>
        <p>&copy; 2024 LocalizaBraz - Todos os direitos reservados.</p>
    </footer>
</main>

<script>
 function toggleBusSchedule(busId) {
    const busSchedule = document.getElementById(`schedule-${busId}`);
    busSchedule.style.display = busSchedule.style.display === 'none' ? 'block' : 'none';
}


    function toggleDaySchedule(dayId) {
        const daySchedule = document.getElementById(`schedule-${dayId}`);
        daySchedule.style.display = daySchedule.style.display === 'none' ? 'block' : 'none';
    }
</script>

</body>
</html>

</body>
</html>
