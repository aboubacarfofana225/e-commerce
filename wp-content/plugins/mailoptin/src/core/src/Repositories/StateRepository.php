<?php

namespace MailOptin\Core\Repositories;


class StateRepository
{
    protected $option_name;

    public function __construct()
    {
        $this->option_name = 'mo_state_repository';
    }

    public function get($key)
    {
        return isset($this->getAll()[$key]) ? $this->getAll()[$key] : [];
    }

    public function set($key, $value)
    {
        if (empty($key) || empty($value)) return false;

        $data = $this->getAll();
        $data[$key] = $value;

        return update_option($this->option_name, $data);
    }

    public function getAll()
    {
        return get_option($this->option_name, []);
    }
}