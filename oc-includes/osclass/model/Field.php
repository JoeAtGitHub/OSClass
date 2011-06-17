<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    class Field extends DAO
    {
        /**
         * The columns defined in page table.
         *
         * @access private
         * @var array
         */
        private $columns;

        private static $instance ;

        public function __construct() {
            parent::__construct();

            $this->columns      = array('pk_i_id', 's_name', 'e_type');
        }

        public static function newInstance() {
            if(!self::$instance instanceof self) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        /**
         * Return's the name of the table.
         *
         * @return string table name.
         */
        public function getTableName()
        {
            return DB_TABLE_PREFIX . 't_meta_fields';
        }


        /**
         * Find a field by its id.
         *
         * @param int $id
         * @return array Field information. If there's no information, return an empty array.
         */
        public function findByPrimaryKey($id)
        {
            return  $this->conn->osc_dbFetchResult("SELECT * FROM %st_meta_fields WHERE pk_i_id = %d", DB_TABLE_PREFIX, $id);
        }

        /**
         * Find a field by its name
         *
         * @param string $name
         * @return array Field information. If there's no information, return an empty array.
         */
        public function findByName($name)
        {
            return  $this->conn->osc_dbFetchResult("SELECT * FROM %st_meta_fields WHERE s_name = %s", DB_TABLE_PREFIX, $name);
        }

        /**
         * Gets which categories are associated with that field
         *
         * @param string $id
         * @return array
         */
        public function categories($id)
        {
            return  $this->conn->osc_dbFetchResult("SELECT * FROM %st_meta_categories WHERE fk_i_field_id = %d", DB_TABLE_PREFIX, $id);
        }

        /**
         * Get all the fields
         *
         * @return array Return all the fields
         */
        public function listAll()
        {
            return $this->conn->osc_dbFetchResults("SELECT * FROM %st_meta_fields", DB_TABLE_PREFIX);
        }


    }

?>