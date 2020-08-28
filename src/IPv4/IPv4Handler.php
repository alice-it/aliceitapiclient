<?php
namespace AliceIT\IPv4;

use AliceIT\Client;

class IPv4Handler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * IPv4Handler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->basePath = 'services/colocation/ipv4_addresses';
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->get($this->basePath);
    }

    public function single($ip_address)
    {
        return new SingleIPv4Handler($ip_address, $this->client);
    }
}