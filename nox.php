<?php
    $i = 0;
    if (!empty($argv[1]) && !empty($argv[2])) // Verification de la presence des arguments
    {
        echo "-----------------------------------------------------------\n";
        echo "   Bienvenue dans NoX, le programme de recherche de mot.   \n";
        echo "-----------------------------------------------------------\n";
        if (file_exists($argv[1]) === false)
        {
            echo "$argv[1] : No such file or directory.\n";
        }
        else if (file_exists($argv[2]) === false)
        {
            echo "$argv[2]: No such file or directory.\n";
        }
        else if (is_readable($argv[1]) === false)
        {
            echo "$argv[1] : Can't read file.\n";
        }
        else if (is_readable($argv[2]) === false)
        {
            echo "$argv[2] : Can't read file.\n";
        }
        
        else 
        {
            $temps_debut = microtime(true);
            $dico_file = fopen($argv[2], 'r');
            $dico_str = fread($dico_file, filesize($argv[2]));
            preg_match_all("#[a-zA-Z][\S]+[a-zA-Z]#", $dico_str, $dico);
            
            // $dico = array_pop($dico);
            $dico = array_flip($dico[0]);
            $i = 0;
            $mot = 0;
            
            $message_file = fopen($argv[1], 'r'); // Ouverture du fichier du message
            $message_str = fread($message_file, filesize($argv[1]));
            preg_match_all("#[a-zA-Z][\S]+[a-zA-Z]#", $message_str, $message);
            
            // $message = array_pop($message);
            
            foreach ($message[0] as $mess)
            {
                if (array_key_exists($mess, $dico))
                {
                    echo "$mess\n";
                    $i++;
                }
            }
            $temps_fin = microtime(true);
            if ($i === 0) // Si aucun mot ne correspond
            {
                echo "Aucune correspondance trouvée.\n";
            }
            
            $temps_script = $temps_fin - $temps_debut; // Calcul du temps de script
            echo "$i mots trouvés\n";
            echo "Recherche terminée en $temps_script secondes\n"; // Affichage du temps de script
        }
    }
    else // Message pour l'absence d'argument
        echo "Veuillez entrer des arguments sous la forme php nox.php message dictionnaire.\n";
?>