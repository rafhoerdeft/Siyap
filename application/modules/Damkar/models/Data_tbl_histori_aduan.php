<?php
class Data_tbl_histori_aduan extends CI_Model
{
    var $table = "lapor lpr";
    var $select_column = array(
        'lpr.id_lapor',
        'usr.nama as nama_user',
        'lpr.alamat',
        'lpr.keterangan',
        'jl.nama_jenis_lap',
        'DATE_FORMAT(lpr.tgl_lapor, "%d-%m-%Y (%H:%i)") as waktu_lapor',
        'lpr.image_lapor',
        'lpr.image_selfie',
        'lpr.status',
    );

    var $select_column_search = array();

    function make_query() {

        $order_column = array();
        foreach ($this->select_column as $val) {
            $select = explode(" as ", $val);
            
            if ($select[0] != 'lpr.id_lapor') {
                if (!isset($select[1])) {
                    if ($select[0] != 'lpr.image_selfie') {
                        $order_column[] = $select[0];
                    }
                    $this->select_column_search[] = $select[0];
                } else {
                    $order_column[] = $select[1];
                }
            } else {
                $order_column[] = null;
                $order_column[] = null;
            }
        }

        $this->db->select($this->select_column);
        // $this->db->join('log_lapor log', "lpr.id_lapor = log.id_lapor AND AND log.status = 'Selesai'");
        $this->db->join('kategori ktg', "lpr.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'");
        $this->db->join('jenis_laporan jl', "lpr.id_jenis_lap = jl.id_jenis_lap");
        $this->db->join('users usr', "lpr.id_user = usr.id_user");
        $this->db->from($this->table);
        
        $i = 0;
        foreach ($this->select_column_search as $item) {
            // if datatable send POST for search
            if ($_POST["search"]["value"]) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($item, $_POST["search"]["value"]);
                }

                // last loop
                if (count($this->select_column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST["order"])) {
            // $this->db->order_by('sisa', 'DESC');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('lpr.id_lapor', 'DESC');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data()
    {
        $this->db->select('*');
        // $this->db->join('log_lapor log', "lpr.id_lapor = log.id_lapor AND AND log.status = 'Selesai'");
        $this->db->join('kategori ktg', "lpr.id_kategori = ktg.id_kategori AND ktg.nama_kategori = 'Damkar'");
        $this->db->join('jenis_laporan jl', "lpr.id_jenis_lap = jl.id_jenis_lap");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
