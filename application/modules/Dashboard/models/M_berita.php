<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_berita extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_berita($num = false, $limit = null, $offset = null, $key = null)
    {
        $this->db->from('laporan_damkar ld');
        $this->db->join('lapor l', 'ld.id_lapor = l.id_lapor');
        $this->db->join('log_lapor ll', 'l.id_lapor = ll.id_lapor');

        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }
        if ($key != null) {
            $this->db->where("(ld.penyebab_kejadian like '%$key%')");
        }

        $this->db->order_by('l.tgl_lapor', 'desc');

        $hasil  =   $this->db->get();
        if ($hasil->num_rows() == 0) {
            return false;
        } else {
            if ($num == true) {
                return $hasil->num_rows();
            } else {
                return $hasil->result();
            }
        }
    }

    function stat_visitor()
    {
        return $this->db->select("
        (select count(ip) from visitor where date(tanggal) = curdate()) as today,
        (select count(ip) from visitor WHERE MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())) as bulan,
        (select count(ip) from visitor WHERE YEAR(tanggal) = YEAR(CURRENT_DATE())) as tahun")->get()->row();
    }
}
