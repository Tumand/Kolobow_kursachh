<?php
echo "<div class='poisk'>
			  <div class='form_poisk_block'>
					<p class='form_poisk_block_head_text'>Поиск</p>
					<input type='search' name='poiskPR' style='font-size:18px;' id='poiskPR' placeholder='Введите что-то' required value=''>			
					<button class='form_osn_button' onclick = \"setPoiskRez()\"><font size='4'><b>🔎</b></font></button>
					<div id='poiskRez'>
					</div>
			  </div>
		</div>
		";
?>