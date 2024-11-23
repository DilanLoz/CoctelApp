<?php include "controllers/cmenu.php"; ?>
<link rel="stylesheet" href="../css/carcomp.css">
<link rel="stylesheet" href="../css/inho.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<nav class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav me-auto">
        <?php if($dat){ foreach ($dat as $dt) { ?> 
                <li class="nav-item">
                    <a class="nav-link" href="home.php?pg=<?=$dt['idpag'];?>" title="<?=$dt['titupag'];?>">
                        <i class="<?=$dt['icopag'];?>"></i> <?=$dt['nompag'];?>
                    </a>
                </li>
                <?php 
				}
			}
			?>
    </ul>
    <ul class="navbar-nav ml-auto " id="menuu">
        <li class="nav-item">
            <a class="nav-link" href="views/vsal.php" title="Salir">
                <i class="fa-solid fa-right-from-bracket" style="color: red;"></i>
            </a>
        </li>
    </ul>
</nav>
