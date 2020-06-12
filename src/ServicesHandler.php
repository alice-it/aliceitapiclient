<?php
namespace AliceIT;

use AliceIT\Domains\DomainHandler;

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
}