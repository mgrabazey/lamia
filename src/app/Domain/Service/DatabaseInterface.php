<?php

namespace Shop\Domain\Service;

interface DatabaseInterface
{
    /**
     * @return mixed
     */
    public function beginTransaction();

    /**
     * @return mixed
     */
    public function commit();

    /**
     * @return mixed
     */
    public function rollBack();
}