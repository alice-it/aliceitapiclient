<?php
namespace AliceIT;

class CloudServerHandler
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
        return $this->client->get('services/kvm');
    }

    /*
     *
     * 'cores'             => ['required', 'int', 'min:1', 'max:12'],
            'memory'            => ['required', 'int', 'min:1024', 'max:65536'],
            'disk'              => ['required', 'int', 'min:10', 'max:500'],
            'disk_secondary'    => ['nullable', 'int', 'min:0', 'max:500'],
            'ips'               => ['required', 'int', 'min:1', 'max:5'],
            'backups'           => ['nullable', 'int', 'min:1', 'max:5'],
            'os'                => ['required', 'exists:kvm_templates,id'],
            'disk_type'         => ['nullable', 'in:hdd,ssd'],
            'traffic'           => ['nullable', 'int', 'min:1'],
            'hostname'          => ['nullable'],
            'password'          => ['nullable']
     */

    public function create($cores, $memory, $disk, $ips, $os, $disk_secondary = null, $hostname = null, $password = null, $traffic = null, $additionalData = null){
        if($disk_secondary != null)
            $data['disk_secondary'] = $disk_secondary;

        if($hostname != null)
            $data['hostname'] = $hostname;

        if($password != null)
            $data['password'] = $password;

        if($traffic != null)
            $data['traffic'] = $traffic;


        $data['cores'] = $cores;
        $data['memory'] = $memory;
        $data['disk'] = $disk;
        $data['ips'] = $ips;
        $data['os'] = $os;
        
        if(isset($additionalData)){
            $data = array_merge($data, $additionalData);
        }

        return $this->client->post('services/kvm', $data);
    }

    public function listOS(){
        return $this->client->get('services/kvm/os');
    }

    public function listISO(){
        return $this->client->get('services/kvm/iso');
    }

    public function single($id)
    {
        return new SingleCloudServerHandler($id, $this->client);
    }
}
