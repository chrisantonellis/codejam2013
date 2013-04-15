<?

//////////////////////////////////////////
//                                      //
//   Google Code Jam 2013               //
//   https://code.google.com/codejam    //
//   Problem A. Tic Tac Toe Tomek       //
//                                      //
//////////////////////////////////////////

/**
 *   IOHandler
 *   Handles IO functions for Google CodeJam .in and .out files
 */
class IOHandler {
	var $data;
	var $index;
	var $output;
	var $outputfilename;

	function __construct($inputfile) {

		$filehandle = fopen ($inputfile, 'r');
		$this -> data = fread($filehandle, filesize($inputfile));
		fclose($filehandle);

		$this -> outputfilename = explode(".", $inputfile);
		$this -> outputfilename = $this -> outputfilename[0] . ".out";

		$this -> data = explode("\n", $this -> data);
		$this -> index = -1;
	}

	function getData() {
		$this -> index++;
		return($this -> data[$this -> index]);
	}

	function saveOutput() {
		file_put_contents($this -> outputfilename, $this -> output);
	}
}

///////////////////////
//                   //
//   Start Program   //
//                   //
///////////////////////

$io = new IOHandler("A-large.in");

define("BOARD_WIDTH", 4);
define("BOARD_HEIGHT", 4);
define("WILDCARD", "T");

$players = array("X", "O");

$games = $io -> getData();

for($i = 0; $i < $games; $i++) {

	$emptyspace = false;

	$outcome = array();

	$game = array(str_split($io -> getData(0)),
	              str_split($io -> getData(0)),
	              str_split($io -> getData(0)),
	              str_split($io -> getData(0)));

	for($j = 0; $j < count($players); $j++) {

		// winning condition
		$win = $players[$j] . $players[$j] . $players[$j] . $players[$j];

		// wins for this player
		$outcome[$players[$j]] = 0;

		// rows
		for($k = 0; $k < BOARD_HEIGHT; $k++) {

			$row = "";

			for($l = 0; $l < BOARD_WIDTH; $l++) {

				if($game[$k][$l] === ".") {
					$emptyspace = true;
				}
				$row .= $game[$k][$l];
			}
			$row = str_replace(WILDCARD, $players[$j], $row);

			if($win === $row) {
				$outcome[$players[$j]]++;
			}
		}

		// columns
		for($k = 0; $k < BOARD_WIDTH; $k++) {

			$column = "";

			for($l = 0; $l < BOARD_HEIGHT; $l++) {	
				$column .= $game[$l][$k];
			}
			$column = str_replace(WILDCARD, $players[$j], $column);

			if($win === $column) {
				$outcome[$players[$j]]++;
			}
		}

		// diagonals
		for($k = 0; $k < 2; $k++) {

			$diagonal = "";
			for($l = 0; $l < BOARD_HEIGHT; $l++) {
				if($k === 0) {
					$diagonal .= $game[$l][$l];
				} else {
					$diagonal .= $game[((BOARD_WIDTH - 1) - $l)][$l];
				}
			}

			$diagonal = str_replace(WILDCARD, $players[$j], $diagonal);

			if($win === $diagonal) {
				$outcome[$players[$j]]++;
			}
		}
	}

	$io -> output .= "Case #" . ($i + 1) . ": ";

	if($outcome["X"] > 0 && $outcome["O"] === 0) {
		$io -> output .= "X won";
	} else if($outcome["O"] > 0 && $outcome["X"] === 0) {
		$io -> output .= "O won";
	} else if ($outcome["X"] === 0 && $outcome["O"] === 0 && !$emptyspace) {
		$io -> output .= "Draw";
	} else {
		$io -> output .= "Game has not completed";
	}

	if($i !== ($games - 1)) {
		$io -> output .= "\n";
	}

	$temp = $io -> getData(); // throwaway blank line
}

$io -> saveOutput();

print("completed successfully");