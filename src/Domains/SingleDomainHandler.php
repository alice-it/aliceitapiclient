<?php
namespace AliceIT\Domains;

use AliceIT\Client;

class SingleDomainHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingeDomainHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;

        $this->basePath = 'services/domains/'.$this->id;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->client->get($this->basePath);
    }

    /**
     * @return mixed
     */
    public function set($owner, $admin, $tech, $zone, $ns1, $ns2, $ns3 = "", $ns4 = "", $ns5 = ""){
        if($ns3 != null)
            $data['ns3'] = $ns3;
    
        if($ns4 != null)
            $data['ns4'] = $ns4;
    
        if($ns5 != null)
            $data['ns5'] = $ns5;
    
        $data['owner'] = $owner;
        $data['admin'] = $admin;
        $data['tech'] = $tech;
        $data['zone'] = $zone;
        $data['ns1'] = $ns1;
        $data['ns2'] = $ns2;
    
        return $this->client->put($this->basePath, $data);
    }

    /**
     * @return mixed
     */
    public function delete($date){
        return $this->client->delete($this->basePath, ['date' => $date]);
    }
}