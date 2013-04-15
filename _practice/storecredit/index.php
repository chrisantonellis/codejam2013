<?

//////////////////////////////////////////////////////////////////
//                                                              //
//   Google Code Jam 2013                                       //
//   https://code.google.com/codejam                            //
//   Practice Problem                                           //
//   Africa 2010 Qualification Round: Problem A. Store Credit   //
//                                                              //
//////////////////////////////////////////////////////////////////

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

////////////////////////
//                    //
//   Program Start    //
//                    //
////////////////////////

$io = new IOHandler("A-large-practice.in");

$purchases = $io -> getData();

for($p = 0; $p < $purchases; $p++) {

	$credits   = intval($io -> getData());
	$itemCount = intval($io -> getData());
	$items     = explode(" ", $io -> getData());

	$startPosition = 1;

	for($i = 0; $i < ($itemCount - 1); $i++) {
		for($j = $startPosition; $j < $itemCount; $j++) {

			if(intval($items[$i]) + intval($items[$j]) === $credits) {
				$io -> output .= ("Case #" . ($p + 1) . ": " . ($i + 1). " " . ($j + 1) . "\n");
			}
		}

		$startPosition++;
	}
}

$io -> saveOutput();

print("completed successfully");
