<?php
namespace AliceIT\Domains\Nameserver;

use AliceIT\Client;

class SingleDomainNameserverHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingleDomainNameserverHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
        $this->basePath = 'services/domains/nameservers/'.$id;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        return $this->client->put($this->basePath);
    }

    public function delete()
    {
        return $this->client->delete($this->basePath);
    }
}