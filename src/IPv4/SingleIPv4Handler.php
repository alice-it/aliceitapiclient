<?php
namespace AliceIT\IPv4;

use AliceIT\Client;

class SingleIPv4Handler
{
    private $client;
    private $ip_address;
    private $basePath;

    /**
     * SingeDomainHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($ip_address, Client $client)
    {
        $this->ip_address = $ip_address;
        $this->client = $client;
        $this->basePath = 'services/colocation/ipv4_addresses/'.$ip_address;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->client->get($this->basePath);
    }

    public function traffic($from, $to)
    {
        return $this->client->get($this->basePath.'/traffic?from='.$from.'&to='.$to);
    }

    public function ddos_alerts(){
        return $this->client->get($this->basePath.'/ddosalerts');
    }
}