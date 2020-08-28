<?php
namespace AliceIT;

use AliceIT\Domains\DomainHandler;
use AliceIT\Domains\Nameserver\IPv4Handler;

class ServicesHandler
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll()
    {
        return $this->client->get('services');
    }

    private $cloudServerHandler;
    public function cloud_server(){
        if(!$this->cloudServerHandler) {
            $this->cloudServerHandler = new CloudServerHandler($this->client);
        }

        return $this->cloudServerHandler;
    }

    private $domainHandler;
    public function domains(){
        if(!$this->domainHandler) {
            $this->domainHandler = new DomainHandler($this->client);
        }

        return $this->domainHandler;
    }

    private $ipv4Handler;
    public function ip_addresses(){
        if(!$this->ipv4Handler) {
            $this->ipv4Handler = new IPv4Handler($this->client);
        }

        return $this->ipv4Handler;
    }
}