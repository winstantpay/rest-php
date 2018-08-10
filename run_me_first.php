<?php
require __DIR__ . '/vendor/autoload.php';


use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;
use GuzzleHttp\Client;


class Winstant extends CLI
{

	private $clientId=0;
	private $kycClient;
	private $config;
	private $token;

    // register options and arguments
    protected function setup(Options $options)
    {
        $options->setHelp('A very small example how to work with the WinstantPay API');
        $options->registerOption('version', 'print version', 'v');
        $options->registerOption('config', 'print configuration', 'c');
    }


    private function login() 
    {
        $client = new GuzzleHttp\Client(['base_uri' => $this->config->url]);
		$response = $client->request('POST', 'client/auth/', [
			'json' => ['username'=>$this->config->username , 'password'=> $this->config->password]
		]);

		$resp = json_decode($response->getBody());
		$this->token = $resp->token;
    }



    private function registerClient($nextRequirementId, $requirements)
    {
    	$data = [];
        $client = new GuzzleHttp\Client(['base_uri' => $this->config->url]);
        $uri = 'client/signup/?service_caller_id='.$this->config->APIKey;
        if ($nextRequirementId) {
        	$uri .= "&requirement_id=".$nextRequirementId;
        }
        if ($this->clientId > 0 ) {
        	$uri .= "&client_id=".$this->clientId;
        	$this->info("Client_id: ".$this->clientId);
        }

        foreach ($requirements->field_names as $key) {
 		   echo ":: $key -> ".$this->kycClient->$key."\n";
 		   $data[$key] = $this->kycClient->$key;
		}

		$json_string = json_encode($data, JSON_PRETTY_PRINT);
		echo "---------------------\n";
		echo $json_string."\n";
		echo "---------------------\n";

        $this->info($uri);
		$response = $client->request('POST',$uri, [
			'json' => $data,
            'headers' => [
                'Authorization' => 'token ' . $this->token,
            ],
		]);
		$response = json_decode($response->getBody());
		var_dump($response);
		if (isset($response->id)) {
			$this->clientId = $response->id;
		}
    }


    private function handleStep($nextRequirementId,$requirements) 
    {
		$newKYCClient = $this->registerClient($nextRequirementId, $requirements);
		$nextRequirementId = $requirements->requirement_id;

		return $nextRequirementId;    	
    }



    protected function main(Options $options)
    {
       	$this->config = include(__DIR__ . '/config.php');
       	$this->kycClient = include(__DIR__ . '/client.php');

        if ($options->getOpt('version')) {
            $this->info('1.0.0');
        }
        if ($options->getOpt('config')) {
            var_dump($config);
        }

        $this->login();

        $nextRequirementId 	= null;
		$client 			= new GuzzleHttp\Client(['base_uri' => $this->config->url]);

        do {
        	$uri = '/client/schema/?service_caller_id='.$this->config->APIKey;
        	if ($nextRequirementId) {
        		$uri .= '&requirement_id='.$nextRequirementId;
        	}
        	$this->info($this->config->url.$uri);

        	$response = $client->request('GET', $uri);
        	if($response->getStatusCode() == 200) {
        		$requirement = json_decode($response->getBody());
        		//var_dump($requirement);
    			$nextRequirementId = $this->handleStep($nextRequirementId,$requirement);
    		}
    		else {
    			$nextRequirementId = null;
    			$this->error("Fatal step machine error. Please contact WKYC support");
    		}

		} while ($nextRequirementId != null);
    }
}


$cli = new Winstant();
$cli->run();