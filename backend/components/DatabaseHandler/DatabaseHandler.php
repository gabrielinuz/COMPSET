<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/DatabaseHandler/interface/DatabaseHandlerInterface.php';
include_once 'components/DatabaseHandler/configuration.php';

class DatabaseHandler implements DatabaseHandlerInterface
{
    public function __construct()
    {
        $this->handle = null;
        $this->statement = null;
        $this->returnsData = false;
        $this->data = null;
        $this->connect();
    }

    public function connect()
    {
        try 
        {
            switch (CT_DATABASE_ENGINE)
            {
                case 'sqlite':
                    $this->handle = new PDO( 'sqlite:' . CT_DATABASE_FILE_PATH);
                break;

                case 'mysql':
                    if (!defined('CT_DATABASE_PORT')) define('CT_DATABASE_PORT', '3306');
                    $this->handle = new PDO('mysql:host=' . CT_DATABASE_HOST 
                                                    . ';port=' . CT_DATABASE_PORT 
                                                    . ';dbname=' . CT_DATABASE_NAME
                                                    .';charset=' 
                                                    . CT_DATABASE_CHARSET,
                                                    CT_DATABASE_USER,
                                                    CT_DATABASE_PASS);
                break;

                case 'pgsql':
                    if (!defined('CT_DATABASE_PORT')) define('CT_DATABASE_PORT', '5432');
                    $this->handle = new PDO("pgsql:host=". CT_DATABASE_HOST
                                                    . ';port=' . CT_DATABASE_PORT 
                                                    .';dbname=' . CT_DATABASE_NAME
                                                    .';charset=' . CT_DATABASE_CHARSET,
                                                    CT_DATABASE_USER,
                                                    CT_DATABASE_PASS);
                break;
            }
            # To generate PDO exceptions.
            $this->handle->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch ( PDOException $exception )
        {
            die ( CT_DATABASE_CONNECTION_ERROR . $exception->getMessage() );
        }

        return $this->handle;
    }

    public function disconnect()
    {
        $this->handle = null;
    }

    private function bindParams($statement, $params)
    {
        if (!empty($params))
        {
            if (is_array($params)) 
            {
                foreach ($params as $key => $value)
                {
                    $statement->bindValue($key+1, $value);
                }
            }
            else
            {
                $statement->bindValue(1, $params);
            }
        }
        return $statement;
    } 

    private function execute($query, $param)
    {
        $statement = $this->handle->prepare($query);
        $this->statement = $this->bindParams($statement, $param);
        $this->data = $this->statement->execute();
        if (strpos(strtolower($query), 'select') !== false) $this->returnsData = true;
        if (strpos(strtolower($query), 'call') !== false) $this->returnsData = true;
    }

    public function exec($sql, $params = null)
    {
        try 
        {  
            $this->handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->handle->beginTransaction();
            if ( is_array($sql) ) 
            {
                $queries = $sql;
                foreach ($queries as  $key => $query) 
                {
                    $param = (empty($params)) ? null : $params[$key];
                    $this->execute($query, $param);
                }
            }
            else
            {
                $this->execute($sql, $params);
            }

            if ($this->returnsData) $this->data = $this->statement->fetchAll();
            $this->handle->commit();
        }
        catch(PDOException $exception)
        {
            $this->handle->rollBack();
            die( CT_DATABASE_TRANSACTION_ERROR . $exception->getMessage() );
        }

        return $this->data;
    }   

    public function __destruct()
    {
        $this->disconnect();
    }
}
?>