<?php
namespace AliceIT\Domains;

use AliceIT\Client;
use AliceIT\Domains\Nameserver\DomainNameserverHandler;
use AliceIT\Domains\Zones\DomainZoneHandler;
use AliceIT\Domains\Handles\DomainHandleHandler;

class DomainHandler
{
    private $client;

    /**
     * KVMServicesHandler constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->get('services/domains');
    }

    public function checkAvailability($sld, $tld){
        return $this->client->get('services/domains/check',[
            'tld' => $tld,
            'sld' => $sld
        ]);
    }

    public function prices($tld = ""){
        return $this->client->get('services/domains/prices',[
            'tld' => $tld
        ]);
    }

    public function create($sld, $tld, $authcode = "", $owner = "", $admin = "", $tech = "", $zone = "", $ns1 = "", $ns2 = "", $ns3 = "", $ns4 = "", $ns5 = ""){
        if($authcode != null)
            $data['authcode'] = $authcode;

        if($owner != null)
            $data['owner'] = $owner;

        if($admin != null)
            $data['admin'] = $admin;

        if($tech != null)
            $data['tech'] = $tech;

        if($zone != null)
            $data['zone'] = $zone;
        
        if($ns1 != null)
            $data['ns1'] = $ns1;
    
        if($ns2 != null)
            $data['ns2'] = $ns2;

        if($ns3 != null)
            $data['ns3'] = $ns3;

        if($ns4 != null)
            $data['ns4'] = $ns4;

        if($ns5 != null)
            $data['ns5'] = $ns5;


        $data['sld'] = $sld;
        $data['tld'] = $tld;

        return $this->client->post('services/domains', $data);
    }

    public function single($id)
    {
        return new SingleDomainHandler($id, $this->client);
    }

    private $domainNameserverHandler;
    public function nameservers(){
        if(!$this->domainNameserverHandler) {
            $this->domainNameserverHandler = new DomainNameserverHandler($this->client);
        }

        return $this->domainNameserverHandler;
    }

    private $domainZoneHandler;
    public function zones(){
        if(!$this->domainZoneHandler) {
            $this->domainZoneHandler = new DomainZoneHandler($this->client);
        }

        return $this->domainZoneHandler;
    }

    private $domainHandleHandler;
    public function handles(){
        if(!$this->domainHandleHandler) {
            $this->domainHandleHandler = new DomainHandleHandler($this->client);
        }

        return $this->domainHandleHandler;
    }
}