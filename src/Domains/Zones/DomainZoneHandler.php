<?php
namespace AliceIT\Domains\Zones;

use AliceIT\Client;

class DomainZoneHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * DomainZoneHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->basePath = 'services/domains/zones';
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->get($this->basePath);
    }

    public function create($zone_name, $ttl, $ns1, $ns2)
    {
        return $this->client->post($this->basePath, [
            'zone_name' => $zone_name,
            'ttl' => $ttl,
            'primary_nameserver' => $ns1,
            'secondary_nameserver' => $ns2
        ]);
    }

    public function single($id)
    {
        return new SingleDomainZoneHandler($id, $this->client);
    }
}