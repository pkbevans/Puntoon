<!-- NORMAL VERSION -->
<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Http\Client;
use Cake\I18n\Time;


?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
    <?php Debugger::checkSecurityKeys(); ?>
	<h3>Premier League Fixtures</h3>
	<?php
	$competition=426;
	$apiKey='2df7e1f5e2654abd9abe9fd0f79efffa';
	$uri = 'https://api.football-data.org/v1/competitions/' . $competition . '/fixtures';
	$http = new Client();
	// Simple get
	// Simple get with querystring & additional headers
	$response = $http->get($uri, null, [
			'headers' => ['X-Auth-Token' => $apiKey]
			]);
	?>
	<table>	
	<tr>
		<th>Date</th>
		<th>Home Team</th>
		<th></th>
		<th></th>
		<th>Away Team</th>
		<th>Time</th>
		<th>xxx</th>
	</tr>
	
	<?php foreach ($response->json['fixtures'] as $fixture):?>
	<?php 
		Time::setDefaultLocale('en-GB');
		$fixDate = Time::parse($fixture['date']);?>
		<tr>
		<?php $fixDate = Time::parse($fixture['date']);?>
			<td><?= h($fixDate->format('Y-m-d'));?>&nbsp;</td>
			<td><?= h($fixture['homeTeamName']); ?>&nbsp;</td>
			<td><?= h($fixture['result']['goalsHomeTeam']); ?>&nbsp;</td>
			<td><?= h($fixture['result']['goalsAwayTeam']); ?>&nbsp;</td>	
			<td><?= h($fixture['awayTeamName']); ?>&nbsp;</td>
			<td><?= h($fixDate->format('H:i'));?>&nbsp;</td>
			<?php 
				$url=$fixture['_links']['homeTeam']['href'];							
				$homeTeamId=substr($url, strrpos($url, "/") + 1);
				$url=$fixture['_links']['awayTeam']['href'];							
				$awayTeamId=substr($url, strrpos($url, "/") + 1);
			?>
			<td><?= h($fixture['homeTeamName']. ":" . $homeTeamId .",". $fixture['awayTeamName']. ":" . $awayTeamId);?>&nbsp;</td>
		</tr>		
	<?php endforeach; ?>
	</table>
	</body>
</html>

