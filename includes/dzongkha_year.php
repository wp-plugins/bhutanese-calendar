<?php
//First Year
$first_piece_tr = explode("-", $bt_year);

switch($first_piece_tr['0']){ 
	case "Iron": $first_piece_tr['0'] = "ལྕགས་"; break; 
	case "Water": $first_piece_tr['0'] = "ཆུ་"; break; 
	case "Earth": $first_piece_tr['0'] = "ས་"; break; 
	case "Fire": $first_piece_tr['0'] = "མེ་"; break; 
	case "Wood": $first_piece_tr['0'] = "ཤིང"; break;
}
switch($first_piece_tr['1']){ 
	case "female": $first_piece_tr['1'] = "མོ་"; break; 
	case "male": $first_piece_tr['1'] = "ཕོ་"; break; 
}
switch($first_piece_tr['2']){ 
	case "Mouse": $first_piece_tr['2'] = "སྦྱི་"; break; 
	case "Ox": $first_piece_tr['2'] = "གླང་"; break; 
	case "Tiger": $first_piece_tr['2'] = "སྟག་"; break; 
	case "Rabbit": $first_piece_tr['2'] = "ཡོས་"; break; 
	case "Dragon": $first_piece_tr['2'] = "འབྲུག་"; break;
	case "Snake": $first_piece_tr['2'] = "སྦྲུལ་"; break;
	case "Horse": $first_piece_tr['2'] = "རྟ་"; break;
	case "Sheep": $first_piece_tr['2'] = "ལུག་"; break;
	case "Monkey": $first_piece_tr['2'] = "སྤྲེ་"; break;
	case "Bird": $first_piece_tr['2'] = "བྱ་"; break;
	case "Dog": $first_piece_tr['2'] = "ཁྱི་"; break;
	case "Pig": $first_piece_tr['2'] = "ཕག་"; break;
}

$bt_year_tr=$first_piece_tr['0'].$first_piece_tr['1'].$first_piece_tr['2'];

//Second Year
$second_piece_tr = explode("-", $bt_secondyear);
switch($second_piece_tr['0']){ 
	case "Iron": $second_piece_tr['0'] = "ལྕགས་"; break; 
	case "Water": $second_piece_tr['0'] = "ཆུ་"; break; 
	case "Earth": $second_piece_tr['0'] = "ས་"; break; 
	case "Fire": $second_piece_tr['0'] = "མེ་"; break; 
	case "Wood": $second_piece_tr['0'] = "ཤིང"; break;
}
switch($second_piece_tr['1']){ 
	case "female": $second_piece_tr['1'] = "མོ་"; break; 
	case "male": $second_piece_tr['1'] = "ཕོ་"; break; 
}
switch($second_piece_tr['2']){ 
	case "Mouse": $second_piece_tr['2'] = "སྦྱི་"; break; 
	case "Ox": $second_piece_tr['2'] = "གླང་"; break; 
	case "Tiger": $second_piece_tr['2'] = "སྟག་"; break; 
	case "Rabbit": $second_piece_tr['2'] = "ཡོས་"; break; 
	case "Dragon": $second_piece_tr['2'] = "འབྲུག་"; break;
	case "Snake": $second_piece_tr['2'] = "སྦྲུལ་"; break;
	case "Horse": $second_piece_tr['2'] = "རྟ་"; break;
	case "Sheep": $second_piece_tr['2'] = "ལུག་"; break;
	case "Monkey": $second_piece_tr['2'] = "སྤྲེ་"; break;
	case "Bird": $second_piece_tr['2'] = "བྱ་"; break;
	case "Dog": $second_piece_tr['2'] = "ཁྱི་"; break;
	case "Pig": $second_piece_tr['2'] = "ཕག་"; break;
}
$bt_secondyear_tr=$second_piece_tr['0'].$second_piece_tr['1'].$second_piece_tr['2'];
 ?>