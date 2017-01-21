<?php

class Model extends Database {

    private $tabla = null;

    public function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    public function setTable($tabla) {
        $this->tabla = $tabla;
    }

    public function getTable() {
        return $this->tabla;
    }

    public function getAll($table = false, $start = false, $end = false) {
        if (!$table) {
            die('you must set table name');
        }
        if ($start == false && $end == false) {
            $query = $this->db->prepare("SELECT * FROM {$table}");
        } else {
            $limite = 'limit ' . $start . ',' . $end;
            $query = $this->db->prepare("SELECT * FROM {$table} {$limite}");
        }
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingleValue($consulta) {
        try {
            $query = $this->db->prepare($consulta);
            $query->execute();
            return $query->fetchColumn();
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage() . '<br><br>';
        }
    }

    public function getRowQuery($consulta) {
        $query = $this->db->prepare($consulta);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getRowObject($consulta) {
        $query = $this->db->prepare($consulta);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function parseWhere($parameters) {
        $cont = 0;
        $where = "";

        foreach ($parameters as $field => $value) {
            if ($cont == 0) {
                $where = "WHERE " . $field . " = '" . $value . "'";
            } else {
                $where .= " AND " . $field . " = '" . $value . "'";
            }
            $cont++;
        }
        return $where;
    }

    public function insertRow($args, $tabla) {
        $campos = $this->parseTableSchema($tabla);
        $values = $this->parseValuesInsertFila($campos, $args);
        $query = 'INSERT INTO ' . $tabla . '(' . $campos . ') VALUES ' . $values . ' ';
        $this->runQuery($query);
    }

    public function insertArray($tabla, $parameters) {
        $campos = $this->parseTableSchema($tabla);
        $values = $this->parseValuesInsertArray($campos, $parameters);
        $query = 'INSERT INTO ' . $tabla . '(' . $campos . ') VALUES ' . $values . ' ';
        $this->runQuery($query);
    }

    private function parseValuesUpdate($fields, $parameters) {
        $values = "";
        $array_fields = explode(',', $fields);
        $contador = 0;

        foreach ($array_fields as $field) {
            foreach ($parameters as $name_parameter => $value_parameter) {
                if ($field == $name_parameter) {
                    if ($contador == 0) {
                        $values .= $field . " = '" . $value_parameter . "'";
                    } else {
                        $values .= "," . $field . " = '" . $value_parameter . "'";
                    }
                    $contador++;
                }
            }
        }
        return $values;
    }

    public function parseValuesInsertFila($fields, $parameters) {
        $values = "";
        $cont = 0;
        $array_fields = explode(',', $fields);

        foreach ($array_fields as $field) {
            $encontro = false;
            foreach ($parameters as $name_parameter => $value_parameter) {
                if ($field == $name_parameter) {
                    if ($cont == 0) {
                        $values .= "('" . (($value_parameter || $value_parameter == 0) ? $value_parameter : "NULL") . "'";
                    } else {
                        $values .= ",'" . (($value_parameter || $value_parameter == 0) ? $value_parameter : "NULL") . "'";
                    }
                    $cont++;
                    $encontro = true;
                    break;
                }
            }
            if (!$encontro) {
                if ($cont == 0) {
                    $values .= "('" . (($value_parameter || $value_parameter == 0) ? $value_parameter : "NULL") . "'";
                } else {
                    $values .= ",'" . (($value_parameter || $value_parameter == 0) ? $value_parameter : "NULL") . "'";
                }
                $cont++;
            }
        }
        $values .= ')';
        return $values;
    }

    public function runQuery($consulta, $print = false) {
        if ($print) {
            die($consulta);
        }
        try {
            $query = $this->prepare($consulta);
            $query->execute();
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage() . '<br><br>';
            echo $msg = "Query error:<br>" . $consulta . '<br>';
        }
        return true;
    }

    private function parseValuesInsertArray($fields, $parameters) {
        $values = "";
        $array_fields = explode(',', $fields);
        $key = 0;

        foreach ($parameters as $array_parameter) {
            if ($key != 0) {
                $values .= ',(';
            } else {
                $values .= '(';
            }
            $key++;

            $cont = 0;
            foreach ($array_fields as $field) {
                $encontro = false;
                foreach ($array_parameter as $name_parameter => $value_parameter) {
                    if ($field == $name_parameter) {
                        if ($cont == 0) {
                            $values .= "'" . $value_parameter . "'";
                        } else {
                            $values .= ",'" . $value_parameter . "'";
                        }
                        $encontro = true;
                    }
                }

                if (!$encontro) {
                    if ($cont == 0) {
                        $values .= "'" . $value_parameter . "'";
                    } else {
                        $values .= ",'" . $value_parameter . "'";
                    }
                }

                $cont++;
            }
            $values .= ')';
        }
        return $values;
    }

    public function parseTableSchema($tabla) {
        $key = 0;
        $fields = $this->getArrayQuery('SELECT column_name FROM information_schema.columns where table_name = "' . $tabla . '" and table_schema = "' . DB_NAME . '" and extra != "auto_increment" AND data_type != "timestamp" ');

        foreach ($fields as $field) {
            if ($key == 0) {
                $data = $field['column_name'];
            } else {
                $data .= ',' . $field['column_name'];
            }
            $key++;
        }
        return (($data) ? $data : "");
    }

    public function updateRow($tabla, $parameters, $where, $fields = false) {
        if (is_array($where)) {
            if (!$fields) {
                $fields = $this->parseTableSchema($tabla);
            }
            $values = $this->parseValuesUpdate($fields, $parameters);
            $where = $this->parseWhere($where);
            $this->runQuery("UPDATE $tabla SET $values $where");
        } else {
            die('You forgot where clause');
        }
    }

    public function getArrayQuery($consulta) {
        $query = $this->db->prepare($consulta);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArrayObjects($consulta) {
        $query = $this->prepare($consulta);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}
