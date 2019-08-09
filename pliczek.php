<!DOCTYPE html>
<html lang="pl-PL">
	<head>
		<meta name="keyword" content="Strony na GITHub" />
		<meta name="description" content="Strony na GITHub" />
		<title>Strony i projekty na GITHuba</title>
	</head>
	<body>
		<h3>System plików, katalogów i folderów</h3>
		<div>
			<br />
			<h3>Stwórz plik [w .txt]</h3>
			<form action="pliczek-serwer.php" method="POST">
				<textarea rows="6" cols="30" name="tresc" placeholder="Napisz coś"></textarea><br />
				<input type="submit" name="stworz_plik" value="Napisz" />
				<input type="reset" value="Wyczyść" />
			</form>
			
			<h3>Utwórz katalog</h3>
		    <form action="pliczek-serwer.php" method="POST">
				<input type="text" name="folder" placeholder="Wymyśl jakąś nazwę">
				<input type="submit" name="submit" value="Utwórz katalogi" />
			</form><br />
		
			<h3>Prześlij plik</h3>
			<form action="pliczek-serwer.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="plik" value="Wybierz"/>
				<input type="submit" name="wyslij_plik" value="Prześlij plik" />
			</form>
		</div>
	
		<div>
			<?php
				
				echo '<hr /><h3>Katalogi - zawartość i edycja</h3>';
				
				//Akcje dla plików - USUWANIE - przekazywanie pliku do usuniecia
				$katalog = 'testowy';
				if (isset($_GET['usun']))
				{
				   $usun = $_GET['usun'];
				   
				   //usuwanie pliku
				   if(file_exists($katalog.'/'.$usun) & $usun!="")
				   {
					  unlink($katalog.'/'.$usun);
				   }
				}
				
				//Wypisanie wszystkich folderów i plików w bieżącym katalogu
				if ($dir = @opendir("./")) 
				{
				   while($plik = readdir($dir)) 
				   {
					  echo "> $plik - ".filesize($plik)." bajtów. ".is_dir($plik)."<br />";
				   }  
				   closedir($dir);
				}
				
				echo '<hr />';
				
				//Listowanie plików w folderze 'Testowy'
				$pliki = scandir($katalog,1);
				echo '<p>Pliki w katalogu: <b>'.$katalog.'</b><br /><br />';
				foreach($pliki as $plik) 
				{
					echo '<a href="'.$plik.'" target="_blank" title="Pokaż plik">Pokaż</a> | 
						  <a href="pliczek.php?usun='.$plik.'" title="Usuń plik" OnClick="return confirm(\'Czy na pewno chcesz usunąć plik?\');">Usuń plik</a> - '.$plik.'</p>';
				}
				
				//Wypisanie ilości plików w katalogu
				$katalog = 'testowy';
				$kat = opendir($katalog); 
				$ile = 0; 
				while($plik = readdir($kat))
				{ 
				  $ile++; 
				} 
				$ileplikow = $ile-2;
				echo 'Ilość wszystkich plików w katalogu <b>'.$katalog.'</b>: <b>'.$ileplikow.'</b><br />';
				
			?>
		</div>
	</body>
</html>