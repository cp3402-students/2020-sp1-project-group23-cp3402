<?php


$hookSecret = '_sup3r_s3cr3t_tok3n_'; // Github Webhook Secret

function onPush($github_payload)
{

	// Maybe Try to Find Unquie ID Over Using Hostnames
	$hostnames = array(
		/* Webhook Url Host => (
			System Word Press Install
			Github Branch To Check For
		) */

		/* Digital Ocean Host */
		"134.122.117.124" => array(
			"wordpressPath" => "/var/www/html/",
			"githubBranch" => "production"
		),

		/* AWS Host */
		"ec2-54-88-118-20.compute-1.amazonaws.com" => array(
			"wordpressPath" => "/var/www/wordpress/",
			"githubBranch" => "master"
		),
		"54.88.118.20" => array(
			"wordpressPath" => "/var/www/wordpress/",
			"githubBranch" => "master"
		)
	);

	$currentServer = $hostnames[$_SERVER['HTTP_HOST']];

	if (!isset($currentServer)) { // Host is Not In '$hostnames' above
		echo "I am Not a Valid Host in 'hostnames'\n";
		echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
		echo "SERVER_ADDR: " . $_SERVER["SERVER_ADDR"] . "\n";
		return 1;
	}

	/* Wordpress Pathing */
	$wordpressThemeFolder = $currentServer["wordpressPath"] . "wp-content/themes/";
	$ourThemeFolder = $wordpressThemeFolder . $github_payload->repository->name;
	echo sprintf("Wordpress Content Theme Folder Location: %s\nLocal Location of Theme: %s\n", $wordpressThemeFolder, $ourThemeFolder);

	/* Handle Updating & Cloning Theme */

	$checkoutBranch = $currentServer["githubBranch"];

	if ($github_payload->ref != "refs/heads/" . $checkoutBranch) { // See if this Server Needs to Pull Last Commit
		echo sprintf("I Only Want: refs/heads/%s --- Not: %s", $checkoutBranch, $github_payload->ref);
		return 0;
	}
	echo sprintf("Downloading Commit From Branch: %s\n", $checkoutBranch);
	if (file_exists($ourThemeFolder)) { // need to pull
		$pullCommand = sprintf("cd %s && git pull;", $ourThemeFolder);
		echo sprintf("Executing Command: %s\n", $pullCommand);
		exec($pullCommand, $output, $returnVal);
		echo sprintf("Command Response: %s\n", join("\n", $output));
		if ($returnVal != 0) {
			echo sprintf("Failed to Pull:\nBranch: %s\nTo Directory: %s", $checkoutBranch, $ourThemeFolder);
			return 1;
		} else echo sprintf("Pulled Latest Commit From: %s\n", $checkoutBranch);
	} else { // need to clone
		$cloneCommand = sprintf("cd %s && git clone --branch %s %s %s;", $wordpressThemeFolder, $checkoutBranch, $github_payload->repository->clone_url, $github_payload->repository->name);
		echo sprintf("Executing Command: %s\n", $cloneCommand);
		exec($cloneCommand, $output, $returnVal);
		echo sprintf("Command Response: %s\n", join("\n", $output));
		if ($returnVal != 0) {
			echo sprintf("Failed to Clone:\nBranch: %s\nTo Directory: %s\n", $checkoutBranch, $wordpressThemeFolder);
			return 1;
		} else echo sprintf("Cloned Latest Commit From: %s\n", $checkoutBranch);
	}
	return 0;
}

// Source Below From: https://gist.github.com/milo/daed6e958ea534e4eba3

/**
 * GitHub webhook handler template.
 * 
 * @see  https://developer.github.com/webhooks/
 * @author  Miloslav Hůla (https://github.com/milo)
 * 
 */

set_error_handler(function ($severity, $message, $file, $line) {
	throw new \ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function ($e) {
	header('HTTP/1.1 500 Internal Server Error');
	echo "Error on line {$e->getLine()}: " . htmlSpecialChars($e->getMessage());
	die();
});

$rawPost = NULL;
if ($hookSecret !== NULL) {
	if (!isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
		throw new \Exception("HTTP header 'X-Hub-Signature' is missing.");
	} elseif (!extension_loaded('hash')) {
		throw new \Exception("Missing 'hash' extension to check the secret code validity.");
	}

	list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
	if (!in_array($algo, hash_algos(), TRUE)) {
		throw new \Exception("Hash algorithm '$algo' is not supported.");
	}

	$rawPost = file_get_contents('php://input');
	if ($hash !== hash_hmac($algo, $rawPost, $hookSecret)) {
		throw new \Exception('Hook secret does not match.');
	}
};

if (!isset($_SERVER['CONTENT_TYPE'])) {
	throw new \Exception("Missing HTTP 'Content-Type' header.");
} elseif (!isset($_SERVER['HTTP_X_GITHUB_EVENT'])) {
	throw new \Exception("Missing HTTP 'X-Github-Event' header.");
}

switch ($_SERVER['CONTENT_TYPE']) {
	case 'application/json':
		$json = $rawPost ?: file_get_contents('php://input');
		break;

	case 'application/x-www-form-urlencoded':
		$json = $_POST['payload'];
		break;

	default:
		throw new \Exception("Unsupported content type: $_SERVER[CONTENT_TYPE]");
}

# Payload structure depends on triggered event
# https://developer.github.com/v3/activity/events/types/
$payload = json_decode($json);

switch (strtolower($_SERVER['HTTP_X_GITHUB_EVENT'])) {
	case 'ping':
		echo 'pong';
		break;

	case 'push': {
			if (onPush($payload) != 0) header('HTTP/1.0 500 Internal Server Error');
			break;
		}


		//	case 'create':
		//		break;

	default:
		header('HTTP/1.0 404 Not Found');
		echo "Event:$_SERVER[HTTP_X_GITHUB_EVENT] Payload:\n";
		print_r($payload); # For debug only. Can be found in GitHub hook log.
		die();
}
