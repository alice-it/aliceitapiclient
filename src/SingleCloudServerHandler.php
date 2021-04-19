<?php
namespace AliceIT;

class SingleCloudServerHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingleKVMServiceHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;

        $this->basePath = 'services/kvm/'.$this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->client->get($this->basePath.'/status');
    }

    /**
     * @return mixed
     */
    public function start()
    {
        return $this->client->post($this->basePath.'/status/start');
    }

    /**
     * @return mixed
     */
    public function stop()
    {
        return $this->client->post($this->basePath.'/status/stop');
    }

    /**
     * @return mixed
     */
    public function shutdown()
    {
        return $this->client->post($this->basePath.'/status/shutdown');
    }

    /**
     * @return mixed
     */
    public function restart()
    {
        return $this->client->post($this->basePath.'/status/restart');
    }

    /**
     * @return mixed
     */
    public function getVncConsole(){
        return $this->client->get($this->basePath.'/vnc');
    }

    /**
     * @param $iso
     * @return mixed
     */
    public function mountISO($iso){
        return $this->client->post($this->basePath.'/iso', [
            'iso' => $iso
        ]);
    }

    /**
     * @return mixed
     */
    public function unmountISO(){
        return $this->client->delete($this->basePath.'/iso');
    }

    /**
     * @param $template
     * @param $hostname
     * @param $password
     * @return mixed
     */
    public function reinstall($template, $hostname, $password){
        return $this->client->post($this->basePath.'/reinstall', [
            'os' => $template,
            'hostname' => $hostname,
            'password' => $password
        ]);
    }

    /**
     * @return mixed
     */
    public function deleteServer(){
        return $this->client->delete($this->basePath);
    }

    /**
     * @param $cores
     * @param $memory
     * @param $disk
     * @param $disk_hdd
     * @param $ipv4
     * @return mixed
     */
    public function changePerformance($cores, $memory, $disk, $disk_hdd, $ipv4){
        return $this->client->put($this->basePath, [
            'cores'             => $cores,
            'memory'            => $memory,
            'disk'              => $disk,
            'disk_secondary'    => $disk_hdd,
            'ips'               => $ipv4
        ]);
    }

    /**
     * @return mixed
     */
    public function tasks(){
        return $this->client->get($this->basePath.'/tasks');
    }

    /**
     * @return mixed
     */
    public function traffic(){
        return $this->client->get($this->basePath.'/traffic');
    }

    /**
     * @param string $tf
     * @param string $cf
     * @return mixed
     */
    public function rrdData($tf = "hour", $cf = "AVERAGE"){
        return $this->client->get($this->basePath.'/rrddata',
            [
                'tf' => $tf,
                'cf' => $cf
            ]
        );
    }

    /**
     * @param $ip
     * @param $value
     * @return mixed
     */
    public function setRdns($ip, $value){
        return $this->client->post($this->basePath.'/rdns',
            [
                'ip' => $ip,
                'value' => $value
            ]
        );
    }
}
