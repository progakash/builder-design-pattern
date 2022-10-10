<?php
namespace BuilderDesignPattern;

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;

    protected function reset()
    {
        //stdClass is just a generic 'empty' class
        $this->query = new \stdClass();
    }

    public function getReset()
    {
        $ob = new \stdClass();
        // $ob = $this->query;
        print_r($ob);
    }

    
    public function getGenericClassProperty()
    {
        $base = $this->query->base;
        $type = $this->query->type;
        $where = $this->query->where;
        $limit = $this->query->limit;
        return $this->query;
    }


    /**
     * Build a base SELECT query.
     */
    public function select(string $table, array $fields)
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * Add a WHERE condition.
     */
    public function where(string $field, string $value, string $operator = '=')
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    /**
     * Add a LIMIT constraint.
     */
    public function limit(int $start, int $offset)
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * Get the final query string.
     */
    public function getSQL()
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";
        return $sql;
    }
}
?>