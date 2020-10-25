<!DOCTYPE html>
<html>
<head>
	<title>ReviewCheck</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>

	<div class="details">

		<h2>OSP PROJECT</h2>
		<h2>Review Check</h2>

	</div>
	<form method="POST" action="">
		<textarea name="review" rows ="12" cols ="100">Enter the movie review here</textarea><br>
		<input type="submit" name="submit" value="CHECK">
	</form>


	<?php

		use Rubix\ML\PersistentModel;
		use Rubix\ML\Persisters\Filesystem;

		if (isset($_POST["submit"]))
		{
			$review = $_POST["review"];
			$numberOfWords = str_word_count($review);

			if($numberOfWords < 20){
				echo "<script>alert('The review should be atleast 20 words')</script>";
			}
			else
			{
				include __DIR__ . '/vendor/autoload.php';


				ini_set('memory_limit', '-1');

				$estimator = PersistentModel::load(new Filesystem('sentiment.model'));

				$prediction = $estimator->predictSample([$review]);

				echo "<script>alert('The sentiment is: $prediction')</script>" . PHP_EOL;

			}
		}
	?>

</body>
</html>