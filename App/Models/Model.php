<?php

namespace App\Models;

use \PDO;

class Model extends Database
{
    protected $table;
    protected $primaryKey = 'id';
    protected $query;
    protected $bindings = [];
    protected $attributes = [];

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }

    public function save()
    {
        if (is_array($this->primaryKey)) {
            // Insert logic since we won't have an "update" for composite keys in this simple example
            $columns = array_keys($this->attributes);
            $placeholders = implode(", ", array_fill(0, count($columns), "?"));
            $values = array_values($this->attributes);

            $stmt = $this->getConnection()->prepare("INSERT INTO {$this->table} (" . implode(", ", $columns) . ") VALUES ($placeholders)");
            $stmt->execute($values);
        } else {
            if (isset($this->attributes[$this->primaryKey])) {
                // Existing update logic
                $columns = array_keys($this->attributes);
                $updateClause = implode(", ", array_map(function ($col) {
                    return "$col = ?";
                }, $columns));
                $values = array_values($this->attributes);
                $stmt = $this->getConnection()->prepare("UPDATE {$this->table} SET $updateClause WHERE {$this->primaryKey} = ?");
                $values[] = $this->attributes[$this->primaryKey];  // Add primary key value at the end
                $stmt->execute($values);
            } else {
                // Existing insert logic
                $columns = array_keys($this->attributes);
                $placeholders = implode(", ", array_fill(0, count($columns), "?"));
                $values = array_values($this->attributes);
                $stmt = $this->getConnection()->prepare("INSERT INTO {$this->table} (" . implode(", ", $columns) . ") VALUES ($placeholders)");
                $stmt->execute($values);
                $this->attributes[$this->primaryKey] = $this->getConnection()->lastInsertId();
            }
        }
    }




    public function __construct()
    {
        parent::__construct();
        $this->newQuery();
    }

    public function newQuery()
    {
        $this->query = "SELECT * FROM {$this->table}";
        $this->bindings = [];
        return $this;
    }

    public static function query()
    {
        return new static;
    }

    public static function find($id)
    {
        $model = new static;
        $stmt = $model->getConnection()->prepare("SELECT * FROM {$model->table} WHERE {$model->primaryKey} = ?");
        $stmt->execute([$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $key => $value) {
                $model->$key = $value;
            }
            return $model;
        }
        return null;
    }

    public function where($column, $operator, $value = null)
    {
        if (is_null($value)) {
            $value = $operator;
            $operator = '=';
        }

        if ($this->bindings) {
            $this->query .= " AND";
        } else {
            $this->query .= " WHERE";
        }

        $this->query .= " {$column} {$operator} ?";
        $this->bindings[] = $value;
        return $this;
    }

    // Get all results
    public function get()
    {
        $stmt = $this->getConnection()->prepare($this->query);
        $stmt->execute($this->bindings);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $models = [];

        foreach ($results as $result) {
            $model = new static;  // Create an instance of the current model
            foreach ($result as $key => $value) {
                $model->$key = $value;
                $model->__set($key, $value);
            }
            $models[] = $model;
        }

        return $models;
    }


    // Get the first result
    public function first()
    {
        $results = $this->get();

        if (!empty($results)) {
            $firstResult = $results[0];
            $model = new static;
            foreach ($firstResult as $key => $value) {
                $model->$key = $value;
            }
            return $model;
        }
        return null;
    }

    //delete
    public function delete()
    {
        if (is_array($this->primaryKey)) {
            $conditions = [];
            $values = [];
            foreach ($this->primaryKey as $key) {
                $conditions[] = "{$key} = ?";
                $values[] = $this->attributes[$key];
            }
            $conditionStr = implode(" AND ", $conditions);
            $stmt = $this->getConnection()->prepare("DELETE FROM {$this->table} WHERE {$conditionStr}");
            $stmt->execute($values);
        } else {
            $stmt = $this->getConnection()->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
            $stmt->execute([$this->attributes[$this->primaryKey]]);
        }
    }
}
