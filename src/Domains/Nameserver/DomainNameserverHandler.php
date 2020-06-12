<?php
namespace AliceIT\Domains\Nameserver;

use AliceIT\Client;

class DomainNameserverHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingeDomainHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->basePath = 'services/domains/nameservers';
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->get($this->basePath);
    }

    public function create($name)
    {
        return $this->client->post($this->basePath, [
            'name' => $name
        ]);
    }

    public function single($id)
    {
        return new SingleDomainNameserverHandler($id, $this->client);
    }
}