<?php


namespace MS\Core\Helper;


class MSMagic
{

    public function version($raw = false)
    {

        return ($raw) ? env('MS_FRAME_VERSION') : implode(' ', ['MS Frame Version:', env('MS_FRAME_VERSION')]);
    }

    public function msdb(string $nameSpace, string $id = null, array $perFix = [], array $tableData = [])
    {

        $tableKey = implode('_', [$nameSpace, $id, implode('_', $perFix)]);
        if ($this->cache()->hasMSDB($tableKey) && !env('MS_DEBUG')) return $this->cache()->getFromMSDB($tableKey);

        return new \MS\Core\Helper\MSDB($nameSpace, $id, $perFix, $tableData);
    }

    public function random($count = 4, $type = 1, $lvl = 1, $preFix = [], $dv = '_')
    {
        return \MS\Core\Helper\Comman::random($count, $type, $lvl, $preFix, $dv);
    }

    public function cache()
    {
        return \MS\Core\Helper\MSCache::getClassFromMagic();
    }

    public function do()
    {
        return new MSFrame();
    }

    public function getMiddleware($type)
    {
        $typeData = [
            'api' => '\MS\Middlelwares\onlyAjaxRoute',
            'onlyuser' => '\MS\Middlelwares\onlyForUsers',
            'role' => '\MS\Middlelwares\allowedToAccess'
        ];
        if (!array_key_exists($type, $typeData)) throw new \Exception('Type of Middleware Not Found');
        $c = $this->cache();

        $class = $c->getMiddleware($type);
        if (!$class && array_key_exists($type, $typeData)) $c->setMiddleware($type, new $typeData[$type]());
        return $c->getMiddleware($type);
    }

    public function user()
    {
        return \MS\Mod\B\User4O3\F::getUser();
    }

    public function role()
    {

        return $this->user()['CompanyPost'];
    }

    public function companyId()
    {
        return $this->user()['currentCompany'];

    }

    public function rootId()
    {
        $user = $this->user();
        return ($this->checkRootUser()) ? $user['id'] : $user['RootId'];
    }

    public function checkRootUser()
    {
        $currentUser = $this->user();
        return (array_key_exists('RootId', $currentUser)) ? false : true;
    }

    public function getFuncitonName($method)
    {
        $exMethod = explode('::', $method);
        return end($exMethod);

    }

    public function debug()
    {
        return env('MS_DEBUG');
    }

    public function encode($str)
    {
        return \MS\Core\Helper\Comman::encode($str);
    }

    public function decode($str)
    {
        return \MS\Core\Helper\Comman::decode($str);
    }

    public function encodeLimit($str = '', $min = 30, $zone = 'Asia/Kolkata', $salt = "|\/|")
    {
        return \MS\Core\Helper\Comman::encodeLimit($str, $min, $zone, $salt);
    }

    public function decodeLimit($str = '', $min = 30, $zone = 'Asia/Kolkata', $salt = "|\/|")
    {
        return \MS\Core\Helper\Comman::decodeLimit($str, $min, $zone, $salt);
    }

    public function app()
    {
        return new \MS\Mod\B\Mod4O3\L\App();
    }

}
