<?php
namespace AliceIT\Domains\Zones;

use AliceIT\Client;

class SingleDomainZoneHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingleDomainZoneHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
        $this->basePath = 'services/domains/zones/'.$id;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->client->get($this->basePath);
    }

    public function insertRecord($type, $name, $content, $ttl)
    {
        return $this->client->post($this->basePath . '/records', [
            'type' => $type,
            'name' => $name,
            'content' => $content,
            'ttl' => $ttl
        ]);
    }

    public function deleteRecord($type, $name, $content)
    {
        return $this->client->delete($this->basePath . '/records', [
            'type' => $type,
            'name' => $name,
            'content' => $content
        ]);
    }
}