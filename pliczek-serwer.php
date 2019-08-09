<?php

	if (isset($_POST['wyslij_plik'])) 
	{
		$max_rozmiar=1024*2000;
		if (is_uploaded_file ($_FILES['plik']['tmp_name'])) 
		{
			if ($_FILES['plik']['size'] < $max_rozmiar) 
			{
				if($_FILES['plik']['error'] == 0) 
				{
						$nazwa_pliku='testowy/'."{$_FILES['plik']['name']}";
						
						//$nazwa_pliku=$_FILES['plik']['name'];
						$nazwa_pliku=str_replace ("", " ", trim ($nazwa_pliku));
						
						if(!is_file($nazwa_pliku)) 
						{
							if (move_uploaded_file ($_FILES['plik']['tmp_name'], $nazwa_pliku)) 
							{	
								//Potwierdzenie przesłania pliku
								echo 'Plik został poprawnie dodany.<br />';
									
								//Przekierowanie na stronę główną
								header('Refresh: 3; URL=pliczek.php');
								echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
									
								if(file_exists ($nazwa_pliku)) 
								{
									@chmod ($nazwa_pliku, 0644);
								}
							} 
							else 
							{
								//Informacja o błędzie
								echo 'Błąd: Plik nie został przesłany.<br />';
								
								//Przekierowanie na stronę główną
								header('Refresh: 3; URL=pliczek.php');
								echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
							}
						} 
					else 
					{
						//Informacja o błędzie
						echo 'Błąd: 2. Błędna nazwa pliku. <br />';
						
						//Przekierowanie na stronę główną
						header('Refresh: 3; URL=pliczek.php');
						echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
					}
				} 
				else 
				{
					//Informacja o błędzie
					echo 'Błąd: 3.<br />';
					
					//Przekierowanie na stronę główną
					header('Refresh: 3; URL=pliczek.php');
					echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
				}
			} 
			else 
			{
				//Informacja o błędzie
				echo 'Błąd: 4. Błędny rozmiar pliku.<br />';
				
				//Przekierowanie na stronę główną
				header('Refresh: 3; URL=pliczek.php');
				echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
			}
		} 
		else 
		{
			//Informacja o błędzie
			echo 'Błąd: 5. Błędny rozmiar pliku<br />';
			
			//Przekierowanie na stronę główną
			header('Refresh: 3; URL=pliczek.php');
			echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
		}
	}

	//Tworzenie nowego folderu
	if (!isset($_POST['submit'])) exit;
    $folder = $_POST['folder'];
	
    if (file_exists($folder))
	{
		echo 'Katalog '.$folder.' już istnieje.<br />
			  Przejdź do <a href="pliczek.php">Strony głównej</a>';
		
    }
	else if (!mkdir($folder))
    {
      echo 'Tworzenie katalogu '.$folder.' nie powiodło się.<br />
			Przejdź do <a href="pliczek.php">Strony głównej</a>';
    }
    else
	{
		echo 'Katalog '.$folder.' został utworzony.<br />
			  Przejdź do <a href="pliczek.php">Strony głównej</a>';
    }

	//Stworzenie pliku na podstawie przesłanego formularza
	if(isset($_POST['stworz_plik']))
	{ 
		{
			if(isset($_POST['tresc']))
			{
				$tresc = $_POST['tresc'];
				if(strlen($tresc) < 3 || strlen($tresc) > 1200)
				{
					echo 'Nieprawidłowa długość zawartości <b>treści</b> wpisu. <br />';
				
					//Przekierowanie na stronę główną
					header('Refresh: 3; URL=pliczek.php');
					echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu...';
				}
				else
				{
					$file = "moje dane.txt"; 
					$fp = fopen("$file", "r+");  
					$dane = $dane.fread($fp, filesize($file)); 
					rewind($fp); 
					flock($fp, 2);  
					fwrite($fp, $dane);  
					flock($fp, 3); 
					fclose($fp);
					
					echo 'Udało się zapisać podane dane do pliku. <br />
						  Twoje dane zapisane zostały do pliku'.$file.'<br />';
					
					//Przekierowanie na stronę główną
					header('Refresh: 3; URL=pliczek.php');
					echo 'Zaraz zostaniesz przekierowany na stronę główną serwisu.';
				}
			}
		}
		 
		
	}
	else
	{
		echo 'Błąd';
	}
	
?>